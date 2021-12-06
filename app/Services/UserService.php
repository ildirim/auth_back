<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Event;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\QrCodeService;
use App\Services\UserAuthorityService;
use App\Events\SendMailEvent;
use Illuminate\Support\Str;

class UserService
{
	private $user;

	public function __construct()
	{
		$this->user = new User();
	}

	public function check($request)
    {
      $user = $this->userByEmail($request->email);
      if ($user) {
          if (Hash::check($request->password, $user['password'])) {
          	$apikey = base64_encode(Str::random(40));
          	$this->user->where('email', $request->email)->update(['token' => $apikey]);
          	$user['token'] = $apikey;
            // unauthenticated
            return $user;
          }
      }
      return false;
    }

	public function users()
	{
		return $this->user->select('users.id', 'users.status', 'users.name', 'users.surname', 'users.middle_name', 'users.gender', 'users.email', 'users.phone', 'users.internal_phone', 'users.qr_code_link', 'b.name as branch_name', 'p.name as position_name', 'ua.importance_level')
						  ->selectRaw('(select name from branch where id=b.parent_id) department_name')
	     				  ->join('user_authority as ua', 'ua.user_id', '=', 'users.id')
	     				  ->join('branch as b', 'b.id', '=', 'ua.branch_id')
	     				  ->join('positions as p', 'p.id', '=', 'ua.position_id')
						  ->where('users.status', '<>', 2)
						  ->where('ua.status', 1)
						  ->orderBy('users.id', 'desc')
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
		DB::beginTransaction();
		try {
			$user = $this->userByEmail($data['email']);

			if($user)
				return true;

			// store user
			$userId = $this->storeUserAndSendEmail($data);

			if(!$userId)
				return false;

			// store user authority
			$userAuthorityService = new UserAuthorityService();
			$userAuthorityService->store($data, $userId);

			DB::commit();

			return true;
		} catch(Exception $e) {
			DB::rollback();
			return false;
		}
	}

	private function storeUserAndSendEmail($data)
	{
		$password = Str::random(8);
		$request = [
			'name' => $data['name'],
			'surname' => $data['surname'],
			'middle_name' => $data['middle_name'],
			'gender' => $data['gender'] ?? 1,
			'email' => $data['email'],
			'password' => Hash::make($password),
			'token' => '',
			'phone' => $data['phone'],
			'internal_phone' => $data['internal_phone'],
			'importance_level' => $data['importance_level'],
			'status' => $data['status']
		];
		$storedUser = $this->user->create($request);
		if($storedUser)
		{
			$qrCodeService = new QrCodeService();
			$imageName = $qrCodeService->generate(env('APP_URL') . 'auth/' . $storedUser->id . '/id');

			$request = [
				'qr_code_link' => env('APP_URL') . '/auth/' . $storedUser->id,
				'qr_code_image' => $imageName
			];

			$this->user->where('id', $storedUser->id)->update($request);

        	// Event::dispatch(new SendMailEvent($user->id));

        	return $storedUser->id;
		}
		return false;
	}

	public function update($id, $data)
	{
		$request = [
			'branch_id' => $data['branch_id'],
			'position_id' => $data['position_id'],
			'name' => $data['name'],
			'surname' => $data['surname'],
			'middle_name' => $data['surname'],
			'gender' => $data['gender'] ?? 1,
			'email' => $data['email'],
			'phone' => $data['phone'],
			'internal_phone' => $data['internal_phone'],
			'importance_level' => $data['importance_level']
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
