<?php 

use W7\Facade\Router;

Router::get('/oauth/authorize/index[/login]', 'W7\App\Controller\Oauth\AuthorizeController@index');
Router::post('/oauth/authorize/by-username-password', [\W7\App\Controller\Oauth\AuthorizeController::class, 'byUsernamePassword']);
Router::get('/oauth/authorize/after-login', [\W7\App\Controller\Oauth\AuthorizeController::class, 'afterLogin']);

Router::group('/oauth/access-token', function () {
	Router::post('/code', [\W7\App\Controller\Oauth\AccessTokenController::class, 'code']);
	Router::post('/refresh', [\W7\App\Controller\Oauth\AccessTokenController::class, 'refresh']);
});