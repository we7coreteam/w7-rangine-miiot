<?php 

use W7\Facade\Router;

Router::middleware([\W7\App\Middleware\CheckOauthMiddleware::class])->post('/miiot/api', 'W7\App\Controller\MiIot\ApiController@index');