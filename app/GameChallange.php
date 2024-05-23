<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameChallange extends Model
{
    use HasFactory;

    public $table = 'game_challenge';
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'status',
        'winning_amount',
        'screenshort',
        'challenge_accepted_by',
        'challenge_created_by',
        'amount',
        'challenge_name',
        'challenge_type',
        'room_code',
        'who_win',
        'who_cancel',
        'reson',
        'requested',
        'slug',
        'room_code_time',
    ];

    public function createBy()
    {
        // code...
        return $this->belongsTo(User::class,'challenge_created_by','id');
    }

    public function acceptedBy($value='')
    {
        // code...
        return $this->belongsTo(User::class,'challenge_accepted_by','id');
    }
    public function challangeResult($value='')
    {
        // code...
        return $this->hasOne(ChallangeResult::class,'challange_id','id');
    }

    public function challangeType($value='')
    {
        // code...
        return $this->belongsTo(ChallangeType::class,'challenge_type','id');
    }
}
