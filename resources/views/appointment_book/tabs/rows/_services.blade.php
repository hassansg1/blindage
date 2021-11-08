@foreach(getServices() as $key=> $service)
    <tr>
        <td>{{$service->name}}</td>
        <td>
            <div>
                <input type="hidden" class="form-control" name="row[{{$key}}][id]" value="{{$service->id}}">
                <input type="text" class="form-control"  name="row[{{$key}}][color]" id="colorpicker-default-{{$service->id}}" value="{{$service->color}}">
            </div>
        </td>
    </tr>
    <script>
        $("#colorpicker-default-{{$service->id}}").spectrum();
    </script>
@endforeach
