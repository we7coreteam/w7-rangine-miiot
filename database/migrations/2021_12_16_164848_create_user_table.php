<?php

use Illuminate\Database\Schema\Blueprint;
use W7\DatabaseTool\Migrate\Migration;

class CreateUserTable2021_12_16_164848 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$this->schema->create('user', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('username', 50)->index();
			$table->string('password', 50);
			$table->integer('group_id');
			$table->string('salt', 6);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		$this->schema->dropIfExists('user');
	}
}
