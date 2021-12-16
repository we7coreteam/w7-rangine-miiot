<?php 

use W7\Facade\Router;

Router::get('/util/captcha/index', 'W7\App\Controller\Util\CaptchaController@index');