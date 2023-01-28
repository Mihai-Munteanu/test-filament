<?php

namespace App\Models;

use App\Models\ActiveListing;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];
    public $table = 'customers';

    public function activeListings()
    {
        return $this->hasMany(ActiveListing::class, 'customer_id', 'id');
    }

    public function activeListingByDate()
    {
        return $this->hasOne(ActiveListing::class, 'customer_id', 'id')->where('date', $this->date);
    }
}
