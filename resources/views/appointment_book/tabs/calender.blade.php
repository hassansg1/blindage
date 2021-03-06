<div class="main-schedule-wrapper">
    <div class="row">
        <div class="col-lg-2 pr-0 custom-width">
            <div class="left-side-bar-wrapper pb-2">
                <label class="p-2">Calender</label>
                <div data-provide="datepicker-inline" class="bootstrap-datepicker-inline" id="calenderValue"></div>
                <div id="selectWeek" class="text-center">
                    <span>+</span>
                    @for ($i = 1; $i < 9; $i++)
                    <span name="{{$i}}-week">{{ $i }}</span>
                    @endfor
                    <span>Weeks</span>
                </div>

                <div class="card no-border m-2">
                    <div class="">
                        <div class="row">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                            Waitlist({{count(waitListData())}})
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                        <div class="accordion-body text-mute">
                                            <div class="waitlistWrapper">
                                                @if(count(waitListData()) > 0)
                                                @foreach(waitListData() as $waitlist)
                                                <ul class="list-unstyled mb-0">
                                                    <li>
                                                        <b class="text-black">{{isset($waitlist->client)?$waitlist->client->first_name .' '. $waitlist->client->first_name:''}}</b>
                                                    </li>
                                                    <li>
                                                    {{isset($waitlist->client)?$waitlist->client->mobile_no:'' }}
                                                </li>
                                                    @if(count($waitlist->appointments))
                                                        @foreach($waitlist->appointments as $service)
                                                <li>
                                                 <div class="d-flex justify-content-between">
                                                     <div>
                                                         {{$service->service->name}}
                                                     </div>
                                                     <div>-</div>
                                                     <div>$ {{$service->service->price}}</div>
                                                 </div>
                                                </li>
                                                        @endforeach
                                                    @endif
                                                    <li>
                                                 <span>With</span> <span class="text-black">{{isset($waitlist->branch)? $waitlist->branch->first_name . ' '.$waitlist->branch->last_name :''}}</span>
                                             </li>
                                             <li>
                                                 <div class="item-date-time">
                                                     <div class="item-request-dateTime">
                                                         <div>
                                                             Any Time
                                                         </div>
                                                         <div>
                                                             {{date('m/d/y',strtotime($waitlist->activity_date))}}
                                                         </div>
                                                     </div>
{{--                                                     <div class="item-create-dateTime">--}}
{{--                                                         <div class="text-black">--}}
{{--                                                             Since--}}
{{--                                                         </div>--}}
{{--                                                         <div class="text-black">--}}
{{--                                                             {{date('m/d/y',$waitlist->activity_date)}}--}}
{{--                                                         </div>--}}
{{--                                                     </div>--}}
                                                 </div>
                                             </li>
                                         </ul>
                                             @endforeach
                                             @endif
                                     </div>
                                     <div class=" d-grid">
                                         <button type="button" class="btn btn-primary primary-alt btn-block" data-bs-toggle="modal" data-bs-target=".waitlistModal">Add to Waitlist</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- end row -->
             </div>
         </div>
         <div class="card no-border m-2">
             <div class="">
                 <div class="row">
                     <div class="accordion accordion-flush" id="accordionFlushExampleTwo">
                         <div class="accordion-item">
                             <h2 class="accordion-header" id="flush-headingOne">
                                 <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                                     Move Appointment
                                 </button>
                             </h2>
                             <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExampleTwo" style="">
                                 <div class="accordion-body text-muted">
                                     Nothing here
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- end accordion -->
                 </div>
                 <!-- end row -->
             </div>
         </div>
     </div>
 </div>
 <div class="col-lg-10">
     <div class="card">
         <div class="card-body">
             <div id="lnb">
                 <div id="right">
                     <div id="menu" class="mb-3">
                         <span id="menu-navi" class="d-sm-flex flex-wrap text-center text-sm-start justify-content-sm-between">
                             <div class="d-sm-flex flex-wrap gap-1">
                                 <div class="btn-group mb-2" role="group" aria-label="Basic example">
                                     <button type="button" class="btn btn-info move-day" data-action="move-prev">
                                         <i class="calendar-icon ic-arrow-line-left mdi mdi-chevron-left" data-action="move-prev"></i>
                                     </button>
                                     <button type="button" class="btn btn-info move-day" data-action="move-next">
                                         <i class="calendar-icon ic-arrow-line-right mdi mdi-chevron-right" data-action="move-next"></i>
                                     </button>
                                 </div>
                                 <button type="button" class="btn btn-success move-today mb-2" data-action="move-today">Today</button>
                             </div>
                             <h4 id="renderRange" class="render-range fw-bold"></h4>
                             <div class="dropdown align-self-start mt-3 mt-sm-0 mb-2">
                                 <button id="dropdownMenu-calendarType" class="btn btn-dark" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                     <i id="calendarTypeIcon" class="calendar-icon ic_view_month" style="margin-right: 4px;"></i>
                                     <span id="calendarTypeName">Dropdown</span>&nbsp;
                                     <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i>
                                 </button>
                                 <ul class="dropdown-menu dropdown-menu-end" role="menu" aria-labelledby="dropdownMenu-calendarType">
                                     <li role="presentation">
                                         <a class="dropdown-item" role="menuitem" data-action="toggle-daily"> <i class="calendar-icon ic_view_day"></i>Daily </a>
                                     </li>
                                     {{-- <li role="presentation">
                                         <a class="dropdown-item" role="menuitem" data-action="toggle-3_days">
                                             <i class="calendar-icon ic_view_3_days"></i>3 Days
                                         </a>
                                     </li> --}}
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-weekly"> <i class="calendar-icon ic_view_week"></i>Weekly </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-monthly"> <i class="calendar-icon ic_view_month"></i>Month </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-weeks2"> <i class="calendar-icon ic_view_week"></i>2 weeks </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-weeks3"> <i class="calendar-icon ic_view_week"></i>3 weeks </a>
                                        </li>
                                        <li role="presentation" class="dropdown-divider"></li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-workweek">
                                                <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-workweek" checked />
                                                <span class="checkbox-title"></span>Show weekends
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-start-day-1">
                                                <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-start-day-1" />
                                                <span class="checkbox-title"></span>Start Week on Monday
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-narrow-weekend">
                                                <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-narrow-weekend" />
                                                <span class="checkbox-title"></span>Narrower than weekdays
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex float-end gap-2 width-400">
                                <select class="form-select calendar_branch" name="branch_id">
                                    <option value="">All Branch</option>
                                    @foreach(\App\Models\Branch::all() as $branch)
                                    <option value="{{ $branch->id ?? '' }}">{{ $branch->name ?? '' }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary lnb-new-schedule-btn width-180" data-bs-toggle="modal" data-bs-target=".newScheduleModal">
                                    New Schedule
                                </button>

                            </div>
                        </div>
                    </div>
                    <div id="calendarList" class="lnb-calendars-d1 mt-4 mt-sm-0 me-sm-0 mb-4"></div>
                    <div id="calendar" style="height: 800px;"></div>
                    <!--New Schedule Modal Start-->

                </div>
                <!--New Schedule Modal End-->
            </div>
        </div>
    </div>
</div>
</div>

<!--  Wait List Modal Starts Here -->
<div class="modal fade waitlistModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Add to Waitlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <form id="appointment_wait_form" method="post" >
            {{ csrf_field() }}
            <input name="status_flag" value="{{App\Models\AppointmentBook::WAITLIST}}" type="hidden">
            <div class="modal-body">
             <div class="row">
                 <div class="col-xl-6">
                    <label for="when" class="form-label required">Which Client?</label>
                    <select id="select_client_drop_down_wait" required name="client_id" class="form-control">
                        <option value="">Select</option>
                        @foreach(\App\Models\Client::all() as $loopVariable)
                        <option value="{{ $loopVariable->id ?? '' }}" {{ isset($appt->client_id) && $appt->client_id==$loopVariable->id ?'selected':''  }}>{{ $loopVariable->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-2">
                    <a class="addNewClient mt-4 d-inline-block" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".addNewClientModal">
                        <i class="fa fa-plus mr-5"></i> <span> Add New Client</span>
                    </a>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
             <div class="col-md-4">
                 <div class="input-group" id="datepicker1">
                    <input type="text" class="form-control"  required name="activity_date"
                    value="{{ date('Y-m-d') }}"
                    data-date-format="yyyy-m-d" data-date-container='#datepicker1'
                    data-provide="datepicker" readonly data-date-autoclose="true">
                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-4">
             <select class="select2 form-control select2-multiple"  required name="start" multiple="multiple" onchange="setEndTime(this.value)" data-placeholder="Choose One ...">
                <optgroup label="Any Time">
                    <option value="10:00:00">Morning</option>
                    <option value="14:00:00">Afternoon</option>
                    <option value="16:00:00">Evening</option>
                </optgroup>
            </select>
        </div>
                <input type="hidden" name="end" id="endTime">
                <input type="hidden" name="time_start" id="time_start">
        <div class="col-md-4">
         <div class="d-flex">
             <div class="d-flex width-300 align-middle align-items-center">
                 Preferred Employee
             </div>
             <select class="form-select" name="branch_id"  required>
                 <option value="">Select branch</option>
                 @foreach(getBranches() as $branch)
                <option  value="{{$branch->id}}">{{$branch->first_name}}</option>
                 @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row mb-3">
 <div class="col-md-6">
    <label class="form-label required">Service</label>
    <select class="form-control select2" multiple name="services[]"  required>
       <option>-- Select Service -- </option>
       @foreach(\App\Models\Service::all() as $service_loopVariable)
       <option  value="{{ $service_loopVariable->id}}" >{{ $service_loopVariable->name ?? '' }}</option>
       @endforeach
   </select>
</div>
</div>
<div class="row">
 <div class="col-md-12">
    <h5 class="mt-20">Comments</h5>
    <div class="row">
        <div class="col-md-12">
            <textarea name="notes"  placeholder="Add Comment..." class="form-control"></textarea>
        </div>
    </div>
</div>
</div>
</div>
        <div class="modal-footer">
    <div class="btn btn-primary" id=""  type="button" onclick="submitWaitForm()">Save</div>

</div>
        </form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--  Wait List Modal Ends Here -->
