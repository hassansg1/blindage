<div class="row mb-3">
    <div class="col-md-7">
        <label>Who?</label>
        <div>{{$user->first_name}} {{$user->last_name}}</div>
    </div>
    <div class="col-md-5">
        <label>Working ?</label>
        <div class="mb-3">
            <input type="checkbox" id="working_yes_no_switcher" name="is_open" value="1" switch="warning" checked />
            <label for="working_yes_no_switcher" data-on-label="Yes" data-off-label="No"></label>
        </div>

    </div>
</div>
<div class="row mb-3">
    <div class="col-md-7">
        <label>When?</label>
        <div>{{date('D',strtotime($dateValue))}}, {{$dateValue}}</div>
        <input type="hidden" value="{{$dateValue}}" name="activityDate">
    </div>
    <div class="col-md-5">
        <div class="form-check form-check-warning mb-3 checkbox_styling">
            <input class="form-check-input" type="checkbox" name="is_repeat" id="reapeat_checkbox" value="1">
            <label class="form-check-label" for="reapeat_checkbox">
                Repeat
            </label>
        </div>
    </div>
</div>
<div class="working_off_wrapper mb-3">
    <label>Why?</label>
    <select class="form-select" id="inlineFormSelectPref" name="reason">
        <option selected=""></option>
        <option value="1">Day Off</option>
        <option value="2">Vocation</option>
        <option value="3">Illness</option>
        <option value="3">Personal Business Day</option>
    </select>
</div>
<div class="scheduled_times-wrapper">
    <div class="row form-group" id="par1">
        <div class="col-lg-9">
            @if($time != null && count($time->scheduleTime))
            @foreach($time->scheduleTime as $key => $item)
            <div class="scheduled_times">
                <div class="">
                    <div class="input-group" id="timepicker-input-group1">
                        <input id="timepicker" name="row[{{$key}}][start_time]" value="{{date('h:i A',strtotime($item->start_time))}}" type="text" class="form-control" data-provide="timepicker">
                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                    </div>
                </div>
                <div>
                    -
                </div>
                <div>
                    <div class="input-group" id="timepicker-input-group5">
                        <input id="timepicker5" name="row[{{$key}}][end_time]" value="{{date('h:i A',strtotime($item->end_time))}}" type="text" class="form-control"
                               data-provide="timepicker">

                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                    </div>
                </div>
            </div>
            @endforeach
                <input type="hidden" value="{{count($time->scheduleTime) ?? 1}}" name="incrementData">
                @else
                <div class="scheduled_times">
                    <div class="">
                        <div class="input-group" id="timepicker-input-group1">
                            <input id="timepicker" name="row[0][start_time]" type="text" class="form-control" data-provide="timepicker">
                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                        </div>
                    </div>
                    <div>
                        -
                    </div>
                    <div>
                        <div class="input-group" id="timepicker-input-group5">
                            <input id="timepicker5" name="row[0][end_time]"  type="text" class="form-control"
                                   data-provide="timepicker">

                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="1" name="incrementData">
                    @endif
        </div>
        <div class="col-lg-3">
            <div class="plus_value" onclick="addpark(1);">
                <a href="#">Add More</a>
            </div>
            <div class="minus_value" onclick="delpark(1);" >
                <i class="fa fa-times"></i>
            </div>

        </div>
    </div>
</div>
<div class="weeks_data" id="weeks_data">
    <div class="repeat_every_data mt-3">
        <div class="repeat_text">Repeat every</div>
        <div>
            <input type="number" name="repeatTime" min="1" class="form-control" value="1">
        </div>
        <select class="form-select " id="" name="addDateType">
            <option selected="" value="week">Week</option>
            <option value="month">Month</option>
        </select>
    </div>
    <div class="repeat_on_data mt-3">
        <div class="repeat_on_text">Repeat on<span class="text-red">*</span></div>
        <div class="week_wrapper">
            <ul>
                <li>S<input type="checkbox" name="repeatWeek[]" value="Sun"></li>
                <li>M<input type="checkbox" name="repeatWeek[]"  value="Mon"></li>
                <li>T<input type="checkbox" name="repeatWeek[]"  value="Tue"></li>
                <li>W<input type="checkbox" name="repeatWeek[]"  value="Wed"></li>
                <li>T<input type="checkbox" name="repeatWeek[]"  value="Thu"></li>
                <li>F<input type="checkbox" name="repeatWeek[]"  value="Fri"></li>
                <li>S<input type="checkbox" name="repeatWeek[]"  value="Sat"></li>
{{--                <li><button>M</button></li>--}}
{{--                <li><button>T</button></li>--}}
{{--                <li><button>W</button></li>--}}
{{--                <li><button>T</button></li>--}}
{{--                <li><button>F</button></li>--}}
{{--                <li><button>S</button></li>--}}
            </ul>
        </div>
    </div>
{{--    <div class="end_date_calender d-flex mt-3">--}}
{{--        <div class="repeat_on_text" style="width: 156px;">Ends on<span class="text-red">*</span></div>--}}
{{--        <div class="input-group" id="datepicker1">--}}
{{--            <input type="text" class="form-control" placeholder="dd M, yyyy"--}}
{{--                   data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-provide="datepicker">--}}
{{--            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>--}}
{{--        </div><!-- input-group -->--}}
{{--    </div>--}}

</div>

<script>
    $('.working_off_wrapper').hide();
    $('#working_yes_no_switcher').click(function(){
        if ($(this).is(':checked')){
            $('.scheduled_times-wrapper').show();
            $('.working_off_wrapper').hide();
        }else{
            $('.scheduled_times-wrapper').hide();
            $('.working_off_wrapper').show();
        }
    });
    var newid = $('#incrementData').val();

    function addpark(id){
        newid += 1;  //newid = newid+1;
        var data = `<div class="row mt-2" id="par${newid}"><div class="col-md-9"><div class="scheduled_times"><div class=""><div class="input-group" id="timepicker-input-group1"><input id="timepicker" type="text" class="form-control"  name="row[${newid}][start_time]" data-provide="timepicker"><span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span></div></div><div> - </div><div><div class="input-group" id="timepicker-input-group5"><input id="timepicker5" type="text" class="form-control" name="row[${newid}][end_time]" data-provide="timepicker"><span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span></div></div></div></div><div class="col-md-3"><div class="plus_value" onclick="addpark(1);">
      <a href="#">Add More</a>
   </div><div class="minus_value" onclick="delpark(${newid});" ><i class="fa fa-times"></i></div></div></div>`;
        $(".scheduled_times-wrapper").append(data);
        if(newid >= 3){
            $('.scheduled_times-wrapper').addClass('all_added')
        }else{
            $('.scheduled_times-wrapper').removeClass('all_added')
        }

    }
    function delpark(id){
        newid -= 1;  //newid = newid+1;
        $('#par'+id).remove();
        if(newid >= 3){
            $('.scheduled_times-wrapper').addClass('all_added')
        }else{
            $('.scheduled_times-wrapper').removeClass('all_added')
        }

    }

    $(document).ready(function(){
        $('#weeks_data').hide()
        $('#reapeat_checkbox').click(function(){
            if ($(this).is(':checked')){
                $('#weeks_data').slideDown()
            }else{
                $('#weeks_data').slideUp();}
        })
        $('.week_wrapper li').click(function(){
            $(this).find('button').toggleClass('active');

        });

    });

</script>
