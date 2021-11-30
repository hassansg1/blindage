<tr>
    <th width="30%"></th>
    @foreach ($period as $key => $value)
    <th width="10%">
        <div class="day-header">
            <div class="day-of-week">{{ $value->format('D')}}</div>
            <div class="day-of-month">{{ $value->format('d')}}</div>
        </div>
    </th>
        @endforeach
</tr>
<tr id="businessHoursGeneral">
    <td>
        <div class="businessHours">
            <div>
                <div class="businessHoursText">
                    Business Hours
                </div>
                <div class="businessHoursEdit">
                    <a data-bs-toggle="modal" data-bs-target=".businessHoursModal">Edit</a>
                </div>
            </div>
        </div>
    </td>

    @foreach ($period as $key => $value)

        @php($data = $branchTime->where('day','=',$value->format('D'))->first())
        <td class="@if($data->start_time != null) businessHoursOpen @else businessHoursClosed @endif">
            <a class="available_wrapper" href="#" onclick="getModalData()"
                {{--           data-bs-toggle="modal" data-bs-target="#available_modal"--}}
            >
                <div class="@if($data->start_time != null) timing @else closedText @endif">
                    @if($data->start_time != null)    {{date('h:i a', strtotime($data->start_time))}} - {{date('h:i a', strtotime($data->end_time))}}
                    @else
                        Closed
                    @endif
                </div>
            </a>
        </td>
    @endforeach
    </tr>

<tr id="branchDataId">
    <td>
        <div class="employeeInfo">
            <div class="employeeCircle">
                AY
            </div>
            <div class="employeeName">
{{--                {{auth()->name}}--}}
                {{\Illuminate\Support\Facades\Auth::user()->first_name}} {{\Illuminate\Support\Facades\Auth::user()->last_name}}
            </div>
        </div>
    </td>

    @foreach ($period as $key => $value)

        <td class="businessHoursOpen @if(getStartTime($value->format('Y-m-d')) == 1) available @endif">
        <a class="available_wrapper" href="#" onclick="getModalData('{{$value->format('Y-m-d')}}','{{$key}}')"
        >
            <div class="timing" id="{{$value->format('Ymd')}}">
                {!! getBranchTime($value->format('Y-m-d')) !!}
            </div>
        </a>
    </td>
    @endforeach
</tr>
