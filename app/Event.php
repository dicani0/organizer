<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = ['title', 'color', 'start_date', 'end_date'];

    public function subuser()
    {
        return $this->belongsTo('App\Subuser');
    }
}
