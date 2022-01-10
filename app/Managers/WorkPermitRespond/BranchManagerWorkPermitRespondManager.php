<?php

namespace App\Managers\WorkPermitRespond;

use App\Services\WorkPermitRespond\IWorkPermitRespondService;
use App\Services\WorkPermitRespond\BranchManagerWorkPermitRespondService;
use App\Managers\WorkPermitRespond\IWorkPermitRespondManager;

class BranchManagerWorkPermitRespondManager implements IWorkPermitRespondManager
{
	public function make() : IWorkPermitRespondService
	{
		return new BranchManagerWorkPermitRespondService();	
	}
}