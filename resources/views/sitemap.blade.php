<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ route('home') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ route('about') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    <url>
        <loc>{{ route('contact') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
    </url>

    <url>
        <loc>{{ route('website-finder') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('blog') }}</loc>
        <lastmod>{{ $latestPostDate->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    @foreach($categories as $category)
    <url>
        <loc>{{ route('blog', ['category' => $category->slug]) }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    <url>
        <loc>{{ route('work') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach($projects as $project)
    <url>
        <loc>{{ route('work.show', $project->slug) }}</loc>
        <lastmod>{{ $project->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    <url>
        <loc>{{ route('library') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    @foreach(array_keys(config('library')) as $slug)
    <url>
        <loc>{{ route('library.show', $slug) }}</loc>
        <lastmod>{{ \App\Http\Controllers\LibraryController::updatedAt($slug)->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    @foreach($posts as $post)
    <url>
        <loc>{{ route('posts.show', $post->slug) }}</loc>
        <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

</urlset>
