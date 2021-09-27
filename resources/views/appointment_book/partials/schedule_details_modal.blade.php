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
                                <option value="{{ $loopVariable->id ?? '' }}">{{ $loopVariable->name ?? '' }}</option>
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
                                   value="{{ $date ?? '' }}"
                                   data-date-format="yyyy-m-d" data-date-container='#datepicker1'
                                   data-provide="datepicker">

                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="btn btn-primary primary-alt" onclick="openScheduleDetailPopup('{{ $appt->id }}')">Appt. Details
        </div>
        <div class="btn btn-primary" data-bs-dismiss="modal">Schedule</div>
    </div>
</form>
@include('appointment_book.form_script')