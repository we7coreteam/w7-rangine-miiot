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

namespace W7\App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use W7\App\Exception\HttpErrorException;
use W7\App\Model\Logic\OauthLogic;
use W7\Core\Middleware\MiddlewareAbstract;

class CheckOauthMiddleware extends MiddlewareAbstract {
	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
		$accessToken = $request->getHeader('User-Token');
		if (empty($accessToken)) {
			throw new HttpErrorException('Invalid access token');
		}

		$request = $request->withAddedHeader('Authorization', $accessToken);
		try {
			$oauthServer = OauthLogic::instance()->getCheckOauthServer();
			$oauthServer->validateAuthenticatedRequest($request);
		} catch (\Exception $e) {
			throw new HttpErrorException('Invalid access token');
		}
		
		return $handler->handle($request);
	}
}
