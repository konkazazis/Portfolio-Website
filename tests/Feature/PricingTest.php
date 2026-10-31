<?php

use App\Livewire\Admin\Pricing\PricingManager;
use App\Models\PricingPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

function pricingAdmin(): User
{
    return tap(User::factory()->create(), fn (User $user) => $user->forceFill(['is_admin' => true])->save());
}

test('the homepage shows the estimates and care tiers', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSeeInOrder(['Simple Website', '€990', 'Business Website', '€2,500', 'Custom Software', '€6,000'])
        ->assertSeeInOrder(['Essential', '€50', '/month', 'Standard', '€100', 'Premium', '€200'])
        ->assertSee('from €50* per month');
});

test('only care prices carry the asterisk', function () {
    $this->get(route('home'))
        ->assertSee('€100<span class="text-[#FFE45C]">*</span>', false)
        ->assertDontSee('€2,500<span', false);
});

test('each disclaimer shows under its own plans', function () {
    $this->get(route('home'))
        ->assertSeeInOrder(['Custom Software', 'Paying in installments is possible', 'Premium', 'Care Package prices are not final']);

    PricingPlan::where('category', PricingPlan::CARE)->update(['is_active' => false]);

    $this->get(route('home'))
        ->assertSee('Paying in installments is possible')
        ->assertDontSee('Care Package prices are not final');
});

test('hidden plans stay off the homepage', function () {
    PricingPlan::where('name', 'Premium')->update(['is_active' => false]);

    $this->get(route('home'))->assertOk()->assertDontSee('Premium');
});

test('the homepage still works with no plans', function () {
    PricingPlan::query()->delete();

    $this->get(route('home'))->assertOk()->assertDontSee('Care Package</h3>', false);
});

test('the pricing admin is only for admins', function () {
    $this->get(route('admin.pricing.index'))->assertRedirect();

    $this->actingAs(User::factory()->create())
        ->get(route('admin.pricing.index'))
        ->assertForbidden();

    $this->actingAs(pricingAdmin())
        ->get(route('admin.pricing.index'))
        ->assertOk()
        ->assertSee('Business Website');
});

test('an admin can change a plan and the homepage follows', function () {
    $plan = PricingPlan::where('name', 'Essential')->first();

    Livewire::actingAs(pricingAdmin())
        ->test(PricingManager::class)
        ->call('openEdit', $plan->id)
        ->assertSet('price', '50')
        ->assertSet('features', implode("\n", $plan->features))
        ->set('price', '60')
        ->set('features', "Hosting\n\n  Backups  \r\nUpdates\n")
        ->call('save')
        ->assertHasNoErrors();

    expect($plan->fresh())
        ->price->toBe(60)
        ->features->toBe(['Hosting', 'Backups', 'Updates']);

    $this->get(route('home'))->assertSee('from €60* per month');
});

test('an admin can add a plan', function () {
    Livewire::actingAs(pricingAdmin())
        ->test(PricingManager::class)
        ->call('openCreate')
        ->assertSet('sort_order', '4')
        ->set('category', PricingPlan::CARE)
        ->set('name', 'Enterprise')
        ->set('price', '400')
        ->set('features', 'Everything in Premium')
        ->call('save')
        ->assertHasNoErrors();

    $this->get(route('home'))->assertSeeInOrder(['Premium', 'Enterprise', '€400']);
});

test('an admin can hide and delete a plan', function () {
    $plan = PricingPlan::where('name', 'Premium')->first();

    $manager = Livewire::actingAs(pricingAdmin())
        ->test(PricingManager::class)
        ->call('toggle', $plan->id);

    expect($plan->fresh()->is_active)->toBeFalse();

    $manager->call('confirmDelete', $plan->id)->call('delete');

    expect(PricingPlan::find($plan->id))->toBeNull();
});

test('plans are validated', function (string $field, string $value) {
    Livewire::actingAs(pricingAdmin())
        ->test(PricingManager::class)
        ->call('openCreate')
        ->set('name', 'Plan')
        ->set('price', '100')
        ->set('features', 'One')
        ->set($field, $value)
        ->call('save')
        ->assertHasErrors($field);
})->with([
    'no name' => ['name', ''],
    'no price' => ['price', ''],
    'negative price' => ['price', '-1'],
    'decimal price' => ['price', '9.50'],
    'blank features' => ['features', "  \n "],
    'unknown section' => ['category', 'other'],
]);
