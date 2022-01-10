<?php

namespace App\Services;

use App\Models\Position;

class PositionService
{
	private $position;

	public function __construct()
	{
		$this->position = new Position();
	}

	public function positions()
	{
		return $this->position->where('status', '<>', 2)->orderBy('id', 'desc')->get();
	}

	public function activePositions()
	{
		return $this->position->where('status', 1)->orderBy('id', 'desc')->get();
	}

	public function positionById($id)
	{
		return $this->position->where('id', $id)->first();
	}

	public function positionByName($name)
	{
		return $this->position->where('name', $name)->first();
	}

	public function store($data)
	{
		$request = [
			'name' => $data['name'],
			'status' => $data['status']
		];
		$position = $this->position->create($request);
		
		return $position->id;
	}

	public function storeAndGetId($data)
	{
		$position = $this->positionByName($data->POSITION);
		if(!$position)
		{
			$data = [
				'name' => $data->POSITION,
				'status' => 1
			];
			$positionId = $this->store($data);
		}
		else
			$positionId = $position->id;

		return $positionId;
	}

	public function update($id, $data)
	{
		$request = [
			'name' => $data['name'],
			'status' => $data['status'] ?? 1
		];
		return $this->position->where('id', $id)
   				     			  ->update($request);
	}

	public function delete($id, $data)
	{
		$request = [
			'status' => $data['status']
		];
		return $this->position->where('id', $id)
   				     			  ->update($request);
	}
}
