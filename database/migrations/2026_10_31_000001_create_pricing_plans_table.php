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
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->unsignedInteger('price');
            $table->json('features');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // Starter plans, so the pricing section has something to show straight away.
        $now = now();

        DB::table('pricing_plans')->insert(array_map(fn ($plan) => [
            ...$plan,
            'features' => json_encode($plan['features']),
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ], [
            [
                'category' => 'website',
                'name' => 'Simple Website',
                'tagline' => 'A polished online home for your small business.',
                'price' => 990,
                'features' => [
                    'Up to 5 pages, designed from scratch',
                    'Custom-made CMS to manage your own content',
                    'Lightning-fast, app-like load times',
                    'Google Lighthouse score of 100 across the board',
                    'On-point technical SEO',
                    'Mobile-friendly design',
                    'Domain purchase with SSL',
                    'Hosting and business email setup',
                ],
                'is_featured' => false,
                'sort_order' => 1,
            ],
            [
                'category' => 'website',
                'name' => 'Business Website',
                'tagline' => 'A bigger site that brings in customers and grows with you.',
                'price' => 2500,
                'features' => [
                    'Everything in Simple Website',
                    'Up to 15 pages',
                    'Blog or news section',
                    'Booking, enquiry or quote forms',
                    'Analytics to see what brings in customers',
                ],
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'category' => 'website',
                'name' => 'Custom Software',
                'tagline' => 'A web app built around the way your business works.',
                'price' => 6000,
                'features' => [
                    'Custom-made, secure Laravel-based application',
                    'User accounts, dashboards and admin tools',
                    'Workflows that replace spreadsheets and manual work',
                    'Integrations with the tools you already use',
                    'Scoped together before any code is written',
                ],
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'category' => 'care',
                'name' => 'Essential',
                'tagline' => 'Keeps your site online, safe and backed up.',
                'price' => 50,
                'features' => [
                    'Hosting',
                    'Database backups',
                    'Software and security updates',
                    'Weekly uptime checks',
                ],
                'is_featured' => false,
                'sort_order' => 1,
            ],
            [
                'category' => 'care',
                'name' => 'Standard',
                'tagline' => 'Small changes handled, without thinking about it.',
                'price' => 100,
                'features' => [
                    'Everything in Essential',
                    '1 hour of edits included every month',
                    'SEO and performance monitoring',
                ],
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'category' => 'care',
                'name' => 'Premium',
                'tagline' => 'For sites that change often and need to keep improving.',
                'price' => 200,
                'features' => [
                    'Everything in Standard',
                    '3 hours of edits included every month',
                    'Priority response on every request',
                ],
                'is_featured' => false,
                'sort_order' => 3,
            ],
        ]));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_plans');
    }
};
