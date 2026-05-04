<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }
}