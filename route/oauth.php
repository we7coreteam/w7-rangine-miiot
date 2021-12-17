<?php 

use W7\Facade\Router;

Router::get('/oauth/authorize/index', 'W7\App\Controller\Oauth\AuthorizeController@index');
Router::post('/oauth/authorize/by-username-password', [\W7\App\Controller\Oauth\AuthorizeController::class, 'byUsernamePassword']);
Router::get('/oauth/authorize/after-login', [\W7\App\Controller\Oauth\AuthorizeController::class, 'afterLogin']);