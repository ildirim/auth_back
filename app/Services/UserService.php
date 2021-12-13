<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Event;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\QrCodeService;
use App\Services\BranchService;
use App\Services\UserAuthorityService;
use App\Events\RegisterMailEvent;
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
		return $this->user->select('users.id', 'users.status', 'users.name', 'users.surname', 'users.middle_name', 'users.gender', 'users.email', 'users.phone', 'users.internal_phone', 'users.qr_code_link', 'b.name as branch_name', 'ua.position_id')
						  ->selectRaw('(select name from branch where id=b.parent_id) department_name')
	     				  ->join('user_authority as ua', 'ua.user_id', '=', 'users.id')
	     				  ->join('branch as b', 'b.id', '=', 'ua.branch_id', 'left')
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
		return $this->user->select('users.id', 'users.status', 'users.name', 'users.surname', 'users.middle_name', 'users.gender', 'users.email', 'users.phone', 'users.internal_phone', 'users.qr_code_link', 'ua.branch_id', 'ua.position_id', 'b.curation')
	     				  ->join('user_authority as ua', 'ua.user_id', '=', 'users.id')
	     				  ->join('branch as b', 'b.id', '=', 'ua.branch_id')
						  ->where('users.id', $id)
						  ->first();
	}

	public function userByBranchIdAndPositionIds($branchId, $positionIds)
	{
		$branchService = new BranchService();
		$branch = $branchService->branchById($branchId);
		$parentId = $branch['parent_id'] ?? 0;

		return $this->user->select('users.id', 'users.status', 'users.name', 'users.surname', 'users.middle_name', 'users.gender', 'users.email', 'users.phone', 'users.internal_phone', 'users.qr_code_link', 'ua.position_id')
	     				  ->join('user_authority as ua', 'ua.user_id', '=', 'users.id')
	     				  ->join('branch as b', 'b.id', '=', 'ua.branch_id')
						  ->where(
							  	function($q) use($branchId, $parentId) {
							  		return $q
							  				->where('ua.branch_id', $branchId)
									     	->orWhere('b.id', $parentId);
							  	})
						  ->whereIn('ua.position_id', $positionIds)
						  ->where('users.status', '<>', 2)
						  ->orderBy('ua.position_id', 'desc')
						  ->first();
	}

	public function userByPositionIds($positionIds)
	{
		return $this->user->select('users.id', 'users.status', 'users.name', 'users.surname', 'users.middle_name', 'users.gender', 'users.email', 'users.phone', 'users.internal_phone', 'users.qr_code_link', 'ua.position_id')
	     				  ->join('user_authority as ua', 'ua.user_id', '=', 'users.id')
						  ->whereIn('ua.position_id', $positionIds)
						  ->where('users.status', '<>', 2)
						  ->orderBy('ua.position_id', 'desc')
						  ->first();
	}

	public function userByName($name)
	{
		return $this->user->where('name', $name)->first();
	}

	public function userByEmail($email)
	{
		return $this->user->select('users.id', 'users.status', 'users.name', 'users.surname', 'users.middle_name', 'users.gender', 'users.email', 'users.phone', 'users.internal_phone', 'users.qr_code_link', 'ua.branch_id', 'ua.position_id', 'b.curation')
	     				  ->join('user_authority as ua', 'ua.user_id', '=', 'users.id')
	     				  ->where('email', $email)
	     				  ->first();
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

        	Event::dispatch(new RegisterMailEvent($storedUser->id, $password));

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
