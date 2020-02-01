@extends('layouts.app')

@section('content')
<div class="container">
            <div class="row feature-welcome">
                <div class="col feature-paragraph">
                <img class="img-fluid" src="{{asset('/storage/images/gameheader.png')}}">
                    <h4 class="feature-text"></h4>
                    <h5 class="lead text-light feature-text"></h5>
                </div>
                <div class="col-md-4">
                    <h5 class="text-center">NSB Top Rated</h5>
                    <ul class="list-group">
                      @foreach($top5Games as $game)
                      <a class="top-rated" href="/games/{{$game->slug}}">
                        <li class="list-group-item top-rated-list-item text-right"><span>{{$game->name}} | {{$game->rating()}}</span></li>
                      </a>
                      @endforeach
                    </ul>
                </div>
            </div>
        </div>
<div class="article-list">
        <div class="container latest-reviews">
            <div class="intro">
                <h4 class="text-center latest-reviews-header">Latest Reviews</h4>
            </div>
      
            <div class="row articles">
            @foreach($games as $game)
            @if($game->hasTwoReviews())
                <div class="col-sm-6 col-md-4 item latest-review-block"><a href="/games/{{$game->slug}}"><img class="img-fluid front-page-image" src="{{asset($game->photo())}}"></a>
                    <h3 class="name">{{$game->name}}</h3>
                    <p class="text-center"><span class="by"></span> <span class="date">{{$game->reviews[0]->date()}}</span></p>
                    <div class="text markdown">
                    @parsedown($game->reviews[0]->preview())
                    <a class="game-name" href="/games/{{$game->slug}}">Read Review</a>
                </div>
            </div>
            @endif
            @endforeach    

    </div>
    </div>
    </div>
@endsection
