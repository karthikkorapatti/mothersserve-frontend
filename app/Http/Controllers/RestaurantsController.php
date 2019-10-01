<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
	protected $client;

	public function __construct()
	{
		// parent::__construct();

		$this->client = new \GuzzleHttp\Client([
			'base_uri' => config('datafeed.client_uri'),
			'headers' => [
				// 'Accept' => 'application/json',
				'X-Requested-With' => 'XMLHttpRequest'
			]
		]);
	}

	public function index(Request $request)
	{
		try {
			$request = $this->client->post('showRestaurants', [
				'body' => json_encode(['lat' => '12.9716', 'long' => '77.580643']),
				'headers' => [
					'Content-Type' => 'application/json'
				]
			]);
			$output = $request->getBody();

			$output = json_decode($output, true);

			$data = array_get($output, 'msg');

			return response()->json(['code' => 200, 'data' => $data]);
		} catch (\Exception $e) {
			return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
		}
	}

	public function show(Request $request, $id)
	{
		try {
			$request = $this->client->post('showRestaurantsMenu', [
				'body' => json_encode([
					'id' => $id,
					'current_time' => $request->input('current_time', \Carbon\Carbon::now()->format('Y m d h:i:s'))
				]),
				'headers' => [
					'Content-Type' => 'application/json'
				]
			]);
			$output = $request->getBody();

			$output = json_decode($output, true);

			$data = (count(array_get($output, 'msg')) == 1)? array_get($output, 'msg.0') : [];

			return response()->json(['code' => 200, 'data' => $data]);
		} catch (\Exception $e) {
			return response()->json(['code' => 500, 'message' => 'Oops!!! Something went wrong'], 500);
		}
	}
}
