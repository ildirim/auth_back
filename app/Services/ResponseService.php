<?php

namespace App\Services;

class ResponseService
{
	private $data;
	public function setData($data)
	{
		$this->data = $data;
	}

	public function getData()
	{
		return $this->data;
	}
	
	public function response($data, $code = SUCCESS, $status = SUCCESS_STATUS)
	{
		try {
			// $success = $data->isEmpty() ? NOT_CONTENT : SUCCESS;
			return [
				'response' => ['code' => $code, 'status' => $status, 'data' => $data],
				'code' => $code
			];
		} catch (Exception $e) {
			return [
				'response' => ['code' => SERVER_ERROR, 'status' => ERROR_STATUS, 'data' => $e->getMessage()],
				'code' => SERVER_ERROR
			];
		}
	}
}