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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('website_url', 350);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('brand_translations', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->string('locale')->index();
            $table->string('name');
            $table->string('country_origin');

            $table->unique(['brand_id', 'locale']);
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
        Schema::dropIfExists('brand_translations');
    }
};
