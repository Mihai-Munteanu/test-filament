<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrossLinkedActiveListing extends Model
{
    protected $guarded = ['id'];
    public $table = 'cross_linked_active_listings';

}
