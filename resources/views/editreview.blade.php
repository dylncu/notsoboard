@extends('layouts.app')

@section('content')

<div class= "container">
<form method = "POST" action="/reviews/{{$review->id}}" enctype="multipart/form-data">
    @csrf
    <h3> Edit Review for {{$game->name}} </h3>
    <div class="form-group">
        <div> Gameplay: <input type="text" name="gameplay" value="{{$review->gameplay}}"> </div> 
    </div>
    <div class="form-group">
        Replayability: <input type="text" name="replayability" value="{{$review->replayability}}">
    </div>
    <div class="form-group">
        <div> Components: <input type="text" name="components" value="{{$review->components}}"></div> 
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Review</label>
        <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10" name="markdown">{{$review->markdown}}</textarea>
    </div> 
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div><p></p></div>
<div class="row">
        @foreach($photos as $photo)
        <div class="col-12">
            <img class="" src="{{ '/storage/images/' . $photo->image }}" style="height:200px;">
            <p>![Image of {{ $game->name }}]({{ '/storage/images/' . $photo->image }})</p>
        </div>
        @endforeach
</div>
</div>
</div>

@endsection