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

namespace W7\App\Model\Service\Oauth\Repositories;

use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use W7\App\Model\Logic\OauthLogic;
use W7\App\Model\Service\Oauth\Entities\ClientEntity;

class ClientRepository implements ClientRepositoryInterface {
	public function getClientEntity($clientIdentifier) {
		$oauthConfig = OauthLogic::instance()->getConfigByClientId($clientIdentifier);
		if ($clientIdentifier != $oauthConfig['oauth']['client_id']) {
			throw new \RuntimeException('Invalid client id, only mi iot');
		}

		$client = new ClientEntity();
		$client->setIdentifier($clientIdentifier);
		$client->setName($oauthConfig['oauth']['name']);
		$client->setRedirectUri($oauthConfig['oauth']['redirect_uri']);
		$client->setConfidential();

		return $client;
	}

	public function validateClient($clientIdentifier, $clientSecret, $grantType) {
		$oauthConfig = OauthLogic::instance()->getConfigByClientId($clientIdentifier);

		if ($clientIdentifier != $oauthConfig['oauth']['client_id']) {
			throw new \RuntimeException('Invalid client id, only mi iot');
		}

		if ($clientSecret != $oauthConfig['oauth']['client_secret']) {
			throw new \RuntimeException('Invalid client id, only mi iot');
		}

		return true;
	}
}
