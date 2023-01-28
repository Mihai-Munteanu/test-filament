<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllSalesCount extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $table = 'all_sales_counts';
}
