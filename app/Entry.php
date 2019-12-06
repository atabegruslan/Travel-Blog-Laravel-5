<?php

namespace App;

class Entry extends Base
{
    protected $table = 'entries';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'place', 'comments', 'img_url'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
