<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function impressum()
    {
        return view('impressum');
    }

    public function privacy()
    {
        return view('privacy');
    }
}
