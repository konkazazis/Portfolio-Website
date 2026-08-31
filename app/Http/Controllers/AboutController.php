<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function index()
    {
        return view('layouts.about');
    }
}

?>