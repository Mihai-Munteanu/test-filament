<?php

use App\Http\Livewire\CustomerFour;
use App\Http\Livewire\CustomerThree;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kk', CustomerThree::class);

Route::get('/kkk', CustomerFour::class);




// SELECT
// 	c.id, c.customer_id, al.active_listing_ebay, al.active_listing_mercari, al.active_listing_poshmark
// FROM
// 	customers AS c
// 	JOIN active_listings AS al ON c.id = al.customer_id
// 	set total = 0


// SELECT
// 	SUM(active_listing)
// FROM
// 	active_listings
// WHERE
// 	platform='mercari' and
// 	date='2023-01-29'
// 	-- 	c.id, c.customer_id, al.active_listing_ebay, al.active_listing_mercari, al.active_listing_poshmark
// 	-- FROM
// 	-- 	customers AS c
// 	-- 	JOIN active_listings AS al ON c.id = al.customer_id
// 	-- 	set total = 0
