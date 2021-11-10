@foreach(getAppointmentType() as $key=> $type)
    <tr>
        <td>{{$type->name}}</td>
        <td>
            <div>
                <input type="hidden" class="form-control" name="row[{{$key}}][id]" value="{{$type->id}}">
                <input type="text" class="form-control"  name="row[{{$key}}][color]" id="colorpicker-default-{{str_replace(' ','-',trim($type->name))}}" value="{{$type->color}}">
            </div>
        </td>
    </tr>
@endforeach
