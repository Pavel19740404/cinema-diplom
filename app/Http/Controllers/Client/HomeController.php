<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\Seance;

class HomeController extends Controller
{
    public function index()
    {
        $halls = Hall::where('is_open', true)->with(['seances.film'])->get();
        return view('client.index', compact('halls'));
    }
}