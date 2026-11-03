<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index(): RedirectResponse|View
    {
        // Old blog URLs lived on "/" — send them to the blog
        if (request()->hasAny(['category', 'search', 'page'])) {
            return redirect()->route('blog', request()->query(), 301);
        }

        return view('home', [
            'plans' => PricingPlan::query()->where('is_active', true)->ordered()->get(),
        ]);
    }
}
