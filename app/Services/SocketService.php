<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Services\HttpService;

class SocketService
{
	public function newWorkPermit($userId, $senderId)
	{
		$httpService = new HttpService();

        return $httpService->getPost('api/new-work-permit/' . $userId . '/' . $senderId);
	}
}