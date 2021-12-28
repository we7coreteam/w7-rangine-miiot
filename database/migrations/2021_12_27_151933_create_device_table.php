<?php

use Illuminate\Database\Schema\Blueprint;
use W7\DatabaseTool\Migrate\Migration;

class CreateDeviceTable2021_12_27_151933 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$this->schema->create('device', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('uid')->index();
			$table->string('brand', 30)->comment('品牌');
			$table->string('name', 30)->comment('产品名称');
			$table->string('model', 30)->comment('产品型号');
			$table->string('description', 100)->comment('产品描述');
			$table->tinyInteger('platform')->comment('产品平台')->comment('10 小米，20 天猫');
			$table->string('type', 80)->comment('类型，每个平台不同');
			$table->string('serial_no', 50)->comment('设备SN码');
			$table->string('serial_number', 50)->comment('设备ID');
			$table->string('firmware-revision', 10)->default('1.0.0')->comment('固件版本');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		$this->schema->dropIfExists('device');
	}
}
