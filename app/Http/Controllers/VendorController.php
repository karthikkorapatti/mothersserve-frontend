<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class VendorController extends Controller
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
}