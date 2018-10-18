<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareList extends Model
{
    protected $table = "sharelist";

    protected $fillable = [
        'share_link', 'valid_time','share_password', 'qrcode_path', 'user_account', 'file_id'
    ];
}
