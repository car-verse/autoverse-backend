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
        Schema::table('brands', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
            $table->year('founded')->nullable()->after('slug');
            $table->integer('popularity_score')->default(0)->after('founded');

            $table->index('slug');
            $table->index('popularity_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn(['slug', 'founded', 'popularity_score']);
            $table->dropIndex(['slug', 'popularity_score']);
        });
    }
};
