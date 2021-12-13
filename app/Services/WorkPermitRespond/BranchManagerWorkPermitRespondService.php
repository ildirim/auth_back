<?php

namespace App\Services\WorkPermitRespond;

use App\Services\WorkPermitRespond\IWorkPermitRespondService;
use App\Enums\WorkPermitEnum;

class BranchManagerWorkPermitRespondService implements IWorkPermitRespondService
{
	public function approveRequest($data, $responsibleUser)
	{
		$request = [
			'approved_by1' => $data['user_id'],
			'approved_at1' => date('Y-m-d H:i:s'),
			'status' => WorkPermitEnum::APPROVED1_ID

		];
		if(!$responsibleUser || (isset($responsibleUser) && $responsibleUser['position_id'] == 1 || $responsibleUser['position_id'] == 2))
		{
			$request['approved_by2'] = $data['user_id'];
			$request['approved_at2'] = date('Y-m-d H:i:s');
			$request['status'] = WorkPermitEnum::APPROVED2_ID;
		}

		return $request;
	}
}