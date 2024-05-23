<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class ChallangeType extends Authenticatable
{
    use  Notifiable, HasApiTokens;
    use HasSlug;


    public $table = 'challange_type';


    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
        'description'
    ];

    // public function gameType()
    // {
    //    return hasMany()
    // }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
