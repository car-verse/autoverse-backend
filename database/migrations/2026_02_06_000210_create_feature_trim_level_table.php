<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feature_trim_level', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trim_level_id')->constrained()->cascadeOnDelete();
            $table->foreignId('feature_id')->constrained()->cascadeOnDelete();
            $table->foreignId('feature_availability_id')->constrained('feature_availabilities');
            $table->foreignId('feature_package_id')->nullable()->constrained('feature_packages')->nullOnDelete();
            $table->decimal('additional_cost', 8, 2)->nullable();
            $table->timestamps();
            
            $table->unique(['trim_level_id', 'feature_id']);
            $table->index('feature_availability_id');
            $table->index('feature_package_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_trim_level');
    }
};
