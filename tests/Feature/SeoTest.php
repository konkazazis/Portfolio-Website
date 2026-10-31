<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function publishedPost(?Category $category = null): Post
{
    return Post::create([
        'user_id' => User::factory()->create()->id,
        'category_id' => $category?->id,
        'title' => 'A published post',
        'content' => 'Body',
        'status' => 'published',
        'published_at' => now()->subDay(),
    ]);
}

test('the blog index stays indexable', function () {
    publishedPost();

    $this->get(route('blog'))
        ->assertOk()
        ->assertDontSee('name="robots"', false);
});

test('category listings are noindexed and left out of the sitemap', function () {
    $category = Category::create(['name' => 'Laravel', 'slug' => 'laravel']);
    publishedPost($category);

    $this->get(route('blog', ['category' => 'laravel']))
        ->assertOk()
        ->assertSee('<meta name="robots" content="noindex, follow">', false);

    $this->get(route('sitemap'))
        ->assertOk()
        ->assertDontSee('category=');
});

test('an unknown category is a 404', function () {
    publishedPost();

    $this->get(route('blog', ['category' => 'nonexistent']))->assertNotFound();
});

test('a page past the end of the blog is a 404', function () {
    publishedPost();

    $this->get(route('blog', ['page' => 2]))->assertNotFound();
});

test('an empty blog still renders', function () {
    $this->get(route('blog'))->assertOk();
});

test('old urls redirect permanently', function (string $from, string $to) {
    $this->get($from)->assertMovedPermanently()->assertRedirect($to);
})->with([
    ['/datenschutz', '/privacy'],
    ['/posts/how-to-create-any-bootable-usb-ready-for-any-os-installation', '/posts/how-to-create-any-bootable-usb-ready-for-any-os-installation-1'],
]);

test('the homepage targets its search terms', function () {
    $response = $this->get(route('home'))
        ->assertOk()
        ->assertSee('<title>Kazazis - Web Developer in Düsseldorf for Small Businesses</title>', false)
        ->assertSee('Web developer in Düsseldorf')
        ->assertSee('"@type": "ProfessionalService"', false);

    expect(substr_count($response->getContent(), '<h1'))->toBe(1);

    preg_match('/name="description"\s+content="([^"]*)"/', $response->getContent(), $description);

    expect(mb_strlen($description[1]))->toBeLessThanOrEqual(160);
});
