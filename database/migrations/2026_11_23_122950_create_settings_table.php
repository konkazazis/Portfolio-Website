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
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // The pricing disclaimers that used to be hardcoded, so the site reads the same after migrating.
        $now = now();

        DB::table('settings')->insert([
            [
                'key' => 'pricing.disclaimer.website',
                'value' => 'Paying in installments is possible, just ask when you get your quote.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'pricing.disclaimer.care',
                'value' => 'Care Package prices are not final because domain and hosting costs change.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
