<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transmission_types', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 150)->unique();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('transmission_type_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transmission_type_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->string('name', 150);
            $table->unique(['transmission_type_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transmission_type_translations');
        Schema::dropIfExists('transmission_types');
    }
};
