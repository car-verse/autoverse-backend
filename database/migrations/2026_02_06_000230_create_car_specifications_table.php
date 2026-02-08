<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trim_level_id')->unique()->constrained()->cascadeOnDelete();
            
            // ENGINE
            $table->string('engine_type', 100)->nullable();
            $table->integer('engine_displacement_cc')->nullable();
            $table->string('engine_configuration', 100)->nullable();
            $table->integer('horsepower')->nullable();
            $table->string('horsepower_rpm', 50)->nullable();
            $table->integer('torque_lb_ft')->nullable();
            $table->string('torque_rpm', 50)->nullable();
            $table->foreignId('aspiration_type_id')->nullable()->constrained();
            
            // FUEL
            $table->foreignId('fuel_type_id')->nullable()->constrained();
            $table->integer('fuel_tank_capacity_liters')->nullable();
            $table->string('recommended_fuel', 50)->nullable();
            
            // FUEL ECONOMY
            $table->decimal('mpg_city', 5, 2)->nullable();
            $table->decimal('mpg_highway', 5, 2)->nullable();
            $table->decimal('mpg_combined', 5, 2)->nullable();
            
            // ELECTRIC/HYBRID
            $table->integer('battery_capacity_kwh')->nullable();
            $table->integer('electric_range_miles')->nullable();
            $table->integer('charging_time_hours')->nullable();
            
            // TRANSMISSION
            $table->foreignId('transmission_type_id')->nullable()->constrained();
            $table->integer('transmission_gears')->nullable();
            $table->foreignId('drive_type_id')->nullable()->constrained();
            
            // PERFORMANCE
            $table->decimal('acceleration_0_60_mph', 4, 2)->nullable();
            $table->integer('top_speed_mph')->nullable();
            $table->decimal('quarter_mile_sec', 4, 2)->nullable();
            
            // DIMENSIONS
            $table->decimal('length_inches', 6, 2)->nullable();
            $table->decimal('width_inches', 6, 2)->nullable();
            $table->decimal('height_inches', 6, 2)->nullable();
            $table->decimal('wheelbase_inches', 6, 2)->nullable();
            $table->integer('curb_weight_lbs')->nullable();
            $table->integer('gross_weight_lbs')->nullable();
            
            // CAPACITY
            $table->integer('seating_capacity')->nullable();
            $table->decimal('cargo_space_cu_ft', 5, 2)->nullable();
            $table->integer('towing_capacity_lbs')->nullable();
            $table->integer('payload_capacity_lbs')->nullable();
            
            // WHEELS & TIRES
            $table->string('wheel_size_front', 20)->nullable();
            $table->string('wheel_size_rear', 20)->nullable();
            $table->string('tire_size_front', 20)->nullable();
            $table->string('tire_size_rear', 20)->nullable();
            
            // BRAKES
            $table->string('brake_type_front', 50)->nullable();
            $table->string('brake_type_rear', 50)->nullable();
            $table->decimal('brake_diameter_front_inches', 4, 2)->nullable();
            $table->decimal('brake_diameter_rear_inches', 4, 2)->nullable();
            
            // SUSPENSION
            $table->string('suspension_front', 50)->nullable();
            $table->string('suspension_rear', 50)->nullable();
            
            // WARRANTY
            $table->foreignId('basic_warranty_id')->nullable()->constrained('warranty_terms');
            $table->foreignId('powertrain_warranty_id')->nullable()->constrained('warranty_terms');
            $table->foreignId('corrosion_warranty_id')->nullable()->constrained('warranty_terms');
            $table->foreignId('roadside_warranty_id')->nullable()->constrained('warranty_terms');
            
            $table->timestamps();
            
            // Indexes
            $table->index('fuel_type_id');
            $table->index('drive_type_id');
            $table->index('transmission_type_id');
            $table->index('horsepower');
            $table->index(['mpg_city', 'mpg_highway']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_specifications');
    }
};
