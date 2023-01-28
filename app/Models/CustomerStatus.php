<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerStatus extends Model
{
    protected $guarded = ['id'];
    public $table = 'customer_statuses';
}
