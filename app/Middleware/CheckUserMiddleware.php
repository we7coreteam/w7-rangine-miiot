<?php

namespace W7\App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use W7\App\Exception\HttpErrorException;
use W7\Core\Middleware\MiddlewareAbstract;

class CheckUserMiddleware extends MiddlewareAbstract {
	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
		$user = $request->session->get('user');
		if (empty($user) || empty($user['uid']) || $user['group_id'] != 1) {
			throw new HttpErrorException('Invalid login user', 406);
		}
		$request = $request->withAttribute('user', $user);
		return $handler->handle($request);
	}
}