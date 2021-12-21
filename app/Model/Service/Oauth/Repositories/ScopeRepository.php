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

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use W7\App\Model\Service\Oauth\Entities\ScopeEntity;

class ScopeRepository implements ScopeRepositoryInterface {
	public function getScopeEntityByIdentifier($identifier) {
		$scope = new ScopeEntity();
		$scope->setIdentifier($identifier);
		return $scope;
	}

	public function finalizeScopes(array $scopes, $grantType, ClientEntityInterface $clientEntity, $userIdentifier = null) {
		return $scopes;
	}
}
