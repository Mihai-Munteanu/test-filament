<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CustomerUnique extends Model
{
    protected $table = 'customer_uniques';
    protected $guarded = ['id'];

    public function customer(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class);
    }
}
