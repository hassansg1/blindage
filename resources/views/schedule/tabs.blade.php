
<div class="top-nav-tabs-wrapper d-flex mb-2">
            <h3 class="mb-0">Schedule</h3>
        </div>
<div class="">
    <div class="">
        <!-- Tab panes -->
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="Calendar" role="tabpanel">
               @include('schedule.tabs.calender')
            </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- business Hours Modal Start -->
<div class="modal fade businessHoursModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Business Hours</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="businessHoursTableWrapper">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th width="20%">Open</th>
                            <th width="20%">Day</th>
                            <th width="60%">Hours</th>
                        </tr>
                        </thead>
                        <tbody>
                        <form id="generalScheduleForm" method="post">
                        @if(generalSchedule())
                        @foreach(generalSchedule() as $key => $scheduleData)
                        <tr>
                            <td>
                                <input type="hidden" name="row[{{$key}}][id]" value="{{$scheduleData->id}}">
                                <div class="form-check">
                                    <input class="form-check-input" onclick="setDaySchedule(this,'{{$scheduleData->id}}')" type="checkbox" {{$scheduleData->is_open == '1' ? 'checked' : ''}} name="row[{{$key}}][is_open]" value="1">
                                </div>
                            </td>
                            <td>{{date('l', strtotime($scheduleData->day))}}</td>
                            <td>
                                <span class="closedHours" id="closeHours{{$scheduleData->id}}" style="display: none">Closed</span>
                                <div class="d-flex gap-3 align-middle" id="businessHoursTP{{$scheduleData->id}}" >
                                    <div class="input-group" id="timepicker-input-group10">
                                        <input id="timeStart{{$scheduleData->id}}" type="text" class="form-control" {{$scheduleData->is_open == '1' ? 'false' : 'disabled'}}
                                               data-provide="timepicker" @if($scheduleData->start_time != null)  value="{{date('h:i A', strtotime($scheduleData->start_time))}}" @endif name="row[{{$key}}][start_time]">
                                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    </div>
                                    <span class="d-flex align-middle">-</span>
                                    <div class="input-group" id="timepicker-input-group11">
                                        <input id="timeEnd{{$scheduleData->id}}" type="text" class="form-control"  {{$scheduleData->is_open == '1' ? 'false' : 'disabled'}}
                                               data-provide="timepicker" @if($scheduleData->end_time != null) value="{{date('h:i A', strtotime($scheduleData->end_time))}}" @endif name="row[{{$key}}][end_time]">
                                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                            @endif
                        </tbody>
                        </form>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn btn-primary" onclick="setGeneralSchedule()">Save</div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

