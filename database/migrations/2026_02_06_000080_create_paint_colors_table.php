<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paint_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paint_color_type_id')->nullable()->constrained();
            $table->string('slug', 150)->unique();
            $table->char('color_hex', 7)->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('paint_color_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paint_color_id')->constrained()->cascadeOnDelete();
            $table->char('locale', 2)->index();
            $table->string('name', 150);
            $table->unique(['paint_color_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paint_color_translations');
        Schema::dropIfExists('paint_colors');
    }
};
