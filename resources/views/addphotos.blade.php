@extends('layouts.app')

@section('content')

<div class= "container">
<div>
<form method = "POST" action="/games/addphotos" enctype="multipart/form-data">
    @csrf
    <h3> Add Photos to {{ $game->name }} </h3>
    <input type="hidden" name="game_id" value="{{ $game->id }}">
    <input type="file" name="image[]" multiple>
    <br></br> 
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<div class="row">
        @foreach($photos as $photo)
        
        <div class="col-md-6">
            <img class="" src="{{ '/storage/images/' . $photo->image }}" style="height:200px;">
            <p>![Image of {{ $game->name }}]({{ '/storage/images/' . $photo->image }})</p>
            <button type="button" class="btn btn-light"><a href="/photo/{{$photo->id}}">Delete Photo</a></button>
        </div>
        @endforeach
</div>
</div>
</div>

@endsection