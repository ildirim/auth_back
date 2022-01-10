<?php

namespace App\Managers\WorkPermitRespond;

use App\Services\WorkPermitRespond\IWorkPermitRespondService;
interface IWorkPermitRespondManager
{
	public function make() : IWorkPermitRespondService;
}