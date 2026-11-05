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
        if (Schema::hasTable('projects') && !Schema::hasColumn('projects', 'status')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('status', 20)->default('published')->after('order');
            });
        }

        if (Schema::hasTable('services') && !Schema::hasColumn('services', 'status')) {
            Schema::table('services', function (Blueprint $table) {
                $table->string('status', 20)->default('published')->after('order');
            });
        }

        if (Schema::hasTable('testimonials') && !Schema::hasColumn('testimonials', 'status')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->string('status', 20)->default('published')->after('order');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('projects') && Schema::hasColumn('projects', 'status')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        if (Schema::hasTable('services') && Schema::hasColumn('services', 'status')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        if (Schema::hasTable('testimonials') && Schema::hasColumn('testimonials', 'status')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
