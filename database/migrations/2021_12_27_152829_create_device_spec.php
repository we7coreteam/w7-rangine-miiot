<?php

use Illuminate\Database\Schema\Blueprint;
use W7\DatabaseTool\Migrate\Migration;

class CreateDeviceSpec2021_12_27_152829 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$this->schema->create('device_spec', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('device_id')->index();
			$table->integer('service_id')->comment('属性所属服务Id');
			$table->integer('spec_id')->comment('属性标识Id');
			$table->string('name', '50');
			$table->string('value', '50');
			$table->string('description', '100');
			$table->tinyInteger('format')->comment('10 布尔，20 整型，30 字符串型');
			$table->tinyInteger('access_read')->default(1)->comment('可读');
			$table->tinyInteger('access_write')->default(0)->comment('可设置');
			$table->tinyInteger('access_notify')->default(0)->comment('可通知');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		$this->schema->dropIfExists('device_spec');
	}
}
