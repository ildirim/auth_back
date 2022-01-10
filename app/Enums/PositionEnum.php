<?php

namespace App\Enums;

class PositionEnum
{
	const CHAIRMAN_OF_BOARD = 1;
	const DEPUTY_CHAIRMAN_OF_BOARD = 2;
	const DIRECTOR = 3;
	const BRANCH_MANAGER = 4;
	const SENIOR_SPECIALIST = 5;
	const GREAT_SPECIALIST = 6;
	const LEAD_SPECIALIST = 7;
	const SPECIALIST = 8;

	public static function list()
	{
		return [
			self::SPECIALIST => [self::DIRECTOR, self::BRANCH_MANAGER],
			self::LEAD_SPECIALIST => [self::DIRECTOR, self::BRANCH_MANAGER],
			self::GREAT_SPECIALIST => [self::DIRECTOR, self::BRANCH_MANAGER],
			self::SENIOR_SPECIALIST => [self::DIRECTOR, self::BRANCH_MANAGER],
			self::BRANCH_MANAGER => [self::DIRECTOR],
			self::DIRECTOR => [
						1 => [self::CHAIRMAN_OF_BOARD],
						2 => [self::DEPUTY_CHAIRMAN_OF_BOARD],
						3 => [self::DEPUTY_CHAIRMAN_OF_BOARD]
					],
			self::DEPUTY_CHAIRMAN_OF_BOARD => [self::CHAIRMAN_OF_BOARD],
			self::CHAIRMAN_OF_BOARD => false
		];
	}	
}