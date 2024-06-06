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
                $table->string('address');
                $table->string('postal_code');
                $table->string('country');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('city');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('postal_code');
            $table->dropColumn('country');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('city');
        });
    }
};
