<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()//saler_id
    {
        return $this->belongsTo(User::class);
    }

    public function district()//saler_id
    {
        return $this->belongsTo(District::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
