<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function goods()
    {
        return $this->hasMany(Good::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
