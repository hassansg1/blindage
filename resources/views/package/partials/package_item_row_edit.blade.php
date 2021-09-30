@if(count($data->items))
    @foreach($data->items as $data)

<tr id="tableRow{{$data->id}}">
    <td>{{$data->packageitemable->name}}</td>
    <td>${{isset($data->packageitemable->price)?$data->packageitemable->price:$data->packageitemable->retail_price}}</td>
    <td><input style="width: 50%" value="{{$data->quantity}}" type="number" name="qty[]" class="form-control"></td>
    <input type="hidden" name="id[]" value="{{$data->packageitemable_id}}">

    <input type="hidden" name="type[]" value="{{get_class($data->packageitemable)}}">
    <td>
        <button onclick="if(confirm('Are you sure you want to delete?')) $('#tableRow{{$data->id}}').remove()" title="Delete"
                type="button" class="btn btn-light btn-form btn-no-color">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td>
</tr>
    @endforeach
@endif
