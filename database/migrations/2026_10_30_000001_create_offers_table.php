<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('headline');
            $table->text('details')->nullable();
            $table->date('ends_at')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        // Starter offers, so there is something to switch on straight away.
        $now = now();

        DB::table('offers')->insert(array_map(fn ($offer) => $offer + [
            'ends_at' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ], [
            [
                'name' => 'Free Care Package',
                'headline' => '3 months of Care Package free',
                'details' => 'Hosting, backups, monthly edits and security updates, on me.',
                'is_active' => true,
            ],
            [
                'name' => 'Free homepage copy',
                'headline' => 'Your homepage text, written for free',
                'details' => "No staring at a blank page. I'll write the words that turn visitors into customers.",
                'is_active' => false,
            ],
            [
                'name' => 'Google Business Profile',
                'headline' => 'Free Google Business Profile setup',
                'details' => 'Set up and optimised so locals find you on Google Maps, not just your competitors.',
                'is_active' => false,
            ],
            [
                'name' => 'Two extra pages',
                'headline' => '2 extra pages included, free',
                'details' => 'A services page, a gallery, an FAQ: whatever your site needs, at no extra cost.',
                'is_active' => false,
            ],
            [
                'name' => 'Priority start',
                'headline' => 'Priority start within 7 days',
                'details' => 'Skip the queue: work on your site begins within a week of saying yes.',
                'is_active' => false,
            ],
        ]));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
