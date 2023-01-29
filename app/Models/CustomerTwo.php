<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTwo extends Model
{
    protected $guarded = ['id'];
    public $table = 'customers';
}
