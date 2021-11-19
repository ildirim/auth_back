<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\AuthUserService;
use App\Services\ResponseService;

class AuthUserController extends Controller
{
     private $authUserService;
     public function __construct(AuthUserService $authUserService)
     {
          $this->authUserService = $authUserService;
     }

     public function entranceOrExit($id)
     {
          $response = app(ResponseService::class)->response($this->authUserService->entranceOrExit($id));
          return response()->json($response['response'], $response['code']);
     }

     public function getAuthUsersByDate(Request $request)
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
