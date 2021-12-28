<?php

namespace W7\App\Model\Entity\Device;

use W7\Core\Database\ModelAbstract;

class Spec extends ModelAbstract {
	const FORMAT_STRING = 20;
	const FORMAT_BOOL = 10;
	const FORMAT_INT = 30;

	protected $table = 'device_spec';
	protected $connection = 'default';
	protected $primaryKey = 'id';
	protected $fillable = ['device_id', 'service_id', 'spec_id', 'name', 'value', 'description', 'format', 'access_read', 'access_write', 'access_notify'];
	public $timestamps = false;

	public function getFormatValueAttribute() {
		if ($this->format == self::FORMAT_STRING) {
			return strval($this->value);
		}
		if ($this->format == self::FORMAT_BOOL) {
			return intval($this->value);
		}
		if ($this->format == self::FORMAT_INT) {
			return intval($this->value);
		}
	}
}
