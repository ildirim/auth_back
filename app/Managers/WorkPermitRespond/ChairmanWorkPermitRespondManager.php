<?php

namespace App\Managers\WorkPermitRespond;

use App\Services\WorkPermitRespond\IWorkPermitRespondService;
use App\Services\WorkPermitRespond\ChairmanWorkPermitRespondService;
use App\Managers\WorkPermitRespond\IWorkPermitRespondManager;

class ChairmanWorkPermitRespondManager implements IWorkPermitRespondManager
{
	public function make() : IWorkPermitRespondService
	{
		return new ChairmanWorkPermitRespondService();	
	}
}