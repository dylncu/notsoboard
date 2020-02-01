<?php

namespace App\Http\Controllers;
use App\Game;
use App\Review;
use DB;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index() {
        if (request('sort') == 'best') {
            $games = Game::all()->sortByDesc(function ($game) {
                return $game->reviewCheck();
            });
        } else {
            $reviews = DB::table('reviews')->orderBy('created_at')->get();
            $gameids = [];
            foreach($reviews as $review){
                $gameids[] = $review->game_id;     
            }
            $gameids = array_unique($gameids);
            $games = [];
            foreach($gameids as $gameid){
                $games[] = Game::where('id', $gameid)->firstOrFail();
        }
        }
        
        return view('reviews', [
            'games' => $games
        ]);
    }

    public function create($gameslug) {
        $game = Game::where('slug', $gameslug)->firstOrFail();
        $photos = $game->photos;
        return view('createreview', [
            'game' => $game,
            'photos' => $photos
        ]);
    }

    public function store(Request $request) {
        //dd(request('gameID'), $request->user()->id);

        $review = new Review;
        $review->gameplay = request('gameplay');
        $review->components = request('components');
        $review->replayability = request('replayability');
        $review->markdown = request('markdown');
        $review->user_id = $request->user()->id;
        $review->game_id = request('gameID');
        $review->save();
        return redirect('reviews');
    }

    public function edit($gameslug, $user_id){
        $game = Game::where('slug', $gameslug)->firstOrFail();
        $photos = $game->photos;
        $review = $game->reviews()->where('user_id', $user_id)->firstOrFail();
        return view('editreview', [
            'game' => $game,
            'review' => $review,
            'photos' => $photos
        ]);
    }

    public function update($review_id){
        $review = Review::find($review_id);
        $review->gameplay = request('gameplay');
        $review->components = request('components');
        $review->replayability = request('replayability');
        $review->markdown = request('markdown');
        $review->save();

        return redirect('/games');
    }
    
    public function delete($gameslug, $user_id){
        $game = Game::where('slug', $gameslug)->firstOrFail();
        $review = $game->reviews()->where('user_id', $user_id)->firstOrFail();
        $review->forceDelete();
        return redirect('/games');
    }
}
