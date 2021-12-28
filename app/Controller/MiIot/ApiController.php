<?php

namespace W7\App\Controller\MiIot;

use W7\App\Exception\HttpErrorException;
use W7\App\Model\Logic\DeviceLogic;
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
				return array_merge([], $message, $this->doGetDevices($request));
			case MiIotLogic::EVENT_NAME_GET_PROPERTIES:
				return array_merge([], $message, $this->doGetProperties($request, $message));
			default:
				return 'success';
		}
	}

	/**
	 * event get-devices
	 */
	public function doGetDevices(Request &$request) {
		$uid = $request->getAttribute('oauth_user_id');
		$result = [
			'devices' => []
		];
		$deviceList = DeviceLogic::instance()->getDeviceByUid($uid);
		if (empty($deviceList)) {
			return $result;
		}

		$deviceList->each(function ($row, $key) use (&$result) {
			$result['devices'][] = [
				'name' => $row['name'],
				'did' => sprintf('%s%s%s', $row['uid'], $row['platform'], $row['id']),
				'type' => $row['type'],
			];
		});
		return $result;
	}

	protected function doGetProperties(Request &$request, &$message) {
		$uid = $request->getAttribute('oauth_user_id');
		$result = [
			'properties' => []
		];

		if (empty($message['properties'])) {
			return $result;
		}

		$search = [];
		foreach ($message['properties'] as $key => $row) {

		}
	}
}
