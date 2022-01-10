<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;
use App\Enums\StatusEnum;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::paginate(15)
        ];

        return view('user/index', $data);
    }
}
