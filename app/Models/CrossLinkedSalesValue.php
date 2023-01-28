<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrossLinkedSalesValue extends Model
{
    protected $guarded = ['id'];
    public $table = 'cross_linked_sales_values';
}
