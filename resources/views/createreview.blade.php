@extends('layouts.app')

@section('content')

<div class= "container">
<form method = "POST" action="/review" enctype="multipart/form-data">
    @csrf
    <h3> Write Review for {{ $game->name }} </h3>
    <div class="form-group">
        <div> Gameplay: <input type="text" name="gameplay"> </div> 
    </div>
    <div class="form-group">
        Replayability: <input type="text" name="replayability">
    </div>
    <div class="form-group">
        <div> Components: <input type="text" name="components"></div> 
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Review</label>
        <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10" name="markdown"></textarea>
    </div> 
    <button type="submit" class="btn btn-primary">Submit</button>

    <input type="hidden" name="gameID" value="{{ $game->id }}">
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