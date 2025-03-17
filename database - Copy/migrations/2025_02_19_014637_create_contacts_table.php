<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('contact_id');
            // id người liên hệ
            $table->integer('contact_user_id')->default('0');
            // tên người liên hệ
            $table->string('contact_user_name')->nullable();
            // số điện thoại người liên hệ
            $table->string('contact_user_phone')->nullable();
            // nôi dung
            $table->string('contact_description')->nullable();
            // thời gian liên hệ
            $table->integer('contact_created_at')->default('0');
            // cập nhật thời gian liên hệ
            $table->integer('contact_updated_at')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
}
;
