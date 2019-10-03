<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VendorController;

class LoginController extends VendorController
{
    public function __construct()
	{
		parent::__construct();

        $this->middleware('guest')->except('logout');
    }

    public function isLoggedIn(Request $request)
    {
    	if(! auth()->check()) {
    		return response()->json(['code' => 400, 'data' => null], 401);
    	}

    	try {
        	$body = json_encode(['user_id' => auth()->id()]);

			$request = $this->client->post('getLoggedInUserDetails', [
				'body' => $body,
				'headers' => [
					'Content-Type' => 'application/json'
				]
			]);

			$output = $request->getBody();

			$output = json_decode($output, true);

			switch (array_get($output, 'code')) {
				case 200:
					if(array_has($output, 'msg.User.id')) {
						Auth::loginUsingId(array_get($output, 'msg.User.id'));

						return response()->json(['code' => 200, 'data' =>  array_get($output, 'msg')]);
					}

					return response()->json(['code' => 401, 'data' =>  'User not found.'], 401);
				case 400:
					return response()->json(['code' => 201, 'data' =>  array_get($output, 'msg')], 404);

				default:
					return response()->json(['code' => 401, 'data' => array_get($output, 'msg')], 401);
			}
		} catch (\Exception $e) {
			return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
		}
    }

    public function login(Request $request)
    {
        try {
        	if(auth()->check()) {
        		return $this->isLoggedIn($request);
        	}

        	$body = ['lat' => '12.9716', 'long' => '77.580643'];

        	$body['email'] = $request->username?: '';
        	$body['password'] = $request->password?: '';
        	$body['device_token'] = \Illuminate\Support\Str::random(20);

        	$body = json_encode($body);

			$request = $this->client->post('webLogin', [
				'body' => $body,
				'headers' => [
					'Content-Type' => 'application/json'
				]
			]);

			$output = $request->getBody();

			$output = json_decode($output, true);

			switch (array_get($output, 'code')) {
				case 200:
					if(array_has($output, 'msg.User.id')) {
						Auth::loginUsingId(array_get($output, 'msg.User.id'));

						return response()->json(['code' => 200, 'data' =>  array_get($output, 'msg')]);
					}

					return response()->json(['code' => 401, 'data' =>  'User not found.'], 401);
				case 201:
					return response()->json(['code' => 201, 'data' =>  array_get($output, 'msg')], 422);

				default:
					return response()->json(['code' => 401, 'data' => array_get($output, 'msg')], 401);
			}
		} catch (\Exception $e) {
			info($e);
			return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
		}
    }

    public function register(Request $request)
    {
        try {
        	if(auth()->check()) {
        		return $this->isLoggedIn($request);
        	}

        	$body['email'] = $request->email?: '';
        	$body['password'] = $request->password?: '';
        	$body['first_name'] = $request->first_name?: '';
        	$body['last_name'] = $request->last_name?: '';
        	$body['phone'] = $request->phone?: '';

        	$body['device_token'] = \Illuminate\Support\Str::random(20);
        	$body['role'] = 'user';

        	$body = json_encode($body);

			$request = $this->client->post('webRegisterUser', [
				'body' => $body,
				'headers' => [
					'Content-Type' => 'application/json'
				]
			]);

			$output = $request->getBody();

			$output = json_decode($output, true);

			switch (array_get($output, 'code')) {
				case 200:
					if(array_has($output, 'msg.User.id')) {
						Auth::loginUsingId(array_get($output, 'msg.User.id'));

						return response()->json(['code' => 200, 'data' =>  array_get($output, 'msg')]);
					}

					return response()->json(['code' => 401, 'data' =>  'User not found.'], 401);
				case 201:
					return response()->json(['code' => 201, 'data' =>  array_get($output, 'msg')], 422);

				default:
					return response()->json(['code' => 401, 'data' => array_get($output, 'msg')], 401);
			}
		} catch (\Exception $e) {
			info($e);
			return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
		}
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return response()->json(['code' => 200, 'data' =>  "Logout Successful."]);;
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
