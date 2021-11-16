@foreach($data as $images)
    <img src="images/files/{{$images->filename}}" widht="100px" height="100px" alt="{{$images->filename}}">
@endforeach
