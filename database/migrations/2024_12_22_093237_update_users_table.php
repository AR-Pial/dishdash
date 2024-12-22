<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Add new fields
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->enum('role', ['Customer', 'Admin'])->default('Customer');
            $table->timestamp('last_login')->nullable();
        });

        // Step 2: Add new UUID column
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->default(DB::raw('(UUID())'))->unique()->after('id');
        });

        // Step 3: Populate existing records with UUID values
        DB::statement('UPDATE users SET uuid = (UUID()) WHERE uuid IS NULL');

        // Step 4: Drop old auto-incrementing id and set uuid as primary key
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id'); // Remove old `id` column
        });

        // Step 5: Rename UUID to id and make it primary key
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('uuid', 'id'); // Rename `uuid` to `id`
            $table->primary('id'); // Set new `id` as the primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-add the original auto-incrementing id column
        Schema::table('users', function (Blueprint $table) {
            $table->dropPrimary(); // Drop primary key constraint
            $table->bigIncrements('id')->first(); // Re-add the original `id` column
        });

        // Drop the additional fields
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone_number', 'address', 'role', 'last_login']);
        });

        // Drop the UUID column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
};
