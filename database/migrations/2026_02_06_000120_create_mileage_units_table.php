<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mileage_units', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });

        Schema::create('mileage_unit_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mileage_unit_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->string('name', 50);
            $table->unique(['mileage_unit_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mileage_unit_translations');
        Schema::dropIfExists('mileage_units');
    }
};
