<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Support\StarterHomepage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StarterHomepageController extends Controller
{
    /**
     * The free homepage a lead unlocked: shown in the browser with ?preview=1, downloaded otherwise.
     */
    public function __invoke(Request $request, Lead $lead)
    {
        $html = StarterHomepage::render($lead->answers);

        if ($request->boolean('preview')) {
            return response($html)->header('X-Robots-Tag', 'noindex');
        }

        $filename = Str::slug(config('starter-homepage.industries.'.($lead->answers['industry'] ?? 'other').'.name', 'homepage')).'-homepage.html';

        return response()->streamDownload(fn () => print ($html), $filename, ['Content-Type' => 'text/html; charset=UTF-8']);
    }
}
