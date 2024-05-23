<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferUsers extends Model
{
    use HasFactory;
    public $table = 'referal_users';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'refer_by',
        'amount',
    ];
    public function referBy(){
        return $this->hasOne(User::class, 'id', 'refer_by');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
