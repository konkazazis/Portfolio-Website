<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $bookingUrl = config('services.booking.url');

        return view('contact', compact('bookingUrl'));
    }
}
