<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Support\StarterHomepage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StarterHomepageController extends Controller
{
    /**
     * The homepage a lead designed: shown in the browser with ?preview=1, downloaded otherwise.
     */
    public function __invoke(Request $request, Lead $lead): Response|StreamedResponse
    {
        $html = StarterHomepage::render($lead->answers);

        if ($request->boolean('preview')) {
            return response($html)->header('X-Robots-Tag', 'noindex');
        }

        $filename = (Str::slug(StarterHomepage::copy($lead->answers)['name']) ?: 'my').'-homepage.html';

        return response()->streamDownload(fn () => print ($html), $filename, ['Content-Type' => 'text/html; charset=UTF-8']);
    }
}
