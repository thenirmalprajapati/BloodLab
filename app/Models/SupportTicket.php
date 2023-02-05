<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $guarded = ['id'];

    public function getFullnameAttribute()
    {
        return $this->name;
    }

    public function getUsernameAttribute()
    {
        return $this->email;
    }

    public function supportMessage(){
        return $this->hasMany(SupportMessage::class);
    }

}
