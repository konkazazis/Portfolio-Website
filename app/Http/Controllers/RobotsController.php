<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function index(): Response
    {
        return response()
            ->view('robots')
            ->header('Content-Type', 'text/plain');
    }
}
