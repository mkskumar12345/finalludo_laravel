<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{

    public $table = 'incomes';
    protected $fillable = [
        'challange_id',
        'challange_amount',
        'income',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];

}
