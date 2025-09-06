<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable
{
    use HasFactory, Notifiable;

    public function orders()
    {
    return $this->hasMany(Order::class);
    }

      public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
