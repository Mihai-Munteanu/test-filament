<?php

namespace App\Models;

use App\Models\ActiveListing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    protected $guarded = ['id'];
    public $table = 'customers';

    public function activeListings(): HasMany
    {
        return $this->hasMany(ActiveListing::class, 'customer_id', 'id');
    }

    public function activeListingByDate(): HasOne
    {
        return $this->hasOne(ActiveListing::class, 'customer_id', 'id')->where('date', $this->date);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(CustomerStatus::class, 'customer_status_id', 'id');
    }
}
