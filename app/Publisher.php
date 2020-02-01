<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    public function games() {
        return $this->hasMany(Game::class);
    }
}
