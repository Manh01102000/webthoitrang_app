<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->string('admin_name')->nullable();
            $table->integer('admin_type')->default('0');
            $table->string('admin_account')->nullable();
            $table->string('admin_phone')->nullable();
            $table->string('admin_email_contact')->nullable();
            $table->string('admin_pass')->nullable();
            $table->integer('admin_city')->default('0');
            $table->integer('admin_district')->default('0');
            $table->string('address')->nullable();
            $table->string('admin_logo')->nullable();
            $table->integer('birthday')->default('0');
            $table->integer('gender')->default('0');
            $table->integer('admin_honnhan')->default('0');
            $table->integer('admin_create_time')->default('0');
            $table->integer('admin_update_time')->default('0');
            $table->integer('admin_show')->default('0');
            $table->integer('admin_ip_address')->default('0');
            $table->string('admin_lat')->nullable();
            $table->string('admin_long')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
}
;
