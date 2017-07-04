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

    public function user_id()//saler_id
    {
        return $this->belongsTo(User::class);
    }
}
