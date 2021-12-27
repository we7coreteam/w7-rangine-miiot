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

use W7\Core\Database\LogicAbstract;
use W7\Core\Helper\Traiter\InstanceTrait;

class MiIotLogic extends LogicAbstract {
	use InstanceTrait;

	const EVENT_NAME_GET_DEVICES = 'get-devices';

}
