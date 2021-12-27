<?php 

use W7\Facade\Router;

Router::get('/aliiot/api', 'W7\App\Controller\AliIot\ApiController@index');