<?php

use App\Livewire\WebsiteFinder;
use App\Models\Lead;
use App\Models\User;
use App\Notifications\NewLeadReceived;
use App\Notifications\WebsiteFinderReport;
use App\Support\StarterHomepage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

uses(RefreshDatabase::class);

function finderLead(array $answers = []): Lead
{
    return Lead::create([
        'email' => 'lead@example.com',
        'answers' => $answers + ['industry' => 'food', 'style' => 'bold', 'colors' => 'vibrant', 'content' => ['headline' => 'Pizza by the slice']],
        'result' => ['title' => 'Olive & Ember'],
        'score' => 0,
    ]);
}

test('the signed link shows the designed homepage in the browser', function () {
    $this->get(StarterHomepage::url(finderLead(), preview: true))
        ->assertOk()
        ->assertHeaderMissing('Content-Disposition')
        ->assertSee('Olive &amp; Ember', false)
        ->assertSee('Pizza by the slice')
        ->assertDontSee('data-field', false);
});

test('the signed link downloads the homepage as a file', function () {
    $this->get(StarterHomepage::url(finderLead()))
        ->assertOk()
        ->assertDownload('olive-ember-homepage.html');
});

test('unsigned or tampered links are rejected', function () {
    $lead = finderLead();

    $this->get(route('website-finder.homepage', $lead))->assertForbidden();
    $this->get(str_replace("/{$lead->id}?", '/999?', StarterHomepage::url($lead)))->assertForbidden();
});

test('homepages saved by the old quiz still open', function () {
    $lead = Lead::create([
        'email' => 'old@example.com',
        'answers' => ['purpose' => 'shop', 'industry' => 'retail', 'style' => 'dark', 'colors' => 'luxury', 'features' => ['gallery'], 'timeline' => 'flexible'],
        'result' => ['title' => 'Dark & techy Online Shop', 'tier' => 'Growth', 'weeks' => '4–6 weeks'],
        'score' => 3,
    ]);

    $this->get(StarterHomepage::url($lead, preview: true))
        ->assertOk()
        ->assertSee('Goods &amp; Grain', false);
});

test('user text is escaped on the homepage and in the email', function () {
    $lead = finderLead(['content' => ['name' => '<script>alert(1)</script>']]);

    $this->get(StarterHomepage::url($lead, preview: true))
        ->assertOk()
        ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
        ->assertDontSee('<script>alert(1)</script>', false);

    $mail = (new WebsiteFinderReport($lead))->toMail(new AnonymousNotifiable)->render();

    expect((string) $mail)
        ->toContain('&lt;script&gt;')
        ->not->toContain('<script>alert(1)</script>');
});

test('a custom colour gets readable button text', function (string $color, string $buttonText) {
    $html = StarterHomepage::render(['industry' => 'food', 'colors' => 'custom', 'custom_color' => $color]);

    expect($html)
        ->toContain("--primary: {$color};")
        ->toContain("--on-primary: {$buttonText};");
})->with([
    'light colour' => ['#FFE45C', '#1C1B22'],
    'dark colour' => ['#1E3A8A', '#FFFFFF'],
]);

test('the designer ignores looks and colours that are not on offer', function () {
    Livewire::test(WebsiteFinder::class)
        ->call('start', 'food')
        ->call('pickStyle', 'corporate')
        ->call('pickColor', 'luxury')
        ->call('pickCustomColor', 'red;} body{display:none')
        ->assertSet('style', 'minimal')
        ->assertSet('colors', 'cool');
});

test('saving a design creates a lead with only the text they changed', function () {
    Notification::fake();
    $admin = User::factory()->create(['is_admin' => true]);

    Livewire::test(WebsiteFinder::class)
        ->set('businessName', 'Luigi’s')
        ->call('start', 'food')
        ->call('pickStyle', 'warm')
        ->call('pickCustomColor', '#E8590C')
        ->set('content.headline', 'Pizza   by the slice ')
        ->set('content.intro', config('starter-homepage.industries.food.intro'))
        ->set('content.is_admin', 'yes')
        ->set('content.quote', str_repeat('a', 400))
        ->set('email', 'new@example.com')
        ->set('timeline', 'asap')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('panel', 'saved')
        ->assertSee('Your homepage is saved.');

    $lead = Lead::sole();
    expect($lead->answers)->toBe([
        'industry' => 'food',
        'style' => 'warm',
        'colors' => 'custom',
        'custom_color' => '#E8590C',
        'content' => ['name' => 'Luigi’s', 'headline' => 'Pizza by the slice', 'quote' => str_repeat('a', 300)],
        'timeline' => 'asap',
    ]);
    expect($lead->score)->toBe(5);
    expect($lead->result['title'])->toBe('Luigi’s');
    Notification::assertSentTo($admin, NewLeadReceived::class);
    Notification::assertSentOnDemand(WebsiteFinderReport::class);
});

test('saving again updates the same lead without new emails', function () {
    Notification::fake();

    $designer = Livewire::test(WebsiteFinder::class)
        ->call('start', 'local')
        ->set('email', 'new@example.com')
        ->call('save');
    Notification::fake();

    $designer->call('pickStyle', 'bold')->call('save');

    expect(Lead::sole()->answers['style'])->toBe('bold');
    Notification::assertNothingSent();
});

test('a design is not saved without a valid email', function () {
    Notification::fake();

    Livewire::test(WebsiteFinder::class)
        ->call('start', 'local')
        ->set('email', 'not-an-email')
        ->call('save')
        ->assertHasErrors(['email'])
        ->assertSet('panel', 'design');

    expect(Lead::count())->toBe(0);
    Notification::assertNothingSent();
});
