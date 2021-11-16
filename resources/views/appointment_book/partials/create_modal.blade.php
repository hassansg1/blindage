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
                                   data-provide="datepicker" readonly>
                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Time Start</label>
                        <div class="input-group" id="timepicker-input-group1">
                            <input id="text" type="text" name="time_start[]" class="form-control"
                                   value="{{ $start ?? '' }}"
                                    readonly>
                                   <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label for="when" class="form-label required">Which Branch?</label>
                        <select class="form-control select2" name="branch_id" id="select_branch_drop_down">
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
                            <a class="addNewClient" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".addNewClientModal">
                                <i class="fa fa-plus mr-5"></i> <span> Add New Client</span>
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
                        <select id="appointment_type_id" name="appointment_type_id" class="form-select">
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

@include('appointment_book.form_script')
