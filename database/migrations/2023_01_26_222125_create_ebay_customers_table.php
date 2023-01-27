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
        Schema::create('ebay_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->unsignedBigInteger('all_sales_count')->nullable();
            $table->double('all_sales_value')->nullable();
            $table->double('treecat_revenue')->nullable();
            $table->unsignedBigInteger('new_listings_downloaded_from_ecommerce_platforms')->nullable();
            $table->unsignedBigInteger('successful_new_listing_count')->nullable();
            $table->unsignedBigInteger('de-listing_fail_count')->nullable();
            $table->unsignedBigInteger('de-listing_success_count')->nullable();
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
        Schema::dropIfExists('ebay_customers');
    }
};
