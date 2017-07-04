<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    //
    public function saler()
    {
        $this->belongsTo(User::class);
    }

    public function buyer()
    {
        $this->belongsTo(User::class);
    }
}
