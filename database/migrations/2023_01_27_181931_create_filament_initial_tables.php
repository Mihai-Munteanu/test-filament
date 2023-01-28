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
        Schema::create('customer_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->timestamp('date');
            $table->timestamp('customer_registration_date');
            $table->foreignId('account_status_id')->constrained('customer_statuses');

            $table->unique(['customer_id', 'date']);
            $table->timestamps();
        });

        Schema::create('active_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('active_listing_mercari');
            $table->unsignedBigInteger('active_listing_ebay');
            $table->unsignedBigInteger('active_listing_poshmark');

            $table->timestamps();
        });

        Schema::create('cross_linked_active_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('cross_linked_active_listing_mercari');
            $table->unsignedBigInteger('cross_linked_active_listing_ebay');
            $table->unsignedBigInteger('cross_linked_active_listing_poshmark');

            $table->timestamps();
        });

        Schema::create('cross_linked_sales_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('cross_linked_sales_count_mercari');
            $table->unsignedBigInteger('cross_linked_sales_count_ebay');
            $table->unsignedBigInteger('cross_linked_sales_count_poshmark');

            $table->timestamps();
        });

        Schema::create('cross_linked_sales_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('cross_linked_sales_value_mercari');
            $table->unsignedBigInteger('cross_linked_sales_value_ebay');
            $table->unsignedBigInteger('cross_linked_sales_value_poshmark');

            $table->timestamps();
        });

        Schema::create('all_sales_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('all_sales_count_mercari');
            $table->unsignedBigInteger('all_sales_count_ebay');
            $table->unsignedBigInteger('all_sales_count_poshmark');

            $table->timestamps();
        });

        Schema::create('all_sales_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('all_sales_value_mercari');
            $table->unsignedBigInteger('all_sales_value_ebay');
            $table->unsignedBigInteger('all_sales_value_poshmark');

            $table->timestamps();
        });

        Schema::create('treecat_revenues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('treecat_revenue_mercari');
            $table->unsignedBigInteger('treecat_revenue_ebay');
            $table->unsignedBigInteger('treecat_revenue_poshmark');

            $table->timestamps();
        });

        Schema::create('new_listings_downloaded_platforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('new_listings_downloaded_platform_mercari');
            $table->unsignedBigInteger('new_listings_downloaded_platform_ebay');
            $table->unsignedBigInteger('new_listings_downloaded_platform_poshmark');

            $table->timestamps();
        });

        Schema::create('successful_new_listing_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('successful_new_listing_count_mercari');
            $table->unsignedBigInteger('successful_new_listing_count_ebay');
            $table->unsignedBigInteger('successful_new_listing_count_poshmark');

            $table->timestamps();
        });

        Schema::create('de_listing_fail_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('de_listing_fail_count_mercari');
            $table->unsignedBigInteger('de_listing_fail_count_ebay');
            $table->unsignedBigInteger('de_listing_fail_count_poshmark');

            $table->timestamps();
        });

        Schema::create('de_listing_success_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('de_listing_success_count_mercari');
            $table->unsignedBigInteger('de_listing_success_count_ebay');
            $table->unsignedBigInteger('de_listing_success_count_poshmark');

            $table->timestamps();
        });

        Schema::create('notification_email_1s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('notification_email_1_mercari');
            $table->unsignedBigInteger('notification_email_1_ebay');
            $table->unsignedBigInteger('notification_email_1_poshmark');

            $table->timestamps();
        });

        Schema::create('notification_email_2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('notification_email_2_mercari');
            $table->unsignedBigInteger('notification_email_2_ebay');
            $table->unsignedBigInteger('notification_email_2_poshmark');

            $table->timestamps();
        });

        Schema::create('number_of_guest_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('date');
            $table->unsignedBigInteger('number_of_guest_account_mercari');
            $table->unsignedBigInteger('number_of_guest_account_ebay');
            $table->unsignedBigInteger('number_of_guest_account_poshmark');

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
        Schema::dropIfExists('filament_initial_tables');
    }
};
