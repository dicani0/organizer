<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function specialization()
    {
        return $this->belongsTo('App\Specialization', 'spec_id', 'id');
    }
    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }
}
