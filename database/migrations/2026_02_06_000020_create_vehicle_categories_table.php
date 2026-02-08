<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 150)->unique();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('vehicle_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_category_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->string('name', 150);
            $table->unique(['vehicle_category_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_category_translations');
        Schema::dropIfExists('vehicle_categories');
    }
};
