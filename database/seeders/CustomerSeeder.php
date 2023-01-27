<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\EbayCustomer;
use App\Models\MercariCustomer;
use Illuminate\Database\Seeder;
use App\Models\PoshmarkCustomer;
use App\Models\MercariCustomerData;

class CustomerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['internal', 'external', 'beta'];

        for ($i = 0; $i < 100; $i++) {
            $customerData = [
                'customer_id' => 100 + $i,
                'customer_registration_date' => now(),
                'active_listings' => 100 + $i,
                'cross-linked_active_listings' => 200 + $i,
                'cross-linked_sales_count' => 44 + $i,
                'cross-linked_sales_value' => 7000 + $i,
                'number_of_guest_accounts' => 300 + $i,
                'account_status' => $statuses[array_rand($statuses)],

                'notification_email_1' => 'notification_email_1' . $i,
                'notification_email_2' => 'notification_email_2' . $i,
                'date' => now(),
            ];

            $customer = Customer::firstOrCreate($customerData);

            $mercariCustomerData = [
                'customer_id' => $customer->id,
                'all_sales_count' => 400 + $i,
                'all_sales_value' => 900 + $i,
                'treecat_revenue' => 1000 + $i,
                'new_listings_downloaded_from_ecommerce_platforms' => 123 + $i,
                'successful_new_listing_count' => 42 + $i,
                'de-listing_fail_count' => 21 + $i,
                'de-listing_success_count' => 98 + $i,
                'date' => now(),
            ];

            MercariCustomer::firstOrCreate($mercariCustomerData);

            $poshmarkCustomerData = [
                'customer_id' => $customer->id,
                'all_sales_count' => 600 + $i,
                'all_sales_value' => 12000 + $i,
                'treecat_revenue' => 3000 + $i,
                'new_listings_downloaded_from_ecommerce_platforms' => 134 + $i,
                'successful_new_listing_count' => 445 + $i,
                'de-listing_fail_count' => 23 + $i,
                'de-listing_success_count' => 101 + $i,
                'date' => now(),
            ];


            PoshmarkCustomer::firstOrCreate($poshmarkCustomerData);


            $ebayCustomerData = [
                'customer_id' => $customer->id,
                'all_sales_count' => 700 + $i,
                'all_sales_value' => 20000 + $i,
                'treecat_revenue' => 4000 + $i,
                'new_listings_downloaded_from_ecommerce_platforms' => 233 + $i,
                'successful_new_listing_count' => 644 + $i,
                'de-listing_fail_count' => 52 + $i,
                'de-listing_success_count' => 109 + $i,
                'date' => now(),
            ];

            EbayCustomer::firstOrCreate($ebayCustomerData);
        }
    }
}
