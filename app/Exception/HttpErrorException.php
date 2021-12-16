<?php

namespace W7\App\Exception;

use W7\Core\Exception\ResponseExceptionAbstract;

class HttpErrorException extends ResponseExceptionAbstract {
	public function __construct($message = "", $code = 500, \Throwable $previous = null) {
		// 此处可以重新包装 message 数据
		$message = \json_encode([
			'error' => $message,
			'code' => $code,
		]);
		parent::__construct($message, $code, $previous);
	}
}