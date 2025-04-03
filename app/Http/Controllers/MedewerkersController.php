<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedewerkersController extends Controller
{
    public function index()
    {
        return view('medewerkers.index');
    }
} 