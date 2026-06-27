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
        if (!Schema::hasTable('year_covers')) {
            return;
        }

        if (!Schema::hasColumn('year_covers', 'title_video_sambutan')) {
            Schema::table('year_covers', function (Blueprint $table) {
                $table->string('title_video_sambutan')->nullable();
            });
        }

        if (!Schema::hasColumn('year_covers', 'youtube_link_sambutan')) {
            Schema::table('year_covers', function (Blueprint $table) {
                $table->text('youtube_link_sambutan')->nullable();
            });
        }

        if (!Schema::hasColumn('year_covers', 'title_video_angkatan')) {
            Schema::table('year_covers', function (Blueprint $table) {
                $table->string('title_video_angkatan')->nullable();
            });
        }

        if (!Schema::hasColumn('year_covers', 'youtube_link_angkatan')) {
            Schema::table('year_covers', function (Blueprint $table) {
                $table->text('youtube_link_angkatan')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('year_covers')) {
            return;
        }

        if (Schema::hasColumn('year_covers', 'title_video_sambutan')) {
            Schema::table('year_covers', function (Blueprint $table) {
                $table->dropColumn('title_video_sambutan');
            });
        }

        if (Schema::hasColumn('year_covers', 'youtube_link_sambutan')) {
            Schema::table('year_covers', function (Blueprint $table) {
                $table->dropColumn('youtube_link_sambutan');
            });
        }

        if (Schema::hasColumn('year_covers', 'title_video_angkatan')) {
            Schema::table('year_covers', function (Blueprint $table) {
                $table->dropColumn('title_video_angkatan');
            });
        }

        if (Schema::hasColumn('year_covers', 'youtube_link_angkatan')) {
            Schema::table('year_covers', function (Blueprint $table) {
                $table->dropColumn('youtube_link_angkatan');
            });
        }
    }
};
