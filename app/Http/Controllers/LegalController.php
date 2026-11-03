<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class LegalController extends Controller
{
    public function impressum(): View
    {
        return view('impressum');
    }

    public function privacy(): View
    {
        return view('privacy');
    }
}
