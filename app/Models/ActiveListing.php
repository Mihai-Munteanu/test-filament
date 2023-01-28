<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveListing extends Model
{
    protected $guarded = ['id'];
    public $table = 'active_listings';
}
