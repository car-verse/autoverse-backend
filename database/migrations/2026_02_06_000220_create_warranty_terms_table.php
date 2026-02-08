<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warranty_terms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warranty_type_id')->constrained()->cascadeOnDelete();
            $table->integer('years')->nullable();
            $table->integer('miles')->nullable();
            $table->unsignedTinyInteger('is_unlimited_miles')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warranty_terms');
    }
};
