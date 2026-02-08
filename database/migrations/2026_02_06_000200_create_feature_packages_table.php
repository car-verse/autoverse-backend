<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feature_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->string('slug', 150)->unique();
            $table->decimal('base_price', 8, 2)->nullable();
            $table->timestamps();
            
            $table->index(['brand_id', 'slug']);
        });

        Schema::create('feature_package_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_package_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->string('name', 150);
            $table->string('description', 350)->nullable();
            $table->unique(['feature_package_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_package_translations');
        Schema::dropIfExists('feature_packages');
    }
};
