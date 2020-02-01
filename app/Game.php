<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function reviews() {
        return $this->hasMany(Review::class);
    }
    public function hasTwoReviews(){
        if(count($this->reviews()->get()) > 1){
            return true;
        }
        return false;
    }
    public function playerCount() {
        if($this->player_count_min == $this->player_count_max){
            return $this->player_count_min;
        }
        if($this->or_more){
            return $this->player_count_min . " - " . $this->player_count_max . "+";
        }
        return $this->player_count_min . " - " . $this->player_count_max;
    }
    public function playtime() {
        if($this->playtime_min == $this->playtime_max){
            return $this->playtime_min . " mins";
        }
        return $this->playtime_min . " - " . $this->playtime_max . " mins";
    }
    public function rating(){
        $reviews = $this->reviews()->get();
        $rating = 0;
        foreach($reviews as $review){
            $rating += $review->gameplay + $review->replayability + $review->components;
        }
        $rating = number_format((float)$rating*2.5/10, 1, '.', '');
        if($rating == "10.0"){
            return "10";
        }
        return $rating;
    }
    public function tags(){
        return $this->belongstoMany(Tag::class);
    }
    public function tagsString(){
        $tags = $this->tags;
        $tagsString = "";
        foreach($tags as $tag){
            if($tagsString == ""){
                $tagsString = $tag->tag;
            } else {
                $tagsString = $tagsString . " " . $tag->tag;
            }     
        }
        return $tagsString;
    }
    public function photo(){
        return "/storage/images/" . $this->image;
    }
    public function photos(){
        return $this->hasMany(Gamephoto::class);
    }
    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }
    public function reviewed($user_id){
        $reviews = $this->reviews()->get();
        foreach($reviews as $review){
            if($review->user_id == $user_id){
                return true;
            }
        }
        return false;
    }
    public function reviewCheck(){
        if($this->hasTwoReviews()){
            return $this->rating();
        }
        return null;
    }
}
