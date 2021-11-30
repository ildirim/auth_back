<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BranchService;
use App\Services\ResponseService;

class BranchController extends Controller
{
	private $branchService;
	
	public function __construct(BranchService $branchService)
	{
		$this->branchService = $branchService;
	}

	public function index()
	{
		$response = app(ResponseService::class)->response($this->branchService->list());
		return response()->json($response['response'], $response['code']);
		
	}

	public function activeBranches()
	{
		$response = app(ResponseService::class)->response($this->branchService->activeBranches());
		return response()->json($response['response'], $response['code']);
	}

	public function childrenBranches()
	{
		$response = app(ResponseService::class)->response($this->branchService->childrenBranches());
		return response()->json($response['response'], $response['code']);
	}

	public function branchById($id)
	{
		$branch = $this->branchService->branchById($id);
		$response = app(ResponseService::class)->response($branch);
		return response()->json($response['response'], $response['code']);
	}

	public function branchesByParentId($parentId)
	{
		$branch = $this->branchService->branchesByParentId($parentId);
		$response = app(ResponseService::class)->response($branch);
		return response()->json($response['response'], $response['code']);
	}

	public function store(Request $request)
	{
		$response = app(ResponseService::class)->response($this->branchService->store($request));
		return response()->json($response['response'], $response['code']);
	}

	public function update($id, Request $request)
	{
		$response = app(ResponseService::class)->response($this->branchService->update($id, $request));
		return response()->json($response['response'], $response['code']);
	}

	public function delete($id, Request $request)
	{
		$response = app(ResponseService::class)->response($this->branchService->delete($id, $request));
		return response()->json($response['response'], $response['code']);
	}
}