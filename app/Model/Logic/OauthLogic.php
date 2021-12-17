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

use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use W7\App\Model\Service\Oauth\Repositories\AccessTokenRepository;
use W7\App\Model\Service\Oauth\Repositories\AuthCodeRepository;
use W7\App\Model\Service\Oauth\Repositories\ClientRepository;
use W7\App\Model\Service\Oauth\Repositories\RefreshTokenRepository;
use W7\App\Model\Service\Oauth\Repositories\ScopeRepository;
use W7\Core\Database\LogicAbstract;
use W7\Core\Helper\Traiter\InstanceTrait;
use W7\Facade\Config;

class OauthLogic extends LogicAbstract {
	use InstanceTrait;

	/**
	 * @var AuthorizationServer
	 */
	private $oauthServer;

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
				new \DateInterval('PT10M')
			),
			new \DateInterval('PT1H')
		);

		$this->oauthServer->enableGrantType(
			new RefreshTokenGrant(
				new RefreshTokenRepository(),
			),
			new \DateInterval('PT1H')
		);
		return $this->oauthServer;
	}
}
