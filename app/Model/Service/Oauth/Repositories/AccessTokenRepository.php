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

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use W7\App\Model\Service\Oauth\Entities\AccessTokenEntity;

class AccessTokenRepository implements AccessTokenRepositoryInterface {
	/**
	 * {@inheritdoc}
	 */
	public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity) {
		// Some logic here to save the access token to a database
	}

	/**
	 * {@inheritdoc}
	 */
	public function revokeAccessToken($tokenId) {
		// Some logic here to revoke the access token
	}

	/**
	 * {@inheritdoc}
	 */
	public function isAccessTokenRevoked($tokenId) {
		return false; // Access token hasn't been revoked
	}

	/**
	 * {@inheritdoc}
	 */
	public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null) {
		$accessToken = new AccessTokenEntity();
		$accessToken->setClient($clientEntity);
		foreach ($scopes as $scope) {
			$accessToken->addScope($scope);
		}
		$accessToken->setUserIdentifier($userIdentifier);

		return $accessToken;
	}
}
