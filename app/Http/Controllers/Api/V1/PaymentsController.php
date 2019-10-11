<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\VendorController;

class PaymentsController extends VendorController
{
    public function callback(Request $request, $id)
    {
    	try {
			$body = ['lat' => '12.9716', 'long' => '77.580643'];

			$body['payment_request_id'] = $request->payment_request_id?: '';
			$body['payment_id'] = $request->payment_id?: '';

			// $body = json_encode($body);

			$request = $this->client->get('payments/' . $id . '/redirect', [
				'query' => $body,
				'headers' => [
					'Content-Type' => 'application/json'
				]
			]);
			$output = $request->getBody();

			$output = json_decode($output, true);

			$data = array_get($output, 'msg');

			if($data == 'error') {
				return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
			}

			if(count($data) != 1) {
				return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
			}

			return redirect('/orders/' . array_get($data[0], 'Order.id') . '/confirmed');
		} catch (\Exception $e) {
			info($e);

			return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
		}
    }
}
