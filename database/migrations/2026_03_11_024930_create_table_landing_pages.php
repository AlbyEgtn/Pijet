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
       Schema::create('landing_pages', function (Blueprint $table) {

            $table->id();

            // HERO
            $table->string('hero_image')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();

            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_link')->nullable();

            $table->string('app_button_text')->nullable();
            $table->string('app_button_link')->nullable();

            // ABOUT
            $table->string('about_image')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();

            // LAYANAN
            $table->string('service_title')->nullable();
            $table->text('service_description')->nullable();

            // TERAPIS
            $table->string('therapist_title')->nullable();
            $table->text('therapist_description')->nullable();

            // JOIN
            $table->string('join_title')->nullable();
            $table->text('join_description')->nullable();
            $table->string('join_image')->nullable();

            // APP
            $table->string('download_title')->nullable();
            $table->text('download_description')->nullable();
            $table->string('download_image')->nullable();

            $table->timestamps();

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_landing_pages');
    }
};
