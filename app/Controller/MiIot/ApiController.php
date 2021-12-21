<?php

namespace W7\App\Controller\MiIot;

use W7\Core\Controller\ControllerAbstract;
use W7\Http\Message\Server\Request;

class ApiController extends ControllerAbstract {
	public function index(Request $request) {
		print_r($request->getBodyParams());
		return 'success';
	}
}
