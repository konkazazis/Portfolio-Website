<?php

use App\Livewire\WebsiteFinder;
use App\Models\Lead;
use App\Support\StarterHomepage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

uses(RefreshDatabase::class);

function finderLead(): Lead
{
    return Lead::create([
        'email' => 'lead@example.com',
        'answers' => ['purpose' => 'shop', 'industry' => 'food', 'style' => 'bold', 'colors' => 'vibrant', 'features' => ['gallery']],
        'result' => [],
        'score' => 0,
    ]);
}

test('the signed link previews the homepage in the browser', function () {
    $this->get(StarterHomepage::url(finderLead(), preview: true))
        ->assertOk()
        ->assertHeaderMissing('Content-Disposition')
        ->assertSee('Olive &amp; Ember', false)
        ->assertSee('Best sellers');
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

test('unlocking the finder shows the homepage preview and download', function () {
    Notification::fake();

    Livewire::test(WebsiteFinder::class)
        ->set('answers', finderLead()->answers + ['starting_point' => 'new', 'timeline' => 'flexible'])
        ->set('step', count(config('website-finder.steps')))
        ->set('email', 'new@example.com')
        ->call('unlock')
        ->assertSet('unlocked', true)
        ->assertSee('Your free homepage')
        ->assertSee('Download homepage');
});
