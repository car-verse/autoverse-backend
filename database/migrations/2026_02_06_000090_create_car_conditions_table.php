<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 150)->unique();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('car_condition_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_condition_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->string('name', 150);
            $table->unique(['car_condition_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_condition_translations');
        Schema::dropIfExists('car_conditions');
    }
};
