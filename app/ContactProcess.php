<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactProcess extends Model
{
    //

    protected $table="contactprocess";

    protected $fillable=[
        'sender','receiver'
    ];
}
