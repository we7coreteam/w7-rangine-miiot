<?php

namespace W7\App\Controller\Home;

use W7\Core\Controller\ControllerAbstract;
use W7\Http\Message\Server\Request;

class HelloController extends ControllerAbstract {
	public function index(Request $request) {
		return 'hello world，my test';
	}
}
