<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class WalletData extends Model
{
    use HasFactory;
   

    public $table = 'wallet_data';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'challange_id',
        'wallet',
        'deposit',
    ];

    /**
     * Get the options for generating the slug.
     */
   
}
