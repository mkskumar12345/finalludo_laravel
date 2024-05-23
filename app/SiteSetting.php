<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $table = 'site_settings';
    protected $fillable = ['name','value'];

    protected $dates = [
        'updated_at',
        'created_at',
    ];

}
