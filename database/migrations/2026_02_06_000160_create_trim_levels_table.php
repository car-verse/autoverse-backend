<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trim_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained()->cascadeOnDelete();
            $table->string('slug', 150)->index();
            $table->year('year_start')->nullable();
            $table->year('year_end')->nullable();
            $table->decimal('msrp', 10, 2)->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['car_model_id', 'slug']);
        });

        Schema::create('trim_level_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trim_level_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->string('name', 150);
            $table->string('description', 350)->nullable();
            $table->unique(['trim_level_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trim_level_translations');
        Schema::dropIfExists('trim_levels');
    }
};
