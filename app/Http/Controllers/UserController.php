<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ResponseService;

class UserController extends Controller
{
     private $userService;
     
     public function __construct(UserService $userService)
     {
          $this->userService = $userService;
     }

     public function index()
     {
          $response = app(ResponseService::class)->response($this->userService->list());
          return response()->json($response['response'], $response['code']);
          
     }

     public function activeUsers()
     {
          $response = app(ResponseService::class)->response($this->userService->activeUsers());
          return response()->json($response['response'], $response['code']);
     }

     public function userById($id)
     {
          $user = $this->userService->userById($id);
          $response = app(ResponseService::class)->response($user);
          return response()->json($response['response'], $response['code']);
     }

     public function store(Request $request)
     {
          $response = app(ResponseService::class)->response($this->userService->store($request));
          return response()->json($response['response'], $response['code']);
     }

     public function update($id, Request $request)
     {
          $response = app(ResponseService::class)->response($this->userService->update($id, $request));
          return response()->json($response['response'], $response['code']);
     }

     public function delete($id, Request $request)
     {
          $response = app(ResponseService::class)->response($this->userService->delete($id, $request));
          return response()->json($response['response'], $response['code']);
     }
}