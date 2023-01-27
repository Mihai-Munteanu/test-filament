<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->unique();
            $table->timestamp('customer_registration_date')->default(now());
            $table->unsignedBigInteger('active_listings')->nullable();
            $table->unsignedBigInteger('cross-linked_active_listings')->nullable();
            $table->unsignedBigInteger('cross-linked_sales_count')->nullable();
            $table->double('cross-linked_sales_value')->nullable();
            $table->unsignedInteger('number_of_guest_accounts')->nullable();
            $table->string('account_status')->default('internal');
            $table->string('notification_email_1')->nullable();
            $table->string('notification_email_2')->nullable();
            $table->timestamp('date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
