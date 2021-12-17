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

namespace W7\App\Model\Service\Oauth\Entities;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

class ClientEntity implements ClientEntityInterface {
	use EntityTrait, ClientTrait;

	public function setName($name) {
		$this->name = $name;
	}

	public function setRedirectUri($uri) {
		$this->redirectUri = $uri;
	}

	public function setConfidential() {
		$this->isConfidential = true;
	}
}
