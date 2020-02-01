<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Tag;
use App\Gamephoto;
use App\Publisher;
use DB;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function index(){
        if (request('tag')) {
            $games = Tag::where('tag', request('tag'))->firstOrFail()->games->sortBy('name');
        } else {
            $games = Game::all()->sortBy('name');
        }
        
        $tags = Tag::all();
        return view('games', [
            'games' => $games,
            'tags' => $tags
        ]);
    }

    public function show($gameslug){
        $game = Game::where('slug', $gameslug)->firstOrFail();
        $reviews = $game->reviews()->get();
        


       // $testReview = $game->reviews()->firstOrFail();
        //dd($testReview->author->name);

        return view('review', [
            'game' => $game,
            'reviews' => $reviews
        ]);
    }

    public function create() {
        $tags = Tag::all();
        $publishers = Publisher::all();
        return view('create', [
            'tags' => $tags,
            'publishers' => $publishers
        ]);
    }

    public function edit($gameslug) {
        $game = Game::where('slug', $gameslug)->firstOrFail();
        $tags = Tag::all();
        $publishers = Publisher::all();
        return view('editgame', [
            'game' => $game,
            'tags' => $tags,
            'publishers' => $publishers
        ]);
    }

    public function update($gameslug) {
        $game = Game::where('slug', $gameslug)->firstOrFail();
        $publisherExists = DB::table('publishers')->where('publisher', request('publisher'))->exists();
        if(!$publisherExists){
            $publisher = new Publisher;
            $publisher->publisher = request('publisher');
            $publisher->save();
        }

        $slug = str_replace(" ", "-", strtolower(request('name')));
        $game->name = request('name');
        $game->slug = $slug;
        $game->playtime_min = request('playtime_min');
        $game->playtime_max = request('playtime_max');
        $game->publisher_id = Publisher::where('publisher', request('publisher'))->firstOrFail()->id;
        $game->player_count_min = request('player_count_min');
        $game->player_count_max = request('player_count_max');
        $game->or_more = request('or_more') == 'on' ? true : false;
        $game->referral_link = request('referral_link');
        $game->save();

        $tags = explode(" ", request('tags'));
        if($tags != ""){
            foreach($tags as $tag){
                DB::table('tags')->updateOrInsert(
                    ['tag' => $tag]
                );
                $game->tags()->attach(Tag::where('tag', '=', $tag)->firstOrFail());
            }
        }
        return redirect('games');
    }

    public function store(Request $request) {
        $publisherExists = DB::table('publishers')->where('publisher', request('publisher'))->exists();
        if(!$publisherExists){
            $publisher = new Publisher;
            $publisher->publisher = request('publisher');
            $publisher->save();
        }
        
        $path = $request->file('image')->store('public/images');
        $path = explode("/", $path);
        $path = $path[2];

        $slug = str_replace(" ", "-", strtolower(request('name')));
        $game = new Game;
        $game->name = request('name');
        $game->slug = $slug;
        $game->playtime_min = request('playtime_min');
        $game->playtime_max = request('playtime_max');
        $game->publisher_id = Publisher::where('publisher', request('publisher'))->firstOrFail()->id;
        $game->player_count_min = request('player_count_min');
        $game->player_count_max = request('player_count_max');
        $game->or_more = request('or_more') == 'on' ? true : false;
        $game->image = $path;
        $game->referral_link = request('referral_link');
        $game->save();

        $tags = explode(" ", request('tags'));
        foreach($tags as $tag){
            DB::table('tags')->updateOrInsert(
                ['tag' => $tag]
            );
            $game->tags()->attach(Tag::where('tag', '=', $tag)->firstOrFail());
        }

        return redirect('games');
    }
    
    public function addphotos($gameslug) {
        $game = Game::where('slug', $gameslug)->firstOrFail();
        $photos = $game->photos;
        return view('addphotos', [
            'game' => $game,
            'photos' => $photos
        ]);
    }

    public function storephotos(Request $request) {
        foreach($request->file('image') as $image){
            $path = $image->store('public/images');
            $path = explode("/", $path);
            $path = $path[2];
            $photo = new Gamephoto;
            $photo->timestamps = false;
            $photo->image = $path;
            $photo->game_id = request('game_id');
            $photo->save();
        }
        return redirect('games');
    }

    public function deletephoto($photo_id){
        $photo = Gamephoto::find($photo_id);
        $image_path = 'public/images/' . $photo->image;
            if(Storage::exists($image_path)){
                Storage::delete($image_path);
            }
        $photo->forceDelete();
        return redirect('games');
    }

    public function destroy($gameslug){
        $game = Game::where('slug', $gameslug)->firstOrFail();
        $photos = $game->photos;
        
        foreach($photos as $photo){
            $image_path = 'public/images/' . $photo->image;
            if(Storage::exists($image_path)){
                Storage::delete($image_path);
            }
        }
        Storage::delete('public/images/' . $game->image);
        $game->forceDelete();
        return redirect('/games');
    }

    public function home(){
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
        $games = array_slice($games, 0, 3, true);

        $top5Games = Game::all()->sortByDesc(function ($game) {
            return $game->reviewCheck();
        });
        $top5GamesArray = [];
        foreach($top5Games as $game){
            $top5GamesArray[] = $game;
        }
        $top5Games = array_slice($top5GamesArray, 0, 5, true);

        return view('welcome', [
            'games' => $games,
            'top5Games' => $top5Games
        ]);
        }
}
