<?php

/**
 * WeEngine DevCenter System
 *
 * (c) We7Team 2019 <https://www.w7.cc>
 *
 * This is not a free software
 * Using it under the license terms
 * visited https://www.w7.cc for more details
 */

namespace W7\App\Model\Logic;

use Illuminate\Support\Str;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use League\OAuth2\Server\ResourceServer;
use W7\App\Model\Service\Oauth\Repositories\AccessTokenRepository;
use W7\App\Model\Service\Oauth\Repositories\AuthCodeRepository;
use W7\App\Model\Service\Oauth\Repositories\ClientRepository;
use W7\App\Model\Service\Oauth\Repositories\RefreshTokenRepository;
use W7\App\Model\Service\Oauth\Repositories\ScopeRepository;
use W7\Core\Database\LogicAbstract;
use W7\Core\Helper\Traiter\InstanceTrait;
use W7\Facade\Config;
use W7\Facade\Context;

class OauthLogic extends LogicAbstract {
	use InstanceTrait;

	/**
	 * @var AuthorizationServer
	 */
	private $oauthServer;

	/**
	 * @var ResourceServer
	 */
	private $checkOauthServer;

	public function getServer() {
		if (!empty($this->oauthServer)) {
			return $this->oauthServer;
		}

		$this->oauthServer = new AuthorizationServer(
			new ClientRepository(),
			new AccessTokenRepository(),
			new ScopeRepository(),
			new CryptKey(Config::get('common.mi_iot.key.private')),
			Config::get('common.mi_iot.key.encrypt_key')
		);

		$this->oauthServer->enableGrantType(
			new AuthCodeGrant(
				new AuthCodeRepository(),
				new RefreshTokenRepository(),
				(new \DateInterval('PT10M')) // code 10分钟有效
			),
			new \DateInterval('PT1H') // 交换的 access token 1小时有效
		);

		$this->oauthServer->enableGrantType(
			new RefreshTokenGrant(
				new RefreshTokenRepository(), // 内部默认 refresh token 1月有效
			),
			new \DateInterval('PT1H') // 交换的 access token 1小时有效
		);
		return $this->oauthServer;
	}

	public function getCheckOauthServer() {
		if (!empty($this->checkOauthServer)) {
			return $this->checkOauthServer;
		}

		$this->checkOauthServer = new ResourceServer(
			new AccessTokenRepository(),
			new CryptKey(Config::get('common.mi_iot.key.public'))
		);

		return $this->checkOauthServer;
	}

	public function getConfigByClientId($clientId) {
		$postRedirectUri = Context::getRequest()->query('redirect_uri') ?? Context::getRequest()->post('redirect_uri');

		$config = Config::get('common');
		foreach ($config as $platform => $row) {
			// https://open.bot.tmall.com/oauth/callback?skillId=85023&token=MTk4MTI3NDQ3QUZFSElORkRWUQ==
			if ($row['oauth']['client_id'] == $clientId) {
				if (Str::startsWith($postRedirectUri, $row['oauth']['redirect_uri'])) {
					$row['oauth']['redirect_uri'] = $postRedirectUri;
				}
				$row['oauth']['name'] = $platform;
				return $row;
			}
		}

		throw new \RuntimeException('Invalid oauth client id');
	}
}
