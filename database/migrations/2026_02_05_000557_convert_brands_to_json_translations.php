<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->json('name')->nullable()->after('id');
            $table->json('country_origin')->nullable()->after('name');
        });

        Schema::dropIfExists('brand_translations');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('brand_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 5);
            $table->string('name');
            $table->string('country_origin');
            $table->unique(['brand_id', 'locale']);
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn(['name', 'country_origin']);
        });
    }
};
