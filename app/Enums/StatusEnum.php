<?php

namespace App\Enums;

class StatusEnum
{
	const DELETED = 'Deleted';
	const DELETED_ID = 0;
	const ACTIVE = 'Active';
	const ACTIVE_ID = 1;
	const DEACTIVE = 'Deactive';
	const DEACTIVE_ID = 2;

	public static function getStatusList()
	{
		return [
			self::ACTIVE_ID => self::ACTIVE,
			self::DEACTIVE_ID => self::DEACTIVE
		];
	}
}
	