<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $dates = ['birth_date', 'last_donate'];

    protected $casts = [
        'socialMedia' => 'object'
    ];


    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function blood()
    {
        return $this->belongsTo(Blood::class, 'blood_id');
    }


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

}
