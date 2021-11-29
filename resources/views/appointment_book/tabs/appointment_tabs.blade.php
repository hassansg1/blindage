<div class="top-nav-tabs-wrapper d-flex mb-2">
            <h3 class="mb-0">Appointment Book</h3>
            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#Calendar" role="tab">
                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-block">Calendar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#appointment-list" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-block">Appointment List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-block">Settings</span>
                </a>
            </li>
        </ul>
        </div>
        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target=".businessHoursModal" >Hello</button>
       
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
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input openHoursCheckbox" type="checkbox" checked="checked" id="" name="" value="1">
                                    </div>
                                </td>
                                <td>Sunday</td>
                                <td>
                                    <span class="closedHours">Closed</span>
                                    <div class="d-flex gap-3 align-middle businessHoursTP">
                                        <div class="input-group" id="timepicker-input-group10">
                                            <input id="timepicker10" type="text" class="form-control"
                                            data-provide="timepicker" value="09:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                        <span class="d-flex align-middle">-</span>
                                         <div class="input-group" id="timepicker-input-group11">
                                            <input id="timepicker11" type="text" class="form-control"
                                            data-provide="timepicker" value="19:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input openHoursCheckbox" type="checkbox" checked="checked" id="" name="" value="1">
                                    </div>
                                </td>
                                <td>Monday</td>
                                <td>
                                    <span class="closedHours">Closed</span>
                                    <div class="d-flex gap-3 align-middle businessHoursTP">
                                        <div class="input-group" id="timepicker-input-group12">
                                            <input id="timepicker10" type="text" class="form-control"
                                            data-provide="timepicker" value="09:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                        <span class="d-flex align-middle">-</span>
                                         <div class="input-group" id="timepicker-input-group11">
                                            <input id="timepicker13" type="text" class="form-control"
                                            data-provide="timepicker"  value="19:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input openHoursCheckbox" type="checkbox" checked="checked" id="" name="" value="1">
                                    </div>
                                </td>
                                <td>Tuesday</td>
                                <td>
                                    <span class="closedHours">Closed</span>
                                    <div class="d-flex gap-3 align-middle businessHoursTP">
                                        <div class="input-group" id="timepicker-input-group16">
                                            <input id="timepicker16" type="text" class="form-control"
                                            data-provide="timepicker" value="09:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                        <span class="d-flex align-middle">-</span>
                                         <div class="input-group" id="timepicker-input-group17">
                                            <input id="timepicker17" type="text" class="form-control"
                                            data-provide="timepicker"  value="19:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input openHoursCheckbox" type="checkbox" checked="checked" id="" name="" value="1">
                                    </div>
                                </td>
                                <td>Wednesday</td>
                                <td>
                                    <span class="closedHours">Closed</span>
                                    <div class="d-flex gap-3 align-middle businessHoursTP">
                                        <div class="input-group" id="timepicker-input-group18">
                                            <input id="timepicker18" type="text" class="form-control"
                                            data-provide="timepicker" value="09:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                        <span class="d-flex align-middle">-</span>
                                         <div class="input-group" id="timepicker-input-group19">
                                            <input id="timepicker19" type="text" class="form-control"
                                            data-provide="timepicker"  value="19:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input openHoursCheckbox" type="checkbox" checked="checked" id="" name="" value="1">
                                    </div>
                                </td>
                                <td>Thursday</td>
                                <td>
                                    <span class="closedHours">Closed</span>
                                    <div class="d-flex gap-3 align-middle businessHoursTP">
                                        <div class="input-group" id="timepicker-input-group20">
                                            <input id="timepicker20" type="text" class="form-control"
                                            data-provide="timepicker" value="09:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                        <span class="d-flex align-middle">-</span>
                                         <div class="input-group" id="timepicker-input-group21">
                                            <input id="timepicker21" type="text" class="form-control"
                                            data-provide="timepicker"  value="19:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input openHoursCheckbox" type="checkbox" checked="checked" id="" name="" value="1">
                                    </div>
                                </td>
                                <td>Friday</td>
                                <td>
                                    <span class="closedHours">Closed</span>
                                    <div class="d-flex gap-3 align-middle businessHoursTP">
                                        <div class="input-group" id="timepicker-input-group22">
                                            <input id="timepicker22" type="text" class="form-control"
                                            data-provide="timepicker" value="09:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                        <span class="d-flex align-middle">-</span>
                                         <div class="input-group" id="timepicker-input-group23">
                                            <input id="timepicker23" type="text" class="form-control"
                                            data-provide="timepicker"  value="19:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input openHoursCheckbox" type="checkbox" checked="checked" id="" name="" value="1">
                                    </div>
                                </td>
                                <td>Saturday</td>
                                <td>
                                    <span class="closedHours">Closed</span>
                                    <div class="d-flex gap-3 align-middle businessHoursTP">
                                        <div class="input-group" id="timepicker-input-group24">
                                            <input id="timepicker24" type="text" class="form-control"
                                            data-provide="timepicker" value="09:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                        <span class="d-flex align-middle">-</span>
                                         <div class="input-group" id="timepicker-input-group25">
                                            <input id="timepicker25" type="text" class="form-control"
                                            data-provide="timepicker"  value="19:00">
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn btn-primary">Save</div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- business Hours Modal End -->
<div class="">
    <div class="">
        <!-- Tab panes -->
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="Calendar" role="tabpanel">
               @include('appointment_book.tabs.calender')
            </div>
            <div class="tab-pane" id="appointment-list" role="tabpanel">
               <div class="card">
                   <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            {{-- <button class="btn btn-outline-warning waves-effect waves-light" >Today</button> --}}
                            <input type="hidden" id="appt_view_today" name="appt_view_today" value="0">
                            <input class="form-check-input mt-0" type="checkbox"
                                       id="appt_view_today_label" value="" onclick="this.checked ? $('#appt_view_today').val(1) : $('#appt_view_today').val(0)">
                            <label class="form-check-label" for="appt_view_today_label">
                                Today
                            </label>
                        </div>
                        <div class="d-flex">
                            <div>
                                <select class="form-select mb-2 width-180" id="status_flag">
                                    <option value=""> All Appointments</option>
                                    <option value='{{  App\Models\AppointmentBook::OPENED }}'>Opened </option>
                                    <option value='{{  App\Models\AppointmentBook::CHECKIN }}'>CheckedIn </option>
                                    <option value='{{  App\Models\AppointmentBook::TIMEBLOCK }}'>Time Block </option>
                                    <option value='{{  App\Models\AppointmentBook::CHECKOUT }}'>Closed/CheckOut</option>
                                    <option value='{{  App\Models\AppointmentBook::NOSHOW }}'>No Show </option>
                                    <option value='{{  App\Models\AppointmentBook::CANCELED }}'>Canceled </option>
                                    <option value='{{  App\Models\AppointmentBook::VOIDED }}'>Voided </option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div>
                                <select class="form-select mb-2 width-180" id="branch_id_search">
                                    <option value=""> All Branch</option>
                                    @foreach(\App\Models\Branch::all() as $branch)
                                        <option value="{{ $branch->id ?? '' }}">{{ $branch->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <div>
                                <input type="text" id="dateRange_appointmentList">
                            </div>
                        </div>
                    </div>

                       <div class="custom_table_div">
                        @include('filters.export')

                            <table id="view-List" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">

                                <thead class="table-light custom_table_head">
                                <tr>
                                    <th class="">id</th>
                                    <th>Client Name</th>
                                    <th>Date</th>
                                    <th>Service</th>
                                    <th>Status</th>
                                    <th>Employee</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody id="table_content_div_body">

                                    {{-- //// Data Append With DataTable Ajax --}}
                                </tbody>
                            </table>
                        </div>
                   </div>
               </div>
            </div>
            <div class="tab-pane" id="settings" role="tabpanel">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="left-side-bar-wrapper p-2">
                            <div class="card no-border">
                                <div class="">
                                    <div class="row">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                            aria-expanded="true" aria-controls="flush-collapseOne">
                                                      Appointment Colors
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                                     aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample"
                                                     style="">
                                                    <div class="accordion-body text-muted">
                                                         <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link mb-2 active" id="v-pills-services-tab" data-bs-toggle="pill" href="#v-pills-services" role="tab" aria-controls="v-pills-services" aria-selected="true">Services</a>
                                                <a class="nav-link mb-2" id="v-pills-appointment-tab" data-bs-toggle="pill" href="#v-pills-appointment" role="tab" aria-controls="v-pills-appointment" aria-selected="false">Apppintment Type</a>

                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="v-pills-services" role="tabpanel" aria-labelledby="v-pills-services-tab">
                                                       <h3>Service Color Codes</h3>
                                                       <p>Change the appointment block colors for services and categories.</p>
                                                       <div class="services-search-wrapper">
                                                            <div class="row">
                                                                <div class="input-search col-md-5">
                                                                    <div class="mb-2 icon-wrapper">
                                                                       <i class="fa fa-search icon"></i>
                                                                       <input class="form-control" type="text" name="" placeholder="Search Services /  Category">
                                                                     </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <form method="post" action="{{route('update.serviceColor')}}" id="service-form-id">
                                                                        @csrf
                                                                    <table class="table">
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th>Color</th>
                                                                            <th></th>
                                                                        </tr>
                                                                        @include('appointment_book.tabs.rows._services')
                                                                     </table>

                                                                    <div>
                                                                        <button class="btn btn-primary" type="submit">Save</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                       </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="v-pills-appointment" role="tabpanel" aria-labelledby="v-pills-appointment-tab">
                                                       <h3>Appointment Type Color Codes</h3>
                                                       <p>Add a secondary color to your calendar based on the selected appointment type.</p>
                                                       <div class="services-search-wrapper">
                                                        <form action="{{route('update.appointmentColor')}}" method="post">
                                                            @csrf
                                                            <div class="row">
                                                               <div class="input-search col-md-5">
                                                                    <div class="mb-2 icon-wrapper">
                                                                       <i class="fa fa-search icon"></i>
                                                                       <input class="form-control" type="text" name="" placeholder="Search Services /  Category">
                                                                    </div>
                                                               </div>
                                                               </div>
                                                                <div class="row">
                                                                    <div class="col-md-7">
                                                                        <table class="table">
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Color</th>
                                                                            </tr>

                                                                            @include('appointment_book.tabs.rows._appoinment_type')

                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                                </div>
                                                       </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // $('#service-form-id').on('submit',function (e) {
    // e.preventDefault();
    // console.log($(this).serialize())
    // });
</script>
