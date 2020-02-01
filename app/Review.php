<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public static function getTextAttribute($markdown)
    {
        return new HtmlString(
            app(Parsedown::class)->setSafeMode(true)->text($text)
        );
    }
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function game(){
        return $this->belongsTo(Game::class, 'game_id');
    }
    public function date(){
        return $this->created_at->format('m/d/Y');
    }
    public function preview(){
        return substr($this->markdown, 0, 150) . "...";
    }
    
}
