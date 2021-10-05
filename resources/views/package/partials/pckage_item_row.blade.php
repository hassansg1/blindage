@if($data)
<tr id="tableRow{{$type}}{{$data->id}}">
    <td>{{$data->name}}</td>
    <td>${{isset($data->price)?$data->price: $data->retail_price}}</td>
    <td><input style="width: 50%" type="number" name="qty[]" min="1" value="1" class="form-control"></td>
    <input type="hidden" name="id[]" value="{{$data->id}}">
    <input type="hidden" name="type[]" value="{{$type}}">
    <td>
        <button onclick="if(confirm('Are you sure you want to delete?')) $('#tableRow{{$type}}{{$data->id}}').remove()" title="Delete"
                type="button" class="btn btn-light btn-form btn-no-color">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td>
</tr>
@endif
