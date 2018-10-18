<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    
	protected $table="files";
	
	protected $fillable=[
			'file_id', 'user_account','filename','filepath','desc','filetype','filesize','parent_id','status'
	];
	
}
