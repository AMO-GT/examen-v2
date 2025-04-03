<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlantenController extends Controller
{
    public function index()
    {
        return view('klanten.index');
    }
} 