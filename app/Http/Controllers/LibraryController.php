<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class LibraryController extends Controller
{
    public function index(): View
    {
        $components = collect(config()->array('library'));

        return view('library', compact('components'));
    }

    public function show(string $slug): View
    {
        $component = config("library.{$slug}");
        abort_unless($component, 404);

        $code = trim(File::get(static::componentPath($slug)));
        $updatedAt = static::updatedAt($slug);

        $slugs = array_keys(config('library'));
        $index = array_search($slug, $slugs, true);
        $nextSlug = $slugs[($index + 1) % count($slugs)];
        $next = [...config("library.{$nextSlug}"), 'slug' => $nextSlug];

        return view('library-component', compact('slug', 'component', 'code', 'updatedAt', 'next'));
    }

    public static function componentPath(string $slug): string
    {
        return resource_path("views/library/components/{$slug}.blade.php");
    }

    public static function updatedAt(string $slug): Carbon
    {
        return Carbon::createFromTimestamp(File::lastModified(static::componentPath($slug)));
    }
}
