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
        Schema::create('places', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->longText('description');

            $table->longText('address')->unique();
            $table->string('phone_number')->unique();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->uuid('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();

            $table->enum('status',['active','unactive'])->default('active');
            $table->integer('view_count')->default(0);

            $table->longText('map')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
