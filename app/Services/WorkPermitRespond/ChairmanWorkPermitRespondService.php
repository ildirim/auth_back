<?php

namespace App\Services\WorkPermitRespond;

use App\Services\WorkPermitRespond\IWorkPermitRespondService;
use App\Enums\WorkPermitEnum;

class ChairmanWorkPermitRespondService implements IWorkPermitRespondService
{
	public function approveRequest($data, $responsibleUser)
	{
		return [
			'approved_by2' => $data['user_id'],
			'approved_at2' => date('Y-m-d H:i:s'),
			'status' => WorkPermitEnum::APPROVED2_ID
		];
	}
}