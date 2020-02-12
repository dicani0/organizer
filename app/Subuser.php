<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subuser extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function events()
    {
        return $this->hasMany('App\Event');
    }
    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->subname;
    }
}
