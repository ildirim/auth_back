<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\AuthUserService;
use App\Services\ResponseService;

class ReportController extends Controller
{
     private $authUserService;
     public function __construct(AuthUserService $authUserService)
     {
          $this->authUserService = $authUserService;
     }

     public function getReportsByDate(Request $request)
     {
          $response = app(ResponseService::class)->response($this->authUserService->getAuthUsersByDate($request));
          return response()->json($response['response'], $response['code']);
     }
     
     public function update($id, Request $request)
     {
          $response = app(ResponseService::class)->response($this->authUserService->update($id, $request));
          return response()->json($response['response'], $response['code']);
     }
}    
