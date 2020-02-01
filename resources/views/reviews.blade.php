@extends('layouts.app')

@section('content')

<div class = "container">
<div class="col-md-4 offset-md-4">
    <img class="img-fluid" src="{{asset('/storage/images/reviewsheader.png')}}">
    <p class="text-center"> Sort by:
        <a href="/reviews" class="tag">Recent</a>
        <a href="/reviews?sort=best" class="tag">Best</a>
    </p>
    </div>
    @foreach($games as $game)
    @if($game->hasTwoReviews())
    <div class="row reviews-row">
        <div class="col-md-2 offset-md-2">
        <a href="/games/{{$game->slug}}" class="game-img-block"><img class="img-fluid front-page-image rounded mx-auto d-block reviews-row-image" src="{{asset($game->photo())}}"></a>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                    <img src="{{asset('/storage/images/nsbratingfill.png')}}" class="nsbratingfill">
                    <!--<img src="{{asset('/storage/images/nsbrating.png')}}" class="nsbrating">-->
                    <th class="review-score" scope="col">
                        <h5>{{$game->rating()}}</h5>
                    </th>
                    <th class="review-col" scope="col"><a class="game-name" href="/games/{{$game->slug}}"><h5>{{$game->name}}</h5></a></th>
                    <th scope="col"><a class="btn btn-light btn-sm" href="{{$game->referral_link}}" role="button">Amazon</a></th>
                    </tr>
                </thead>
            </table>
            <div class="text markdown">
            <span class="out-of">
            {{$game->reviews[0]->date()}}
            </span>
                @parsedown($game->reviews[0]->preview()) 
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
</div>

@endsection