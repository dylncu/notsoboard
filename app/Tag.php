<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function games(){
        return $this->belongstoMany(Game::class);
    }

}
