<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlantenController extends Controller
{
    public function index()
    {
        $isAuthenticated = Auth::guard('klant')->check();
        $klant = $isAuthenticated ? Auth::guard('klant')->user() : null;
        
        return view('klanten.index', [
            'isAuthenticated' => $isAuthenticated,
            'klant' => $klant
        ]);
    }
} 