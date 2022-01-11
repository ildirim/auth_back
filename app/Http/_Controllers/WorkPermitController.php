<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WorkPermitService;
use App\Services\ResponseService;

class WorkPermitController extends Controller
{
	private $workPermitService;
	
	public function __construct(WorkPermitService $workPermitService)
	{
		$this->workPermitService = $workPermitService;
	}

	public function workPermits()
	{
		$response = app(ResponseService::class)->response($this->workPermitService->workPermits());
		return response()->json($response['response'], $response['code']);
		
	}

	public function pendingWorkPermitsByUserId($userId)
	{
		$response = app(ResponseService::class)->response($this->workPermitService->pendingWorkPermitsByUserId($userId));
		return response()->json($response['response'], $response['code']);
	}

	public function workPermitsByUserId($userId)
	{
		$response = app(ResponseService::class)->response($this->workPermitService->workPermitsByUserId($userId));
		return response()->json($response['response'], $response['code']);
	}

	public function workPermitsByUserId2(Request $request)
	{
		$response = app(ResponseService::class)->response($this->workPermitService->workPermitsByUserId2($request));
		return response()->json($response['response'], $response['code']);
	}

	public function workPermitById($id)
	{
		$workPermit = $this->workPermitService->workPermitById($id);
		$response = app(ResponseService::class)->response($workPermit);
		return response()->json($response['response'], $response['code']);
	}

	public function store(Request $request)
	{
		$response = app(ResponseService::class)->response($this->workPermitService->store($request));
		return response()->json($response['response'], $response['code']);
	}

	public function approve($id, Request $request)
	{
		$response = app(ResponseService::class)->response($this->workPermitService->approve($id, $request));
		return response()->json($response['response'], $response['code']);
	}

	public function reject($id, Request $request)
	{
		$response = app(ResponseService::class)->response($this->workPermitService->reject($id, $request));
		return response()->json($response['response'], $response['code']);
	}

	public function update($id, Request $request)
	{
		$response = app(ResponseService::class)->response($this->workPermitService->update($id, $request));
		return response()->json($response['response'], $response['code']);
	}

	public function delete($id, Request $request)
	{
		$response = app(ResponseService::class)->response($this->workPermitService->delete($id, $request));
		return response()->json($response['response'], $response['code']);
	}
}