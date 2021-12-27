<?php

namespace W7\App\Controller\MiIot;

use W7\App\Exception\HttpErrorException;
use W7\App\Model\Logic\MiIotLogic;
use W7\Core\Controller\ControllerAbstract;
use W7\Http\Message\Server\Request;

class ApiController extends ControllerAbstract {
	public function index(Request $request) {
		//
		$message = $request->getBodyParams();
		if (empty($message)) {
			throw new HttpErrorException('Invalid post params');
		}

		$message = json_decode($message, true);
		if (json_last_error() != JSON_ERROR_NONE) {
			throw new HttpErrorException('Invalid post params');
		}


		switch ($message['intent']) {
			case MiIotLogic::EVENT_NAME_GET_DEVICES:
				return $this->doGetDevices();
				break;
			default:
				return 'success';
		}
	}

	/**
	 * event get-devices
	 */
	public function doGetDevices() {

		return [];
	}
}
