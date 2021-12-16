<?php

namespace W7\App\Model\Entity;

use W7\Core\Database\ModelAbstract;

class User extends ModelAbstract {
	protected $table = 'user';
	protected $connection = 'default';
	protected $primaryKey = 'id';
	protected $fillable = ['username', 'password', 'group_id', 'salt'];
	public $timestamps = false;
}
