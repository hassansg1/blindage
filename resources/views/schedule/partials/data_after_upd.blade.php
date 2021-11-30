<td>
    <div class="employeeInfo">
        <div class="employeeCircle">
            AY
        </div>
        <div class="employeeName">
            Atique Yousaf
        </div>
    </div>
</td>

@foreach ($period as $key => $value)

    <td class="businessHoursOpen @if(getStartTime($value->format('Y-m-d')) == 1) available @endif">
        <a class="available_wrapper" href="#" onclick="getModalData('{{$value->format('Y-m-d')}}')"
        >
            <div class="timing" id="{{$value->format('Ymd')}}">
                {!! getBranchTime($value->format('Y-m-d')) !!}
            </div>
        </a>
    </td>
@endforeach
