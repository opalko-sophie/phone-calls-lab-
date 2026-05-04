<?php

namespace App\Http\Controllers;

class CallController extends Controller
{
    public function index()
    {
        $calls = [
            ['id' => 1, 'client' => 'Іван Петренко', 'phone' => '+380671112233'],
            ['id' => 2, 'client' => 'Марія Коваль', 'phone' => '+380931234567'],
        ];

        return view('calls', compact('calls'));
    }
}