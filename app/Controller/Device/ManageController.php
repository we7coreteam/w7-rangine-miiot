<?php

namespace W7\App\Controller\Device;

use Illuminate\Support\Str;
use W7\App\Exception\HttpErrorException;
use W7\App\Model\Entity\Device;
use W7\App\Model\Logic\DeviceLogic;
use W7\Core\Controller\ControllerAbstract;
use W7\Facade\DB;
use W7\Http\Message\Server\Request;

class ManageController extends ControllerAbstract {
	public function import(Request $request) {
		$this->validate($request, [
			'data' => 'required|json',
			'name' => 'required',
			'model' => 'required',
			'brand' => 'required',
			'description' => 'required'
		]);

		$json = json_decode($request->post('data'), true);

		DB::beginTransaction();

		try {
			$device = new Device();
			$device->uid = $request->getAttribute('user')['uid'];
			$device->name = trim($request->post('name'));
			$device->model = trim($request->post('model'));
			$device->brand = trim($request->post('brand'));
			$device->description = trim($request->post('description'));

			if (Str::startsWith($json['type'], 'urn:miot-spec')) {
				$device->platform = Device::PLATFORM_MI_IOT;
				$device->type = $json['type'];
			}
			$device->save();

			foreach ($json['services'] as $key => $service) {
				if (empty($service['properties'])) {
					continue;
				}
				foreach ($service['properties'] as $keyP => $property) {
					$propertyRow = new Device\Spec();
					$propertyRow->device_id = $device->id;
					$propertyRow->service_id = $service['iid'];
					$propertyRow->spec_id = $property['iid'];
					$propertyRow->name = $property['description'];
					$propertyRow->format = DeviceLogic::instance()->getFormatByString($property['format']);
					$propertyRow->access_read = $propertyRow->access_write = $propertyRow->access_notify = 0;
					if (in_array('read', $property['access'])) {
						$propertyRow->access_read = 1;
					}
					if (in_array('write', $property['access'])) {
						$propertyRow->access_write = 1;
					}
					if (in_array('notify', $property['access'])) {
						$propertyRow->access_notify = 1;
					}
					$propertyRow->save();
				}
			}
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			throw new HttpErrorException($e->getMessage());
		}

		return [
			'device_id' => $device->id,
		];
	}
}
