<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('client')->nullable()->after('description');
            $table->string('year', 20)->nullable()->after('client');
            $table->string('role')->nullable()->after('year');
            $table->text('challenge')->nullable()->after('role');
            $table->text('solution')->nullable()->after('challenge');
            $table->text('outcome')->nullable()->after('solution');
        });

        // Backfill slugs for existing projects
        $used = [];
        foreach (DB::table('projects')->orderBy('id')->get(['id', 'title']) as $project) {
            $base = Str::slug($project->title) ?: 'project';
            $slug = $base;
            $i = 1;
            while (in_array($slug, $used, true)) {
                $slug = $base.'-'.$i++;
            }
            $used[] = $slug;
            DB::table('projects')->where('id', $project->id)->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'client', 'year', 'role', 'challenge', 'solution', 'outcome']);
        });
    }
};
