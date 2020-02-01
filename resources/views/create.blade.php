@extends('layouts.app')

@section('content')

<div class= "container">
<form method = "POST" action="/games" enctype="multipart/form-data">
    @csrf
    <h3> Add Game </h3>
    <div> Name: <input type="text" name="name"> </div> 
    <div> Min Player: <input type="text" name="player_count_min"></div> 
    <div> Max Player: <input type="text" name="player_count_max">
    Or more: <input type="checkbox" name="or_more"></div> 
    <div>
        @foreach($publishers as $publisher)
            <button type="button" class="btn btn-light btn-small" class="publisher" onclick="addPublisher('{{ $publisher->publisher }}')">{{ $publisher->publisher }}</button>
        @endforeach
    </div>
    Publisher: <input type="text" name="publisher" id="publisher">
    <div>
        Playtime in minutes | min: <input type="text" name="playtime_min">
        max: <input type="text" name="playtime_max">
    </div>
  
    
    <div> 
        @foreach($tags as $tag)
            <button type="button" class="btn btn-light btn-small" class="tags" onclick="addTag('{{ $tag->tag }}')">{{ $tag->tag }}</button>
        @endforeach
    </div>  
    <div>  Tags: <input type="textarea" name="tags" size="50" id=tags></div>  
    <div> <input type="file" name="image"> </div>
    <div> Referral Link: <input type="text" name="referral_link"> </div>
    <br></br> 
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>

@endsection

<script>
function addTag(tag) { 
    if(document.getElementById("tags").value == "") {
        document.getElementById("tags").value += tag;
    } else {
        document.getElementById("tags").value += " " + tag;
    }
}
function addPublisher(publisher) { 
    document.getElementById("publisher").value = publisher;
}
</script>
