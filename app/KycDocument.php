<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class KycDocument extends Model
{
    use HasFactory; 

    public $table = 'kyc_documents';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'dob',
        'aadhar_no',
        'front_image',
        'back_image',
        'status'
    ];

}
