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
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->index();
            $table->foreignId('body_type_id')->constrained();
            $table->foreignId('vehicle_category_id')->nullable()->constrained();
            $table->year('year_start');
            $table->year('year_end')->nullable();
            $table->string('official_image_url')->nullable();
            $table->decimal('base_msrp', 10, 2)->nullable();
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->integer('popularity_score')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['brand_id', 'slug']);
            $table->index('body_type_id');
            $table->index('vehicle_category_id');
            $table->index('is_active');
            $table->index(['year_start', 'year_end']);
            $table->index('popularity_score');
        });

        Schema::create('car_model_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unique(['car_model_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_model_translations');
        Schema::dropIfExists('car_models');
    }
};
