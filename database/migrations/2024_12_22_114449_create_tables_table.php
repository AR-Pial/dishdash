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
        Schema::create('tables', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary key (UUID)
            $table->string('table_number')->unique();; // Table number or name
            $table->string('floor_number')->nullable(); // Floor number or name
            $table->integer('total_seat'); // Number of seats
            $table->decimal('hourly_price', 10, 2); // Price per hour
            $table->enum('status', ['available', 'reserved', 'occupied', 'unavailable'])->default('available'); // Table status
            $table->enum('type', ['premium', 'cabin', 'business', 'economy'])->default('economy'); // Table type
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
