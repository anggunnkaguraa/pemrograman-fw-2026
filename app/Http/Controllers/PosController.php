<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        return view('pos.index'); //mengarah ke folder views/pos/index.blade.php
    }

    public function store(Request $request)
    {
    }
}
