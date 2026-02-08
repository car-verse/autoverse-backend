<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 150)->unique();
            $table->foreignId('feature_category_id')->constrained();
            $table->unsignedTinyInteger('is_premium')->default(0);
            $table->timestamps();
        });

        Schema::create('feature_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->string('name', 150);
            $table->string('description', 350)->nullable();
            $table->unique(['feature_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_translations');
        Schema::dropIfExists('features');
    }
};
