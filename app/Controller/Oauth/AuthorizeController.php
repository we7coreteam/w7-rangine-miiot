<?php

/**
 * WeEngine DevCenter System
 *
 * (c) We7Team 2019 <https://www.w7.cc>
 *
 * This is not a free software
 * Using it under the license terms
 * visited https://www.w7.cc for more details
 */

namespace W7\App\Controller\Oauth;

use W7\App\Exception\HttpErrorException;
use W7\App\Model\Entity\User;
use W7\App\Model\Logic\OauthLogic;
use W7\App\Model\Service\Oauth\Entities\UserEntity;
use W7\Core\Controller\ControllerAbstract;
use W7\Facade\Config;
use W7\Facade\Context;
use W7\Facade\Validator;
use W7\Http\Message\Server\Request;

class AuthorizeController extends ControllerAbstract {
	public function __construct() {
		Validator::extend('captcha', function ($attr, $value, $param) {
			$imgCode = Context::getRequest()->session->get('img_code');
			Context::getRequest()->session->set('img_code', '');

			if (strtolower($value) == $imgCode) {
				return true;
			} else {
				return false;
			}
		});
	}

	public function index(Request $request) {
		$this->validate($request, [
			'client_id' => 'required',
			'redirect_uri' => 'required',
		]);

		if ($request->query('client_id') != Config::get('common.mi_iot.oauth.client_id') ||
			$request->query('redirect_uri') != Config::get('common.mi_iot.oauth.redirect_uri')) {
			//报错
			throw new HttpErrorException('Invalid client_id');
		}

		return $this->render('@oauth/wap');
	}

	public function byUsernamePassword(Request $request) {
		$this->validate($request, [
			'user_name' => 'required',
			'password' => 'required',
			'captcha' => 'required|captcha'
		]);

		$userName = User::query()->where('username', '=', $request->post('user_name'))->first();
		if (empty($userName)) {
			throw new HttpErrorException('Invalid user');
		}

		if ($userName->password != md5($request->post('password') . $userName->salt)) {
			throw new HttpErrorException('Invalid user');
		}

		$request->session->set('user', [
			'uid' => $userName->uid,
			'group_id' => $userName->group_id,
		]);

		return 'success';
	}

	public function afterLogin(Request $request) {
		$this->validate($request, [
			'redirect_uri' => 'required',
		]);

		$sessionUser = $request->session->get('user');
		if (empty($sessionUser)) {
			throw new HttpErrorException('Invalid login user');
		}
		try {
			$server = OauthLogic::instance()->getServer();

			$authRequest = $server->validateAuthorizationRequest($request);
			$userEntity = new UserEntity();
			$userEntity->setIdentifier($sessionUser['uid']);
			$authRequest->setUser($userEntity);
			$authRequest->setAuthorizationApproved(true);

			return $server->completeAuthorizationRequest($authRequest, $this->response());
		} catch (\Exception $e) {
			throw new HttpErrorException($e->getMessage());
		}
	}
}
