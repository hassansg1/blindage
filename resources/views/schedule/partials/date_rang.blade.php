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
        <td class="@if($data->is_open == 1) businessHoursOpen @else businessHoursClosed @endif">
            <a class="available_wrapper" href="#" onclick="getModalData()"
                {{--           data-bs-toggle="modal" data-bs-target="#available_modal"--}}
            >
                <div class="@if($data->is_open == 1) timing @else closedText @endif">
                    @if($data->is_open == 1)    {{date('h:i a', strtotime($data->start_time))}} - {{date('h:i a', strtotime($data->end_time))}}
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
        @php($authuser = \Illuminate\Support\Facades\Auth::user())
        <div class="employeeInfo">
            <div class="employeeCircle">
                {{$authuser->first_name[0]}}
                {{$authuser->last_name[0]}}
            </div>
            <div class="employeeName">
                {{$authuser->first_name}} {{$authuser->last_name}}
            </div>
        </div>
    </td>

    @foreach ($period as $key => $value)
    @php($branchData = checkBranchOpen($value->format('Y-m-d')))
        <td class="businessHoursOpen @if(isset($branchData->is_open)?$branchData->is_open:'0' == 1) available @endif">
        <a class="available_wrapper" href="#" onclick="getModalData('{{$value->format('Y-m-d')}}','{{$key}}')"
        >
            <div class="timing" id="{{$value->format('Ymd')}}">
                @if(isset($branchData->is_open)?$branchData->is_open:'0' == 1)
                {!! getBranchTime($value->format('Y-m-d')) !!}
                @else
                    {{isset($branchData->reason)?$branchData->reason:'Off Day'}}
                @endif
            </div>
        </a>
    </td>
    @endforeach
</tr>
