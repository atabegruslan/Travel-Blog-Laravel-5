<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gcmtoken extends Model
{
    protected $table = 'gcmtokens';
    public $timestamps = false;

    protected $fillable = [
        'token'
    ];
}
