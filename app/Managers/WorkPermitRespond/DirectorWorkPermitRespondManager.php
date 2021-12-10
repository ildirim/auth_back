<?php

namespace App\Managers\WorkPermitRespond;

use App\Services\WorkPermitRespond\IWorkPermitRespondService;
use App\Services\WorkPermitRespond\DirectorWorkPermitRespondService;
use App\Managers\WorkPermitRespond\IWorkPermitRespondManager;

class DirectorWorkPermitRespondManager implements IWorkPermitRespondManager
{
	public function make() : IWorkPermitRespondService
	{
		return new DirectorWorkPermitRespondService();	
	}
}