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
            $table->string('nrp')->unique()->after('name');
            $table->smallInteger('is_active')->default(true)->after('password');
            $table->unsignedBigInteger('departement_id')->nullable()->after('is_active');
            $table->unsignedBigInteger('jabatan_id')->nullable()->after('departement_id');
            $table->unsignedBigInteger('bagian_id')->nullable()->after('jabatan_id');
            $table->text('avatar')->nullable()->after('bagian_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nrp');
            $table->dropColumn('is_active');
            $table->dropColumn('avatar');
        });
    }
};
