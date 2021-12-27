<?php

namespace W7\App\Controller\Oauth;

use W7\App\Exception\HttpErrorException;
use W7\App\Model\Logic\OauthLogic;
use W7\Core\Controller\ControllerAbstract;
use W7\Http\Message\Server\Request;

class AccessTokenController extends ControllerAbstract {

	/**
	 * 用 code 交换，和刷新 access token
	 * @param Request $request
	 */
	public function code(Request $request) {
		//
		$this->validate($request, [
			'grant_type' => 'required|in:authorization_code,refresh_token',
			'client_id' => 'required',
			'client_secret' => 'required',
			'code' => 'required',
		]);

		try {
			$oauthServer = OauthLogic::instance()->getServer();
			return $oauthServer->respondToAccessTokenRequest($request, $this->response());
		} catch (\Exception $e) {
			throw new HttpErrorException($e->getMessage(), $e->getCode());
		}

	}

	/**
	 * 用 refresh code 刷新 access token
	 * @param Request $request
	 * @deprecated
	 */
	public function refresh(Request $request) {
		//
		$this->validate($request, [
			'grant_type' => 'required|in:refresh_token',
			'client_id' => 'required',
			'client_secret' => 'required',
			'refresh_token' => 'required',
		]);

		try {
			$oauthServer = OauthLogic::instance()->getServer();
			return $oauthServer->respondToAccessTokenRequest($request, $this->response());
		} catch (\Exception $e) {
			throw new HttpErrorException($e->getMessage(), $e->getCode());
		}
	}
}
