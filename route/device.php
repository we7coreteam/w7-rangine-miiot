<?php 

use W7\Facade\Router;

Router::middleware([\W7\App\Middleware\CheckUserMiddleware::class])->group('/device/manage', function () {
	Router::post('/import', 'W7\App\Controller\Device\ManageController@import');
});