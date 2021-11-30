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
<tr>
    <td>
        <div class="businessHours">
            <div>
                <div class="businessHoursText">
                    Business Hours
                </div>
                <div class="businessHoursEdit">
                    <a href="#">Edit</a>
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
                    @if($data->start_time != null)    {{date('H:m a', strtotime($data->start_time))}} - {{date('H:m a', strtotime($data->end_time))}}
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
                Atique Yousaf
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




{{--<td class="businessHoursClosed">--}}
{{--    <div class="closedText">--}}
{{--        <div></div>--}}
{{--    </div>--}}
{{--</td>--}}
{{--<td class="businessHoursClosed">--}}
{{--    <div class="closedText">--}}
{{--        <div></div>--}}
{{--    </div>--}}
{{--</td>--}}
{{--<td class="businessHoursOpen available">--}}
{{--    <a class="available_wrapper" href="#" onclick="getModalData()"--}}
{{--        --}}{{--           data-bs-toggle="modal" data-bs-target="#available_modal"--}}
{{--    >--}}
{{--        <div class="timing">--}}
{{--            9:00am - 7:00pm--}}
{{--        </div>--}}
{{--    </a>--}}
{{--</td>--}}
{{--<td class="businessHoursOpen available">--}}
{{--    <div class="timing">--}}
{{--        9:00am - 7:00pm--}}
{{--    </div>--}}
{{--</td>--}}
{{--<td class="businessHoursOpen available">--}}
{{--    <div class="timing">--}}
{{--        9:00am - 7:00pm--}}
{{--    </div>--}}
{{--</td>--}}
{{--<td class="businessHoursOpen available">--}}
{{--    <div class="timing">--}}
{{--        9:00am - 7:00pm--}}
{{--    </div>--}}
{{--</td>--}}
{{--<td class="businessHoursOpen available">--}}
{{--    <div class="timing">--}}
{{--        9:00am - 7:00pm--}}
{{--    </div>--}}
{{--</td>--}}
