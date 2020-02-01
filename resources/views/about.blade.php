@extends('layouts.app')

@section('content')
<div class="article-dual-column">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="intro">
                        <h1 class="text-center">About Us</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-lg-3 offset-md-1">
                    <div class="toc">
                        <img src="{{asset('/storage/images/aboutus.png')}}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-10 col-lg-7 offset-md-1 offset-lg-0">
                    <div class="text">
                        <p>We fell in love with board games after receiving Catan from Larissa's family as a Christmas gift. 
                            Since then, we have board game nights with family and friends as much as possible. We have grown our board
                            game collection very quickly, and do not plan on stopping anytime soon.
                        </p>
                        <p>So what do we love so much about board games? It's a great way to spend time together, create and maintain conversations,
                            have a laugh, be serious, bluff, lie, form alliances, or go to war - all with the people we enjoy being around the most!
                        </p>
                        <p>We started this website to share our thoughts on the board games we play. We hope to help others make decisions
                            regarding which games to try next.
                        </p>
                        <p>Our rating system is comprised of three elements: Gameplay (10points), Replayability (5points), and Components (5points).
                            We average both of our ratings in these categories to create a rating out of ten.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection