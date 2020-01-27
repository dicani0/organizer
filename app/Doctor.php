<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function specialization()
    {
        return $this->belongsTo('App\Specialization', 'spec_id', 'id');
    }
    public function examinations()
    {
        return $this->hasMany('App\Examination');
    }
    public function referals()
    {
        return $this->hasMany('App\Referal');
    }
    public function prescriptions()
    {
        return $this->hasMany('App\Prescription');
    }
    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }
}
