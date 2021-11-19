@foreach(\App\Models\Client::all() as $loopVariable)
    <option value="{{ $loopVariable->id ?? '' }}">{{ $loopVariable->name ?? '' }}</option>
@endforeach
