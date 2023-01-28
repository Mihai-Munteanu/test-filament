<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeListingFailCount extends Model
{
    protected $guarded = ['id'];
    public $table = 'de_listing_fail_counts';
}
