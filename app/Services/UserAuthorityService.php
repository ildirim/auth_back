<?php

namespace App\Services;

use Event;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAuthority;
use App\Services\QrCodeService;
use App\Events\RegisterMailEvent;
use Illuminate\Support\Str;

class UserAuthorityService
{
	private $userAuthority;

	public function __construct()
	{
		$this->userAuthority = new UserAuthority();
	}

	public function userAuthorityByUserId($userId)
	{
		return $this->userAuthority->where('user_id', $userId)->first();
	}

	public function store($data, $userId)
	{
		$request = [
			'user_id' => $userId,
			'branch_id' => $data['branch_id'],
			'position_id' => $data['position_id'],
			'status' => $data['status']
		];
		return $this->userAuthority->create($request);
	}

	public function update($id, $data)
	{
		$request = [
			'user_id' => $data['user_id'],
			'branch_id' => $data['branch_id'],
			'position_id' => $data['position_id'],
		];
		return $this->userAuthority->where('id', $id)
   				     			  ->update($request);
	}

	public function delete($id, $data)
	{
		$request = [
			'status' => $data['status']
		];
		return $this->userAuthority->where('id', $id)
   				     			  ->update($request);
	}
}
