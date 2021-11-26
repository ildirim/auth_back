<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\AuthUser;

class AuthUserService
{
	private $authUser;

	public function __construct(AuthUser $authUser)
	{
		$this->authUser = $authUser;
	}

	public function getAuthUserByUserId($userId)
	{
		return $this->authUser->select('auth_users.id', 'auth_users.confirm_at', 'u.name', 'u.surname')
   	     				      ->join('users as u', 'u.id', '=', 'auth_users.user_id')
							  ->where('user_id', $userId)
							  ->where('auth_users.created_at', '>', date('Y-m-d 00:00:00'))
							  ->where('auth_users.created_at', '<', date('Y-m-d 23:59:59'))
							  ->where('auth_users.type', 1)
							  ->first();
	}

	public function entranceOrExit($id, $request)
	{
		if($request->headers->all()['token'][0] != '!4f@6ACeD1%$58382b86lwW14AE2P#562c1')
			return false;

		$authUser = $this->getAuthUserByUserId($id);

		if(!$authUser)
		{
			$storeData = [
				'user_id' => $id,
				'is_late' => date('Y-m-d H:i:s') > date('Y-m-d 09:40:00'),
				'type' => 1
			];

			if($this->store($storeData))
				return $this->getAuthUserByUserId($id);
		}
		elseif(isset($authUser->id) && is_null($authUser->confirm_at) && date('Y-m-d H:i:s') > date('Y-m-d 17:00:00'))
		{
			$updateData = [
				'is_overtime' => date('Y-m-d H:i:s') > date('Y-m-d 18:40:00'),
				'confirm_at' => date('Y-m-d H:i:s')
			];

			if($this->update($id, $updateData))
				return $this->getAuthUserByUserId($id);
		}
		return false;
	}

	public function store($data)
	{
		$request = [
			'user_id' => $data['user_id'],
			'is_late' => $data['is_late'],
			'type' => $data['type']
		];
		return $this->authUser->create($request);
	}

	public function update($id, $data)
	{
		$request = [
			'confirm_at' => $data['confirm_at']
		];
		return $this->authUser->where('user_id', $id)
							  ->whereNull('confirm_at')
   				     	      ->update($request);
	}

	public function getAuthUsersByDate($data)
	{
		$result = $this->authUser->select('auth_users.id', 'auth_users.is_late', 'auth_users.is_overtime', 'auth_users.confirm_at', 'auth_users.created_at', 'u.name', 'u.surname', 'u.email', 'u.phone', 'b.name as branch_name')
						      ->selectRaw('(select name from branch where id=b.parent_id) department_name')
   	     				      ->join('users as u', 'u.id', '=', 'auth_users.user_id')
	     				  	  ->join('branch as b', 'b.id', '=', 'u.branch_id')
							  ->where('auth_users.created_at', '>=', date('Y-m-d', strtotime($data['from'])))
							  ->where('auth_users.created_at', '<=', date('Y-m-d 23:59:00', strtotime($data['to'])));

		if($data['type'] == 1)
			$result->where('is_late', 1);
		elseif($data['type'] == 2)
			$result->where('is_overtime', 1);
	
		return $result->get();
	}
}
