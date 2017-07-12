<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()//buyer_id
    {
        return $this->belongsTo(User::class);
    }

    public function district()//saler_id
    {
        return $this->belongsTo(District::class);
    }
}
