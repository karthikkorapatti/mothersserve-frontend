<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\VendorController;

class OrdersController extends VendorController
{
    public function store(Request $request)
    {
    	try {
			$body = ['lat' => '12.9716', 'long' => '77.580643'];

			$body['user_id'] = auth()->id();
			$body['quantity'] = count($request->input('items', []));
			$body['payment_id'] = $request->payment_method? 1 : 0;
			$body['address_id'] = $request->address_id? $request->address_id : 0;
			$body['restaurant_id'] = $request->restaurant_id? $request->restaurant_id : 0;
			$body['cod'] = $request->payment_method? 0 : 1;
			$body['tax'] = $request->tax?: 0;
			$body['sub_total'] = $request->sub_total?: 0;
			$body['instructions'] = $request->instructions?: '';
			$body['coupon_id'] = $request->coupon_id?: 0;
			$body['device'] = 'web';
			$body['version'] = '1.0';
			$body['delivery_fee'] = $request->delivery_fee?: 0;
			$body['delivery'] = $request->delivery_type?: 0;
			$body['rider_tip'] = $request->rider_tip?: 0;
			$body['order_time'] = \Carbon\Carbon::now()->toDateTimeString();

			$body['menu_item'] = [];

			foreach ($request->input('items', []) as $key => $item) {
				$body['menu_item'][$key] = [
					'menu_item_name' => $item['entry']['name'],
					'menu_item_quantity' => $item['quantity'],
					'menu_item_price' => $item['entry']['price']
				];
			}

			$body = json_encode($body);

			$clientRequest = $this->client->post('webPlaceOrder', [
				'body' => $body,
				'headers' => [
					'Content-Type' => 'application/json'
				]
			]);
			$output = $clientRequest->getBody();

			$output = json_decode($output, true);

			$data = array_get($output, 'msg');

			if($data == 'error') {
				return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
			}

			if($request->payment_method && array_has($data, 'payment_url')) {
				return response()->json(['code' => 200, 'data' => [
						'payment_url' => array_get($data, 'payment_url')
					]
				]);
			}

			if(count($data) != 1) {
				return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
			}

			return response()->json(['code' => 200, 'data' => [
					'redirect_to' => '/orders/' . array_get($data[0], 'Order.id') . '/confirmed', 'message' => 'Order Confirmed'
				]
			]);
		} catch (\Exception $e) {
			info($e);

			return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
		}
    }

    public function confirm(Request $request, $id)
    {

    }

    public function confirmed(Request $request, $id)
    {
    	try {
			$body = ['lat' => '12.9716', 'long' => '77.580643'];

			$body['order_id'] = $id;

			$body = json_encode($body);

			$request = $this->client->post('showOrderDetail', [
				'body' => $body,
				'headers' => [
					'Content-Type' => 'application/json'
				]
			]);
			$output = $request->getBody();

			info($output);
			$output = json_decode($output, true);

			$data = array_get($output, 'msg');


			if(count($data) != 1) {
				return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
			}

			return response()->json(['code' => 200, 'data' => $data]);
		} catch (\Exception $e) {
			info($e);

			return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
		}
    }
}
