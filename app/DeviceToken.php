<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    use HasFactory;

    public $table = 'device_token';
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'user_id',
        'device_token',

    ];


}
