<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermisssions extends Model
{

    public $table = 'user_permisssions';
    protected $fillable = [
        'user_id',
        'permission',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];

}
