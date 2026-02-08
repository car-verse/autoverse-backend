<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feature_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 150)->unique();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('feature_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_category_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->string('name', 150);
            $table->unique(['feature_category_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_category_translations');
        Schema::dropIfExists('feature_categories');
    }
};
