<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChallangeResult extends Model
{

    public $table = 'challanges_result';
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'challange_id',
        'creator_action',
        'creator_image',
        'acceptor_action',
        'acceptor_image',
        'creator_time',
        'acceptor_time',
        'cencal_acceptor',
        'cencal_creator',
        'creator_cancel_time',
        'acceptor_cancel_time',
    ];
    


}
