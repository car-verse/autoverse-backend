<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feature_availabilities', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 150)->unique();
            $table->timestamps();
        });

        Schema::create('feature_availability_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_availability_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->string('name', 150);
            $table->unique(['feature_availability_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_availability_translations');
        Schema::dropIfExists('feature_availabilities');
    }
};
