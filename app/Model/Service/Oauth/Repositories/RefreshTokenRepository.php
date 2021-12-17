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

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use W7\App\Model\Service\Oauth\Entities\RefreshTokenEntity;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface {
	/**
	 * {@inheritdoc}
	 */
	public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity) {
		// Some logic to persist the refresh token in a database
	}

	/**
	 * {@inheritdoc}
	 */
	public function revokeRefreshToken($tokenId) {
		// Some logic to revoke the refresh token in a database
	}

	/**
	 * {@inheritdoc}
	 */
	public function isRefreshTokenRevoked($tokenId) {
		return false; // The refresh token has not been revoked
	}

	/**
	 * {@inheritdoc}
	 */
	public function getNewRefreshToken() {
		return new RefreshTokenEntity();
	}
}
