<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('front/index');
    }

    public function about()
    {
        return view('front/about');
    }

    public function price()
    {
        return view('front/price');
    }

    public function faq()
    {
        return view('front/faq');
    }

    public function contact()
    {
        return view('front/contact');
    }

    public function register()
    {
        return view('front/register');
    }

    public function login()
    {
        return view('front/login');
    }
}
