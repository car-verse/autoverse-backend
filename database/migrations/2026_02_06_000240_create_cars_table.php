<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            
            // showroom_id and client_id will be handled later or if showroom table exists
            // OWNERSHIP
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('showroom_id')->nullable(); 
            
            // CAR REFERENCE
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('car_model_id')->constrained();
            $table->foreignId('trim_level_id')->nullable()->constrained();
            
            // BASIC INFO
            $table->year('year');
            $table->string('make', 150); // Denormalized
            $table->string('model', 150); // Denormalized
            $table->string('trim', 150)->nullable();
            $table->string('vin', 250)->unique(); // Vehicle Identification Number
            
            // PRICING
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->unsignedTinyInteger('price_negotiable')->default(1);
            
            // CONDITION
            $table->foreignId('condition_id')->constrained('car_conditions');
            $table->integer('mileage');
            $table->foreignId('mileage_unit_id')->constrained();
            
            // OWNERSHIP HISTORY
            $table->integer('number_of_owners')->default(1);
            $table->foreignId('title_status_id')->constrained();
            
            // PHYSICAL
            $table->string('exterior_color', 150);
            $table->string('interior_color', 150)->nullable();
            $table->foreignId('paint_color_id')->nullable()->constrained();
            
            // SPECS (can override)
            $table->foreignId('transmission_type_id')->nullable()->constrained();
            $table->foreignId('fuel_type_id')->nullable()->constrained();
            $table->foreignId('drive_type_id')->nullable()->constrained();
            $table->integer('doors')->nullable();
            $table->integer('cylinders')->nullable();
            $table->string('engine_size', 250)->nullable();
            
            // LOCATION
            $table->string('location_city', 150)->nullable();
            $table->string('location_state', 150)->nullable();
            $table->string('location_zip', 150)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            
            // STATUS
            $table->foreignId('status_id')->constrained('car_statuses');
            $table->timestampTz('listed_at')->nullable();
            $table->timestampTz('sold_at')->nullable();
            $table->timestampTz('expires_at')->nullable();
            
            // ANALYTICS
            $table->integer('views_count')->default(0);
            $table->integer('favorites_count')->default(0);
            $table->integer('inquiries_count')->default(0);
            $table->integer('test_drives_count')->default(0);
            
            // FLAGS
            $table->unsignedTinyInteger('is_featured')->default(0);
            $table->unsignedTinyInteger('is_certified')->default(0);
            $table->unsignedTinyInteger('is_verified')->default(0);
            $table->unsignedTinyInteger('has_accident_history')->default(0);
            $table->unsignedTinyInteger('has_service_history')->default(0);
            
            $table->timestamps();
            $table->softDeletes();
            
            // INDEXES
            $table->index(['status_id', 'listed_at']);
            $table->index(['brand_id', 'car_model_id']);
            $table->index(['client_id', 'status_id']);
            $table->index('price');
            $table->index('mileage');
            $table->index('year');
            $table->index(['location_city', 'location_state']);
            $table->index('is_featured');
            $table->index('condition_id');
            $table->index(['make', 'model', 'year']);
            $table->index(['status_id', 'price', 'mileage']);
            $table->fullText(['make', 'model', 'trim']);
        });

        Schema::create('car_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->text('description')->nullable();
            $table->unique(['car_id', 'locale']);
        });
        
        Schema::create('car_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_image_type_id')->nullable()->constrained();
            $table->string('image_path', 350);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->unsignedTinyInteger('is_main')->default(0);
            $table->timestamps();
            
            $table->index('car_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_images');
        Schema::dropIfExists('car_translations');
        Schema::dropIfExists('cars');
    }
};
