<?php

namespace App\Services;

use GuzzleHttp\Client;

class HttpService
{
	private $client;
	public function __construct()
	{
		$headers = [
		    'RequestKey' => '38WVc6l7pKAixlQYNqMByFHhFOIZ67',
		    'RequestClientIP' => '172.16.248.27'
		];

		$this->client = new Client(['base_uri' => 'http://mlspp.integration.services', 'headers' => $headers]);
	}

	public function getGet($url, $urlData = [])
	{
        $response = $this->client->request('GET', $this->_setUrl($url, $urlData));
		return json_decode($response->getBody()->getContents());
	}

	public function getPost($url, $data = [], $urlData = [])
	{
		$response = $this->client->request('POST', $this->_setUrl($url, $urlData), ['data' => $data]);
		dd($response);

		return json_decode($response->getBody()->getContents());
	}

	public function getPut($url, $data = [], $urlData = [])
	{
		$response = $this->client->request('PUT', $this->_setUrl($url, $urlData), ['form_params' => $data]);
	
		return json_decode($response->getBody()->getContents());
	}

	public function getDelete($url, $urlData = [])
	{
		$response = $this->client->request('DELETE', $this->_setUrl($url, $urlData));
	
		return json_decode($response->getBody()->getContents());
	}

	private function _setUrl($url, $data = [])
	{
	    if(!empty($data)){
	        foreach ($data as $key => $value) {
	            $url = str_replace(":".$key, $value, $url);
	        }
	    }
	    return $url;
	}
}