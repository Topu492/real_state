<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function agent(){
        $this->belongsTo(Agent::class);
    }

    public function package(){
        $this->belongsTo(Package::class);
    }
}
