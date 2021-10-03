<form action="" id="appointment_form" name="appointment_form">
    {{ csrf_field() }}
    <input type="hidden" name="appointment_book_id" value="{{ $appt->id }}">
    <input type="hidden" id="start_for_service" value="{{ $start ?? '' }}">
    <input type="hidden" id="end_for_service" value="{{ $end ?? '' }}">
    <input type="hidden" id="duration_for_service" value="{{ $duration ?? '' }}">
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
                        <select id="select_client_drop_down" name="client_id" class="form-control select2 schedule_details_modal_submit">
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
                            <input type="text" class="form-control schedule_details_modal_submit" name="activity_date" placeholder="y-m-d"
                                   value="{{ $appt->activity_date ?? '' }}"
                                   data-date-format="yyyy-m-d" data-date-container='#datepicker1'
                                   data-provide="datepicker" >

                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="when" class="form-label required">Which Branch?</label>
                <select class="form-control select2 schedule_details_modal_submit" name="branch_id">
                    <option value="">Select</option>
                    @foreach(\App\Models\Branch::all() as $branch)
                        <option value="{{ $branch->id ?? '' }}" {{ isset($appt->branch_id) && $branch->id==$appt->branch_id?'selected':'' }}>{{ $branch->name ?? '' }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <h3 class="card-title mb-4">Services</h3>
        <div class="row">
            <div class="mb-3">
                <select class="form-control select2 services_items_dropdown" name="services_items_dropdown" id="services_items_dropdown">
                    <option value="">Select</option>
                    <optgroup label="Service">
                        @foreach(\App\Models\Service::all() as $service_loopVariable)
                        <option  value="{{ 'Service??'.$service_loopVariable->id ?? '' }}" >{{ $service_loopVariable->name ?? '' }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Product">
                        @foreach(\App\Models\Product::all() as $product_loopVariable)
                        <option value="{{ 'Product??'.$product_loopVariable->id ?? '' }}" >{{ $product_loopVariable->name ?? '' }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Package">
                        @foreach(\App\Models\Package::all() as $package_loopVariable)
                        <option value="{{ 'Package??'.$package_loopVariable->id ?? '' }}" >{{ $package_loopVariable->name ?? '' }}</option>
                        @endforeach
                    </optgroup>
                    
                </select>
            </div>
           
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="services_items_append_div"></div>
                @forelse($appt->appointments as $appt_loopVariable)
                <div class="deleteRow">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <a href="#" onclick="deleteRow()">{{ $appt_loopVariable->service->name ?? '' }} <i class="fas fa-window-close"></i>
                                </a>
                            </h5>
                            <input type="hidden" name="services[]" value="{{ $appt_loopVariable->service_id }}">
                             <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label
                                            class="form-label">Time Start </label>
                                    <div class="input-group" id="timepicker-input-group1">
                                        <input id="timepicker" type="text" name="time_start[{{ $appt_loopVariable->service_id }}]" class="form-control schedule_details_modal_submit"
                                               value="{{ $appt_loopVariable->start_time ?? '' }}"
                                               data-provide="timepicker">

                                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-label">Time Duration </label>
                                    <div class="input-group" id="timepicker-input-group1">
                                        <input type="text" name="minutes[{{ $appt_loopVariable->service_id }}]" class="form-control schedule_details_modal_submit" value="{{ $appt_loopVariable->duration ?? '' }}">

                                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3">
                                    <label for="when" class="form-label required">Employee Type</label>
                                    <select id="select_client_drop_down" name="employee_type_id[{{ $appt_loopVariable->service_id }}]" class="form-control select2 schedule_details_modal_submit">
                                        <option value="">Select</option>
                                        @foreach(\App\Models\Employee::all() as $loopVariable)
                                            <option value="{{ $loopVariable->id ?? '' }}">{{ $loopVariable->first_name ?? '' }} {{ $loopVariable->last_name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                        

                            <div class="row">
                                <div class="mb-3">
                                    <label for="when" class="form-label required">Quantity</label>
                                    <input class="form-control schedule_details_modal_submit" name="quantity[{{ $appt_loopVariable->service_id }}]" value="{{ $appt_loopVariable->quantity ?? '' }}" type="text" placeholder="Quantity">
                                </div>
                            </div>
                             <div class="row">
                                <div class="mb-3">
                                    <label for="when" class="form-label required">Price</label>
                                    <input class="form-control schedule_details_modal_submit" name="price[{{ $appt_loopVariable->service_id }}]" value="{{ $appt_loopVariable->price }}" type="text" placeholder="Price">
                                </div>
                            </div>

                        </div>
                        <!-- end card body -->
                    </div>
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
                                    <input type="text" class="form-control schedule_details_modal_submit" name="notes" placeholder="Notes"
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