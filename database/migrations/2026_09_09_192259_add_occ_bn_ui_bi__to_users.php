<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('brand_name')->nullable();
            $table->string('occupation')->nullable();
            $table->string('user_profile_image')->nullable();
            $table->string('brand_icon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['brand_name', 'occupation', 'user_profile_image', 'brand_icon']);
        });
    }
};
