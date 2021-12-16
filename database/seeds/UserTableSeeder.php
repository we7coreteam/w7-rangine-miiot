<?php

use W7\DatabaseTool\Seed\Seeder;

class UserTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//
		\W7\Facade\DB::table('user')->insert([
			'username' => 'admin',
			'password' => md5('123456' . 'miiott'),
			'salt' => 'miiott',
			'group_id' => 1,
		]);

		\W7\Facade\DB::table('user')->insert([
			'username' => 'user1',
			'password' => md5('789456' . 'abcdef'),
			'salt' => 'abcdef',
			'group_id' => 2,
		]);
	}
}
