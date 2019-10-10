<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\VendorController;

class AddressesController extends VendorController
{
    public function index(Request $request)
	{
		try {
			$body = ['lat' => '12.9716', 'long' => '77.580643'];

			$body['user_id'] = auth()->id();

			// if($request->restaurant_id) {
			// 	$body['restaurant_id'] = $request->restaurant_id;
			// }

			// if($request->sub_total) {
			// 	$body['sub_total'] = $request->sub_total;
			// }

			$body = json_encode($body);

			$request = $this->client->post('showDeliveryAddresses', [
				'body' => $body,
				'headers' => [
					'Content-Type' => 'application/json'
				]
			]);
			$output = $request->getBody();

			$output = json_decode($output, true);

			$data = array_get($output, 'msg');

			return response()->json(['code' => 200, 'data' => $data]);
		} catch (\Exception $e) {
			info($e);

			return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
		}
	}
}
