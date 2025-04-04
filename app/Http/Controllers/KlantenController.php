<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medewerker;
use App\Models\Behandeling;

class KlantenController extends Controller
{
    public function index()
    {
        $isAuthenticated = Auth::guard('klant')->check();
        $klant = $isAuthenticated ? Auth::guard('klant')->user() : null;
        
        $data = [
            'isAuthenticated' => $isAuthenticated,
            'klant' => $klant
        ];
        
        if ($isAuthenticated) {
            $data['medewerkers'] = Medewerker::all();
            $data['behandelingen'] = Behandeling::all();
        }
        
        return view('klanten.index', $data);
    }
} 