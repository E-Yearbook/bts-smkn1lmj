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
        Schema::table('year_covers', function (Blueprint $table) {
            $table->string('title_video_sambutan')->nullable()->change();
            $table->text('youtube_link_sambutan')->nullable()->change();
            $table->string('title_video_angkatan')->nullable()->change();
            $table->text('youtube_link_angkatan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('year_covers', function (Blueprint $table) {
            //
        });
    }
};
