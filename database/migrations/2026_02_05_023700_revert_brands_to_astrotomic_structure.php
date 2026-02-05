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
            $table->dropColumn(['name', 'country_origin']);
            $table->boolean('is_active')->default(true)->after('website_url');
        });

        Schema::create('brand_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->string('locale', 5)->index();
            $table->string('name');
            $table->string('country_origin');
            $table->text('description')->nullable();

            $table->unique(['brand_id', 'locale']);
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_translations');

        Schema::table('brands', function (Blueprint $table) {
             $table->json('name')->nullable();
             $table->json('country_origin')->nullable();
             $table->dropColumn('is_active');
        });
    }
};
