<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PositionService;
use App\Services\ResponseService;

class PositionController extends Controller
{
	private $positionService;
	
	public function __construct(PositionService $positionService)
	{
		$this->positionService = $positionService;
	}

	public function positions()
	{
		$response = app(ResponseService::class)->response($this->positionService->positions());
		return response()->json($response['response'], $response['code']);
		
	}

	public function activePositions()
	{
		$response = app(ResponseService::class)->response($this->positionService->activePositions());
		return response()->json($response['response'], $response['code']);
	}

	public function positionById($id)
	{
		$position = $this->positionService->positionById($id);
		$response = app(ResponseService::class)->response($position);
		return response()->json($response['response'], $response['code']);
	}

	public function store(Request $request)
	{
		$response = app(ResponseService::class)->response($this->positionService->store($request));
		return response()->json($response['response'], $response['code']);
	}

	public function update($id, Request $request)
	{
		$response = app(ResponseService::class)->response($this->positionService->update($id, $request));
		return response()->json($response['response'], $response['code']);
	}

	public function delete($id, Request $request)
	{
		$response = app(ResponseService::class)->response($this->positionService->delete($id, $request));
		return response()->json($response['response'], $response['code']);
	}
}