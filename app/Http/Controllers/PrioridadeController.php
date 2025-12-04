<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrioridadeController extends Controller
{
    public function index()
    {
        return view('prioridades.index');
    }
}
