<?php

return [
	'mi_iot' => [
		'oauth' => [
			'client_id' => 'wa470f1038e8fc8e9f',
			'client_secret' => 'pkp5qpnomD3w9dHdbGfgTRDBH7azxMshrsc8j419AyzLQV6TEwzuZrCq4TjFP3CG',
			'redirect_uri' => 'https://oauth-redirect.api.home.mi.com/r/2147474955'
		],
		'user' => [
			[
				'uid' => 1,
				'username' => 'admin',
				'password' => md5(md5('admin888')),
			], [
				'uid' => 2,
				'username' => 'xiaoming',
				'password' => md5(md5('changjiang7hao')),
			],
		]
	]
];
