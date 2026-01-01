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
        Schema::create('rooms', function (Blueprint $table) {
    $table->id();
    $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
    $table->string('room_number')->nullable();
    $table->string('type'); // Single, Double, Suite
    $table->unsignedTinyInteger('capacity')->default(1);
    $table->decimal('price_per_night', 10, 2);
    $table->string('status')->default('available'); // available, maintenance
    $table->timestamps();

    $table->unique(['hotel_id', 'room_number']); // optional uniqueness
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
