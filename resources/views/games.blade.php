@extends('layouts.app')

@section('content')

<div class="article-list">
        <div class="container">
        <div class="col-md-4 offset-md-4">
    <img class="img-fluid" src="{{asset('/storage/images/gamesheader.png')}}">
    </div>
            <div class="intro">
            <div class="col-sm-12 games-title">
                    <p class="description">
                    <a href="/games" class="tag"> All </a>
            @foreach($tags as $tag)
                    <a href="/games?tag={{$tag->tag}}" class="tag"> {{$tag->tag}} </a>
            @endforeach
            </div>
            </div>
            <div class="row articles games-block">
            @foreach($games as $game)

                <div class="col-sm-6 col-md-4 item game-card-div">
                <a class="game-name" href="/games/{{$game->slug}}">
                    <h4 class="game-title">{{$game->name}}</h4>
                    </a>
                @if($game->hasTwoReviews())
                  <a href="/games/{{$game->slug}}">
                @endif
                  <img class="img-fluid game-image" src="{{asset($game->photo())}}">
                @if($game->hasTwoReviews())
                </a>
                @endif
                
                    <p>
                      @if($game->hasTwoReviews())
                      
                      <!--<img src="{{asset('/storage/images/nsbrating.png')}}" class="nsbrating-games">-->
                      <img src="{{asset('/storage/images/nsbratingfill.png')}}" class="nsbratingfill-games">
                        <h5 class="games-page-score"> 
                        {{$game->rating()}}</h5>
                        
                      @else
                        <p class="description">Review in progress</p>
                      @endif
                   
                    </p>
                    
                    <p class="description">
                      For {{$game->playerCount()}} players in {{$game->playTime()}}. Published by {{$game->publisher->publisher}}.
                    </p>
                    
                    
                    @auth
              <div class = "admin-buttons">
              <button type="button" class="btn btn-light"><a href="/games/{{$game->slug}}/photos">Photos</a></button>
              <button type="button" class="btn btn-light"><a href="/games/{{$game->slug}}/edit">Edit Game</a></button>
              @if($game->reviewed(auth()->user()->id))
              <button type="button" class="btn btn-light"><a href="/games/{{$game->slug}}/{{auth()->user()->id}}/review/edit">Edit Review</a></button>
              <button type="button" class="btn btn-light"><a href="/games/{{$game->slug}}/{{auth()->user()->id}}/review/delete">Delete Review</a></button>
              @else
              <button type="button" class="btn btn-light"><a href="/games/{{$game->slug}}/review/add">Write Review</a></button>
              @endif
              <button type="button" class="btn btn-light"><a href="/games/{{$game->slug}}/delete">Delete Game</a></button>
              </div>
              @endauth
                </div>
                

            @endforeach
                    
    </div>
    </div>
    </div>   
    </div>
</div>
@endsection