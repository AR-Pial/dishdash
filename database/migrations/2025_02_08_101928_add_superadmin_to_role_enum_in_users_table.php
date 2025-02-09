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
        // Modify the `role` enum to add 'SuperAdmin'
        DB::statement("ALTER TABLE users CHANGE role role ENUM('Customer', 'Admin', 'SuperAdmin') NOT NULL DEFAULT 'Customer'");
    }

    public function down(): void
    {
        // Revert the enum back to its original state (if necessary)
        DB::statement("ALTER TABLE users CHANGE role role ENUM('Customer', 'Admin') NOT NULL DEFAULT 'Customer'");
    }
};
