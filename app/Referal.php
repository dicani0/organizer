<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    public function doctorfrom()
    {
        return $this->belongsTo('App\Doctor', 'doctor_id_from');
    }
    public function doctorto()
    {
        return $this->belongsTo('App\Doctor', 'doctor_id_to');
    }
}
