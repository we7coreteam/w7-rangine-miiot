<?php

namespace W7\App\Controller\Util;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use W7\Core\Controller\ControllerAbstract;
use W7\Facade\Logger;
use W7\Http\Message\Server\Request;

class CaptchaController extends ControllerAbstract {
	public function index(Request $request) {
		//
		$phrase = new PhraseBuilder();
		$code = $phrase->build(4);

		$builder = new CaptchaBuilder($code, $phrase);
		$builder->setBackgroundColor(255, 255, 255);
		$builder->setMaxAngle(25);
		$builder->setMaxBehindLines(0);
		$builder->setMaxFrontLines(0);
		$builder->build();

		$captchaCode = $builder->getPhrase();
		$request->session->set('img_code', strtolower($captchaCode));

		Logger::debug('img_code: ', [$captchaCode]);
		return [
			'img' => $builder->inline()
		];
	}
}
