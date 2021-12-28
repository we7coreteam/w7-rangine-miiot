<?php

/**
 * WeEngine DevCenter System
 *
 * (c) We7Team 2019 <https://www.w7.cc>
 *
 * This is not a free software
 * Using it under the license terms
 * visited https://www.w7.cc for more details
 */

namespace W7\App\Model\Logic;

use W7\App\Model\Entity\Device;
use W7\App\Model\Entity\Device\Spec;
use W7\Core\Database\LogicAbstract;
use W7\Core\Helper\Traiter\InstanceTrait;

class DeviceLogic extends LogicAbstract {
	use InstanceTrait;

	public function getFormatByString($name) {
		$formatString = [
			'string' => Spec::FORMAT_STRING,
			'bool' => Spec::FORMAT_BOOL,
			'uint8' => Spec::FORMAT_INT,
			'uint16' => Spec::FORMAT_INT,
			'uint32' => Spec::FORMAT_INT,
		];
		return $formatString[$name] ?? Spec::FORMAT_STRING;
	}

	public function getDeviceByUid($uid) {
		return Device::query()->where('uid', '=', $uid)->get();
	}

	public function getDeviceSpecByDeviceId($deviceId) {
		return Spec::query()->where('device_id', '=', $deviceId)->get();
	}
}
