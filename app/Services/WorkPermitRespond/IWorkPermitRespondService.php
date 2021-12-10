<?php

namespace App\Services\WorkPermitRespond;

interface IWorkPermitRespondService
{
	public function approveRequest($data, $responsibleUser);
}