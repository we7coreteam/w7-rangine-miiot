<?php 

use W7\Facade\Router;

Router::get('/home/hello', 'W7\App\Controller\Home\HelloController@index');