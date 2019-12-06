<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrudLog extends Model
{
    public $timestamps = false;
    protected $table   = 'crud_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'model',
        'table_name',
        'method',
        'record_key_name',
        'record_id',
        'params',
    ];
}