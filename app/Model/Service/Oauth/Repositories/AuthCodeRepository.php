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

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use W7\App\Model\Service\Oauth\Entities\AuthCodeEntity;

class AuthCodeRepository implements AuthCodeRepositoryInterface {
	/**
	 * {@inheritdoc}
	 */
	public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity) {
		// Some logic to persist the auth code to a database
	}

	/**
	 * {@inheritdoc}
	 */
	public function revokeAuthCode($codeId) {
		// Some logic to revoke the auth code in a database
	}

	/**
	 * {@inheritdoc}
	 */
	public function isAuthCodeRevoked($codeId) {
		return false; // The auth code has not been revoked
	}

	/**
	 * {@inheritdoc}
	 */
	public function getNewAuthCode() {
		return new AuthCodeEntity();
	}
}
