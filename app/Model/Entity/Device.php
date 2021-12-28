<?php

namespace W7\App\Model\Entity;

use W7\Core\Database\ModelAbstract;

class Device extends ModelAbstract {
	const PLATFORM_MI_IOT = 10;
	const PLATFORM_ALI_IOT = 20;

	protected $table = 'device';
	protected $connection = 'default';
	protected $primaryKey = 'id';
	protected $fillable = ['brand', 'name', 'model', 'description', 'platform', 'type', 'serial_no', 'serial_number', 'firmware-revision'];
	public $timestamps = false;
}
