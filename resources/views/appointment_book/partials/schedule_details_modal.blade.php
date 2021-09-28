<form action="" id="appointment_form" name="appointment_form">
    {{ csrf_field() }}
    <input type="hidden" name="appointment_book_id" value="{{ $appt->id }}">
    <div class="modal-header">
        <h5 class="modal-title">Appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="mb-3">
                        <label for="when" class="form-label required">Which Client?</label>
                        <select id="select_client_drop_down" name="client_id" class="form-control select2">
                            <option value="">Select</option>
                            @foreach(\App\Models\Client::all() as $loopVariable)
                                <option value="{{ $loopVariable->id ?? '' }}" {{ isset($appt->client_id) && $appt->client_id==$loopVariable->id ?'selected':''  }}>{{ $loopVariable->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="mb-3">
                        <label for="when" class="form-label required">When?</label>
                        <div class="input-group" id="datepicker1">
                            <input type="text" class="form-control" name="activity_date" placeholder="y-m-d"
                                   value="{{ $appt->activity_date ?? '' }}"
                                   data-date-format="yyyy-m-d" data-date-container='#datepicker1'
                                   data-provide="datepicker">

                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="card-title mb-4">Services</h3>
        <div class="row">
            <div class="col-lg-12">
                @forelse($appt->appointments as $appt_loopVariable)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ $appt_loopVariable->service->name ?? '' }}</h5>

                         <div class="row mb-3">
                            <div class="col-lg-6">
                                <label
                                        class="form-label">Time Start </label>
                                <div class="input-group" id="timepicker-input-group1">
                                    <input id="timepicker" type="text" name="time_start[{{ $appt->id }}]" class="form-control"
                                           value="{{ $appt_loopVariable->start_time ?? '' }}"
                                           data-provide="timepicker">

                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label
                                        class="form-label">Time Duration </label>
                                <div class="input-group" id="timepicker-input-group1">
                                    <input type="text" name="time_start[{{ $appt->id }}]" class="form-control" value="{{ $appt_loopVariable->duration ?? '' }}">

                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <label for="when" class="form-label required">Which Branch?</label>
                                <select class="form-control select2" name="branch_id[{{ $appt->id }}]">
                                    <option value="">Select</option>
                                    @foreach(\App\Models\Branch::all() as $branch)
                                        <option value="{{ $branch->id ?? '' }}" {{ isset($appt->branch_id) && $branch->id==$appt->branch_id?'selected':'' }}>{{ $branch->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="when" class="form-label required">Which Client?</label>
                                <select id="select_client_drop_down" name="client_id[{{ $appt->id }}]" class="form-control select2">
                                    <option value="">Select</option>
                                    @foreach(\App\Models\Client::all() as $loopVariable)
                                        <option value="{{ $loopVariable->id ?? '' }}" {{ isset($appt->client_id) && $loopVariable->id==$appt->client_id?'selected':'' }}>{{ $loopVariable->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                        

                        <div class="row">
                            <div class="mb-3">
                                <label for="when" class="form-label required">Quantity</label>
                                <input class="form-control" name="quantity[{{ $appt->id }}]" value="{{ $appt_loopVariable->quantity ?? '' }}" type="text" placeholder="Quantity">
                            </div>
                        </div>
                         <div class="row">
                            <div class="mb-3">
                                <label for="when" class="form-label required">Price</label>
                                <input class="form-control" name="price[{{ $appt->id }}]" value="{{ $appt_loopVariable->price }}" type="text" placeholder="Price">
                            </div>
                        </div>

                    </div>
                    <!-- end card body -->
                </div>

                @empty
                    No Record Found
                @endforelse

                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="mb-3">
                                <label for="when" class="form-label required">Notes</label>
                                <div class="input-group" id="datepicker1">
                                    <input type="text" class="form-control" name="notes" placeholder="Notes"
                                           value="{{ $appt->notes ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>
    <div class="modal-footer">
        <div class="btn btn-primary primary-alt" onclick="openScheduleDetailPopup('{{ $appt->id }}')">Appt. Details
        </div>
        <div class="btn btn-primary" data-bs-dismiss="modal">Schedule</div>
    </div>
</form>
@include('appointment_book.form_script')