<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Event;
use App\Events\WorkPermitMailEvent;
use App\Models\WorkPermit;
use App\Enums\PositionEnum;
use App\Services\UserService;
use App\Managers\WorkPermitRespond\BranchManagerWorkPermitRespondManager;
use App\Managers\WorkPermitRespond\DirectorWorkPermitRespondManager;
use App\Managers\WorkPermitRespond\ChairmanWorkPermitRespondManager;
use App\Managers\WorkPermitRespond\IWorkPermitRespondManager;
use App\Enums\WorkPermitEnum;

class WorkPermitService
{
	private $workPermit;

	public function __construct()
	{
		$this->workPermit = new WorkPermit();
	}

	public function workPermits($branchId)
	{
		return $this->workPermit->select('work_permits.id', 'work_permits.maker_id', 'work_permits.from', 'work_permits.to', 'work_permits.reason', 'work_permits.approved_by1', 'work_permits.approved_at1', 'work_permits.approved_by2', 'work_permits.approved_at2', 'work_permits.approved_by3', 'work_permits.approved_at3', 'work_permits.reject_reason', 'work_permits.rejected_at', 'work_permits.created_at', 'u.name', 'u.surname', 'u.middle_name')
   	     				        ->join('user as u', 'u.id', '=', 'work_permits.user_id')
   	     				        ->join('user_authority as ua', 'ua.user_id', '=', 'work_permits.user_id')
								->where('ua.branch_id', $branchId)
								->orderBy('id', 'desc')->get();
	}

	public function workPermitsByUserId($userId)
	{
		return $this->workPermit->select('work_permits.id', 'work_permits.maker_id', 'work_permits.from', 'work_permits.to', 'work_permits.reason', 'work_permits.approved_by1', 'work_permits.approved_at1', 'work_permits.approved_by2', 'work_permits.approved_at2', 'work_permits.approved_by3', 'work_permits.approved_at3', 'work_permits.reject_reason', 'work_permits.rejected_at', 'work_permits.status', 'work_permits.created_at', 'u.name', 'u.surname', 'u.middle_name')
   	     				        ->join('users as u', 'u.id', '=', 'work_permits.maker_id')
   	     				        ->join('user_authority as ua', 'ua.user_id', '=', 'work_permits.maker_id')
   	     				        ->where('work_permits.maker_id', $userId)
								->where('work_permits.status', '<>', 2)
							    ->get();
	}

	public function workPermitsByUserId2($userId)
	{
		$branchIdList = [];
		$userAuthorityService = new UserAuthorityService();
		$branchId = $userAuthorityService->userAuthorityByUserId($userId)->branch_id;
		$branchIdList[] = $branchId;
		$branchService = new BranchService();

		$branch = $branchService->branchById($branchId);
		foreach($branch->children() as $childBranch)
		{
			$branchIdList[] = $childBranch['branch_id'];
		}

		$workPermits = $this->workPermit->select('work_permits.id', 'work_permits.maker_id', 'work_permits.from', 'work_permits.to', 'work_permits.reason', 'work_permits.approved_by1', 'work_permits.approved_at1', 'work_permits.approved_by2', 'work_permits.approved_at2', 'work_permits.approved_by3', 'work_permits.approved_at3', 'work_permits.reject_reason', 'work_permits.rejected_at', 'work_permits.status', 'work_permits.created_at')
   	     				        ->join('user_authority as ua', 'ua.user_id', '=', 'work_permits.maker_id')
								->where('maker_id', $userId)
								->orWhereIn('branch_id', $branchIdList)
							    ->get();
	
		return $workPermits;
	}

	public function workPermitById($id)
	{
		$workPermit = $this->workPermit->select('work_permits.id', 'work_permits.maker_id', 'work_permits.from', 'work_permits.to', 'work_permits.reason', 'work_permits.approved_by1', 'work_permits.approved_at1', 'work_permits.approved_by2', 'work_permits.approved_at2', 'work_permits.approved_by3', 'work_permits.approved_at3', 'work_permits.reject_reason', 'work_permits.rejected_at', 'work_permits.created_at', 'u.name', 'u.surname', 'u.middle_name')
   	     				        ->join('users as u', 'u.id', '=', 'work_permits.maker_id')
								->where('work_permits.id', $id)
								->first();
	
		$workPermit['responsible_user'] = $this->responsibleUser($workPermit)->id ?? null;

		return $workPermit;
	}

	public function store($data)
	{
		DB::beginTransaction();
		try {
			$storedId = $this->storeWorkPermit($data);
	    	$user = $this->responsibleUser($data);
			if($user)
				Event::dispatch(new WorkPermitMailEvent($user->id));
	    	DB::commit();

			return true;

    	} catch(Exception $e) {
			DB::rollback();
			return false;
		}
	}

	public function storeWorkPermit($data)
	{
		$request = [
			'maker_id' => $data['maker_id'],
			'from' => $data['from'],
			'to' => $data['to'],
			'reason' => $data['reason'],
			'status' => $data['status']
		];
		$workPermit = $this->workPermit->create($request);
		return $workPermit->id;
	}

	public function responsibleUser($data)
	{
		$userService = new UserService();
		$user = $userService->userById($data['maker_id']);
		if($user)
		{
			$positionIds = $user['position_id'] == 3 ? PositionEnum::list()[$user['position_id']][$user['curation']] : PositionEnum::list()[$user['position_id']];
			if($positionIds)
			{
				$user = $userService->userByBranchIdAndPositionIds($user['branch_id'], $positionIds);
				if($user)
				{
					return $user;
				}
    		}
		}
		return false;
	}

	public function approve($id, $data)
	{
		$workPermit = $this->workPermit->where('id', $id)->first();
		$responsibleUser = $this->responsibleUser($data);

		if(is_null($workPermit['approved_by1']))
			$manager = $this->getApproveRequest(new BranchManagerWorkPermitRespondManager());
		elseif(is_null($workPermit['approved_by2']))
			$manager = $this->getApproveRequest(new DirectorWorkPermitRespondManager());
		elseif(is_null($workPermit['approved_by3']))
			$manager = $this->getApproveRequest(new ChairmanWorkPermitRespondManager());

		$request = $manager->approveRequest($data, $responsibleUser);

		return $this->workPermit->where('id', $id)
   				     			->update($request);
	}

	public function reject($id, $data)
	{
		$request = [
			'rejected_by' => $data['user_id'],
			'rejected_at' => date('Y-m-d H:i:s'),
			'status' => WorkPermitEnum::REJECT_ID
		];

		return $this->workPermit->where('id', $id)
   				     			->update($request);
	}

	private function getApproveRequest(IWorkPermitRespondManager $iWorkPermitRespondManager)
	{
		return $iWorkPermitRespondManager->make();
	}

	public function update($id, $data)
	{
		$request = [
			'name' => $data['name'],
			'status' => $data['status'] ?? 1
		];
		return $this->workPermit->where('id', $id)
   				     			  ->update($request);
	}

	public function delete($id, $data)
	{
		$request = [
			'status' => $data['status']
		];
		return $this->workPermit->where('id', $id)
   				     			  ->update($request);
	}
}
