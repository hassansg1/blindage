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
                @if($data->start_time != null)    {{date('H:m a', strtotime($data->start_time))}} - {{date('H:m a', strtotime($data->end_time))}}
                @else
                    Closed
                @endif
            </div>
        </a>
    </td>
@endforeach
