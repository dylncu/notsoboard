@extends('layouts.app')

@section('content')

@if($game->hasTwoReviews())

<div class="article-dual-column">
        <div class="container reviews-block">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="rating-absolute">
                    <img src="{{asset('/storage/images/nsbratingfill.png')}}" class="nsbrating-review-page" id="banner">
                    <h2 class="review-page-rating">{{$game->rating()}}</h2>
                    </div>
                    <div class="intro">
                        <h1 class="text-center">{{$game->name}}</h1>
                        <p class="text-center review-header-desc"><span class="by">Not So Board</span> <span class="date">{{$reviews[0]->date()}} </span>  <span class="date"><a class="btn btn-light btn-sm" href="{{$game->referral_link}}" role="button" target="_blank">Amazon</a></span></p></div>
                </div>
            </div>
            @foreach($reviews as $review)
            <div class="row review">
                <div class="col-md-10 col-lg-3 offset-md-1">
                    <div class="toc">
                        <p>{{ $review->author->name }}</p>
                        <table class="table table-borderless table-sm review-table"> 
                    <tbody>
                    <tr class="review-table-row">
                        <td>Gameplay</td>
                        <td>{{ $review->gameplay }}<span class="out-of">/10</span></td>
                    </tr>
                    <tr>
                        <td>Replayability</td>
                        <td>{{ $review->replayability }}<span class="out-of">/5</span></td>
                    </tr>
                    <tr>
                        <td>Components</td>
                        <td>{{ $review->components }}<span class="out-of">/5</span></td>
                    </tr>
                    </tbody>
                </table>
                    </div>
                </div>
                <div class="col-md-10 col-lg-7 offset-md-1 offset-lg-0">
                    <div class="text markdown">
                    @parsedown($review->markdown)
                </div>
            </div>
        </div>
        @endforeach
        <div class="row">
        <div class="col-md-10 offset-md-1">
        <p class="text-right back-to-reviews"><a class="btn btn-light btn-sm" href="/reviews" role="button">Back to Reviews</a></p>
        </div>
        </div>
    </div> 
</div>
@else
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h5>Sorry, this page is not available yet :(</h5>
        </div>
    </div>
</div>
@endif
@endsection