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
use W7\App\Model\Service\Oauth\Entities\ClientEntity;
use W7\Facade\Config;

class ClientRepository implements ClientRepositoryInterface {
	public function getClientEntity($clientIdentifier) {
		if ($clientIdentifier != Config::get('common.mi_iot.oauth.client_id')) {
			throw new \RuntimeException('Invalid client id, only mi iot');
		}

		$client = new ClientEntity();
		$client->setIdentifier($clientIdentifier);
		$client->setName('miiot');
		$client->setRedirectUri(Config::get('common.mi_iot.oauth.redirect_uri'));
		$client->setConfidential();

		return $client;
	}

	public function validateClient($clientIdentifier, $clientSecret, $grantType) {
		if ($clientIdentifier != Config::get('common.mi_iot.oauth.client_id')) {
			throw new \RuntimeException('Invalid client id, only mi iot');
		}

		if ($clientSecret != Config::get('common.mi_iot.oauth.client_secret')) {
			throw new \RuntimeException('Invalid client id, only mi iot');
		}

		return true;
	}
}
