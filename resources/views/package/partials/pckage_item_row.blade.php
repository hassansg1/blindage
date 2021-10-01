@if($data)
<tr id="tableRow{{$type}}{{$data->type}}">
    <td>{{$data->name}}</td>
    <td>${{isset($data->price)?$data->price: $data->retail_price}}</td>
    <td><input style="width: 50%" type="number" name="qty[]" class="form-control"></td>
    <input type="hidden" name="id[]" value="{{$data->id}}">
    <input type="hidden" name="type[]" value="{{$type}}">
    <td>
        <button onclick="if(confirm('Are you sure you want to delete?')) $('#tableRow{{$type}}{{$data->type}}').remove()" title="Delete"
                type="button" class="btn btn-light btn-form btn-no-color">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td>
</tr>
@endif
