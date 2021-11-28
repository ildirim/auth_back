<?php

namespace App\Services;

use Event;
use App\Models\User;
use App\Services\QrCodeService;
use App\Events\SendMailEvent;

class UserService
{
	private $user;

	public function __construct()
	{
		$this->user = new User();
	}

	public function list()
	{
		return $this->user->select('users.id', 'users.name', 'users.surname', 'users.email', 'users.phone', 'users.qr_code_link', 'b.name as branch_name')
						  ->selectRaw('(select name from branch where id=b.parent_id) department_name')
	     				  ->join('branch as b', 'b.id', '=', 'users.branch_id')
						  ->where('users.status', '<>', 2)
						  ->orderBy('id', 'desc')
						  ->get();
	}

	public function activeUsers()
	{
		return $this->user->where('status', 1)->orderBy('id', 'desc')->get();
	}

	public function userById($id)
	{
		return $this->user->where('id', $id)->first();
	}

	public function userByName($name)
	{
		return $this->user->where('name', $name)->first();
	}

	public function userByEmail($email)
	{
		return $this->user->where('email', $email)->first();
	}

	public function store($data)
	{
		$user = $this->userByEmail($data['email']);

		if($user)
			return true;

		$request = [
			'branch_id' => $data['branch_id'],
			'name' => $data['name'],
			'surname' => $data['surname'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'status' => $data['status']
		];
		$user = $this->user->create($request);
		if($user)
		{
			$qrCodeService = new QrCodeService();
			$imageName = $qrCodeService->generate(env('APP_URL') . 'auth/' . $user->id);

			$request = [
				'qr_code_link' => env('APP_URL') . '/auth/' . $user->id,
				'qr_code_image' => $imageName
			];

			$this->user->where('id', $user->id)->update($request);

        	Event::dispatch(new SendMailEvent($user->id));

        	return true;
		}

		return false;
	}

	public function update($id, $data)
	{
		$request = [
			'branch_id' => $data['branch_id'],
			'name' => $data['name'],
			'surname' => $data['surname'],
			'email' => $data['email'],
			'phone' => $data['phone']
		];
		return $this->user->where('id', $id)
   				     			  ->update($request);
	}

	public function delete($id, $data)
	{
		$request = [
			'status' => $data['status']
		];
		return $this->user->where('id', $id)
   				     			  ->update($request);
	}
}
