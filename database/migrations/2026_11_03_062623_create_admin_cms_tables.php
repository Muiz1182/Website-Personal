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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('Videography'); // Videography, Design, Web Developer
            $table->string('tag')->nullable();
            $table->string('year', 10)->default('2024');
            $table->string('specs')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->string('span')->default('col-span-1 md:col-span-1');
            $table->string('aspect')->default('aspect-[4/3]');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('number', 10)->default('01');
            $table->string('title');
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->json('deliverables')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('creator_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('MOCHAMMAD MUIZ AFDLOLY');
            $table->string('role')->nullable();
            $table->text('headline')->nullable();
            $table->text('bio')->nullable();
            $table->text('image')->nullable();
            $table->json('disciplines')->nullable();
            $table->json('stats')->nullable();
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('project')->nullable();
            $table->text('quote');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('creator_profiles');
        Schema::dropIfExists('services');
        Schema::dropIfExists('projects');
    }
};
