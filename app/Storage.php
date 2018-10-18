<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    //
    
	protected $table = 'storage';
	
	protected $fillable = [
			'total_volum', 'used_volum','user_account'
	];
}
