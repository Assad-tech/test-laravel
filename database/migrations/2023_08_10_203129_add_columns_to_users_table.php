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
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact')->nullable()->after('name');
            $table->text('address')->nullable()->after('contact');
            $table->string('pincode', 6)->nullable()->after('address');
            $table->enum('status', ['active', 'in-active'])->default('in-active')->after('pincode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact')->nullable()->after('name');
            $table->text('address')->nullable()->after('contact');
            $table->string('pincode', 6)->nullable()->after('address');
            $table->enum('status', ['active', 'in-active'])->default('in-active')->after('pincode');
        });
    }
};
