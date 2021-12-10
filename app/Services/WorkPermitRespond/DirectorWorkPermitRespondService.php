<?php

namespace App\Services\WorkPermitRespond;

use App\Services\WorkPermitRespond\IWorkPermitRespondService;
use App\Enums\WorkPermitEnum;

class DirectorWorkPermitRespondService implements IWorkPermitRespondService
{
	public function approveRequest($data, $responsibleUser)
	{
		return [
			'approved_by3' => $data['user_id'],
			'approved_at3' => date('Y-m-d H:i:s'),
			'status' => WorkPermitEnum::APPROVED3_ID
		];
	}
}