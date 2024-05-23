<?php

namespace App;
use Illuminate\Database\Eloquent\Model; 

/**
 * 
 */
class Log extends Model
{
	public $table = 'logs';
	public $dates = ['created_at','updated_at'];

	protected $fillable = ['user_id','description','action','amount'];
	
}