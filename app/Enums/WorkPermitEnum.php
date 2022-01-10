<?php

namespace App\Enums;

class WorkPermitEnum
{
	const DELETE_ID = 0;
	const DELETE = 'Silinmə';
	const PENDING_ID = 1;
	const PENDING = 'Gözləmədə';
	const REJECT_ID = 2;
	const REJECT = 'İmtina';
	const APPROVED1_ID = 3;
	const APPROVED1 = 'Təsdiq 1';
	const APPROVED2_ID = 4;
	const APPROVED2 = 'Təsdiq 2';
	const APPROVED3_ID = 5;
	const APPROVED3 = 'Təsdiq 3';

	public static function list()
	{
		return [
		];
	}	
}