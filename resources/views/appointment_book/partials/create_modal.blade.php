<form action="" id="appointment_form" name="appointment_form">
    {{ csrf_field() }}
    <input type="hidden" name="appointment_book_id" value="{{ $appt->id }}">
    <input type="hidden" name="basic_form" value="1">
    <div class="modal-header">
        <h5 class="modal-title">Appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-xl-12">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="when" class="form-label required">When?</label>
                        <div class="input-group" id="datepicker1">
                            <input type="text" class="form-control" name="activity_date" placeholder="y-m-d"
                                   value="{{ $date ?? '' }}"
                                   data-date-format="yyyy-m-d" data-date-container='#datepicker1'
                                   data-provide="datepicker">
                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Time Start</label>
                        <div class="input-group" id="timepicker-input-group1">
                            <input id="timepicker" type="text" name="time_start[]" class="form-control"
                                   value="{{ $start ?? '' }}"
                                   data-provide="timepicker">
                                   <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label for="when" class="form-label required">Which Branch?</label>
                        <select class="form-control select2" name="branch_id">
                            <option value="">Select</option>
                            @foreach(\App\Models\Branch::all() as $branch)
                                <option value="{{ $branch->id ?? '' }}">{{ $branch->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="when" class="form-label required">Which Client?</label>
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".addNewClientModal">
                                <i class="fa fa-plus mr-5"></i> <span class="addNewClient"> Add New Client</span>
                            </a>
                        </div>

                        <select id="select_client_drop_down" name="client_id" class="form-control select2">
                            <option value="">Select</option>
                            @foreach(\App\Models\Client::all() as $loopVariable)
                                <option value="{{ $loopVariable->id ?? '' }}">{{ $loopVariable->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label for="when" class="form-label required">What Services?</label>
                        <select id="select_service_drop_down" name="services[]" class="form-control select2" multiple>
                            <option>Select</option>
                            @foreach(\App\Models\Service::all() as $loopVariable)
                                <option value="{{ $loopVariable->id ?? '' }}">{{ $loopVariable->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label for="when" class="form-label required">Appointment Type?</label>
                        <select id="" name="appointment_id" class="form-select">
                         @foreach(getAppointmentType() as $type)
                           <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="btn btn-primary primary-alt" onclick="openScheduleDetailPopup('{{ $appt->id }}','{{ $start ?? '' }}','{{ $end ?? '' }}')">Appt. Details</div>
        <div class="btn btn-primary" data-bs-dismiss="modal">Schedule</div>
    </div>
</form>
  <!--  Add New Client Modal Starts Here -->
                                            <div class="modal fade addNewClientModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="">Extra large modal</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Cras mattis consectetur purus sit amet fermentum.
                                                                Cras justo odio, dapibus ac facilisis in,
                                                                egestas eget quam. Morbi leo risus, porta ac
                                                                consectetur ac, vestibulum at eros.</p>
                                                            <p>Praesent commodo cursus magna, vel scelerisque
                                                                nisl consectetur et. Vivamus sagittis lacus vel
                                                                augue laoreet rutrum faucibus dolor auctor.</p>
                                                            <p class="mb-0">Aenean lacinia bibendum nulla sed consectetur.
                                                                Praesent commodo cursus magna, vel scelerisque
                                                                nisl consectetur et. Donec sed odio dui. Donec
                                                                ullamcorper nulla non metus auctor
                                                                fringilla.</p>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            <!-- Add New Client Modal Ends Here -->
@include('appointment_book.form_script')
