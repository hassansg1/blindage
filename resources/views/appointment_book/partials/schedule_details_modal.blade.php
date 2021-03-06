<form action="" id="appointment_form" name="appointment_form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="appointment_book_id" id="appointment_book_id" value="{{ $appt->id }}">
    <input type="hidden" id="start_for_service" value="{{ $start ?? '' }}">
    <input type="hidden" id="end_for_service" value="{{ $end ?? '' }}">
    <input type="hidden" id="duration_for_service" value="{{ $duration ?? '' }}">
    <div class="modal-header">
        <h5 class="modal-title">Appointment</h5>
        <div class="actionBtn">
            <select class="form-select mb-2 actionSelectOption" onchange="appointmentStatusUpdate('{{ $appt->id??'' }}',this.value)">
                  <option selected="" value="">Action</option>
                  @if($appt->status_flag == App\Models\AppointmentBook::CHECKIN)
                  <option @if(App\Models\AppointmentBook::CHECKOUT == $appt->status_flag) selected @endif value="{{ App\Models\AppointmentBook::CHECKOUT }}">Checkout</option>
                  @endif
                  <option @if(App\Models\AppointmentBook::CANCELED == $appt->status_flag) selected @endif value="{{ App\Models\AppointmentBook::CANCELED }}">Cancel Appointment</option>
                  <option @if(App\Models\AppointmentBook::VOIDED == $appt->status_flag) selected @endif value="{{ App\Models\AppointmentBook::VOIDED }}">Void Appointment</option>
            </select>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
    </div>
    <div class="modal-body">

        <div class="client-summary-wrapper mb-3">
            <div class="client-summary-info">
                <div class="client-pic-wrapper">
                    <div class="client-pic">
                        {{-- AY --}}
                        {{ isset($appt->client->first_name)?ucwords(substr($appt->client->first_name,0,1)):''}} {{ isset($appt->client->last_name)?ucwords(substr($appt->client->last_name,0,1)):''}}
                    </div>
                </div>
                <div class="client-info-detail">
                    <div class="client-name">
                        <h4>{{ isset($appt->client->first_name)&& $appt->client->first_name!=null? ucfirst($appt->client->first_name):'' }} {{ isset($appt->client->last_name)&& $appt->client->last_name!=null?ucfirst($appt->client->last_name):'' }}</h4>
                    </div>
                    <div class="mb-2 icon-wrapper">
                        <i class="fas fa-phone-alt icon"></i>
                        <input class="form-control" type="number" id="mobile_no" name="mobile_no" value="{{ isset($appt->client->mobile_no) && $appt->client->mobile_no!=null?$appt->client->mobile_no:'' }}" placeholder="Phone Number" autocomplete="nope">
                    </div>
                    <div class="icon-wrapper">
                        <i class="fas fa-envelope icon"></i>
                        <input class="form-control" type="email" name="clientEmail" id="clientEmail" value="{{ isset($appt->client->email) && $appt->client->email!=null?$appt->client->email:'' }}" placeholder="E-mail" autocomplete="nope">
                    </div>
                </div>
            </div>
            <div class="client-summary-balance">
                <div class="mb-2">
                    <span>Loyalty Points:</span> <b>0 Points</b>
                </div>
                <div>
                    <span>Balance:</span> <b>$0.00 Credit</b>
                </div>

                <div>
                    <label>Confirmation Type : </label>
                    <select class="form-select mb-2 actionSelectOption" onchange="appointmentComfirmationStatusUpdate('{{ $appt->id??'' }}',this.value)">
                        <option selected="" value="">None</option>

                        <option @if(App\Models\AppointmentBook::PHONE_DIRECT == $appt->confirmation_status_flag) selected @endif value="{{ App\Models\AppointmentBook::PHONE_DIRECT }}">Phone (Direct)</option>
                        <option @if(App\Models\AppointmentBook::PHONE_ANSWER_MACHINE == $appt->confirmation_status_flag) selected @endif value="{{ App\Models\AppointmentBook::PHONE_ANSWER_MACHINE }}">Phone (Answer Machine)</option>

                        <option @if(App\Models\AppointmentBook::IN_PERSON == $appt->confirmation_status_flag) selected @endif value="{{ App\Models\AppointmentBook::IN_PERSON }}">In Person</option>
                        <option @if(App\Models\AppointmentBook::EMAIL == $appt->confirmation_status_flag) selected @endif value="{{ App\Models\AppointmentBook::EMAIL }}">E-mail</option>
                    </select>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label for="when" class="form-label required">Appointment Type :</label>
                        <select id="appointment_type_id" name="appointment_type_id" class="form-select">
                            @foreach(getAppointmentType() as $type)
                                <option {{ isset($appt->appointment_type_id)&& $appt->appointment_type_id !=null && $appt->appointment_type_id==$type->id ?'Selected':'' }} value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-expansion-tab-content">
            <div class="accordion" id="accordionExample">
                <div class="inline-collapse-btn">
                        <button class="btn btn-primary accordion-button btn-rounded" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Notes
                        </button>
                        <button class="collapsed btn btn-primary accordion-button btn-rounded" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Upcoming Appointments
                        </button>
                        <button class="collapsed btn btn-primary accordion-button btn-rounded" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                         Recent Visits
                        </button>
                    <button class="collapsed btn btn-primary accordion-button btn-rounded" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                            aria-controls="collapseFour">
                        Photos
                    </button>
                </div>
                <div class="mt-10 mb-20">
                    <div class="accordion-item">
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div>
                                    <h4>Client Notes</h4>
                                        <div class="row" id="clientCommentData">
                                                @forelse($appt->appointmentBookNotes as $note)

                                                        <div class="col-lg-4 deleteRowClientNote">
                                                            <div class="card border border-success">
                                                                <div class="card-header bg-transparent border-success d-flex justify-content-between">
                                                                    <h5 class="my-0 text-success"><i class="mdi mdi-check-all me-3"></i>Note:</h5>
                                                                    <a href="javascript:void(0)" class="removeClientNote" data-note_id="{{ $note->id }}"><i class="fas fa-trash text-red"></i></a>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text">{{$note->notes_content ?? ''}}</p>
                                                                </div>
                                                            </div>
                                                        </div>


                                                @empty
                                                {{-- No data found --}}
                                                @endforelse
                                            </div>

                                   
                                    {{--                                    <form action="" method="">--}}
                                    <div class="row">
                                        <div class="col-md-10">
                                            <textarea name="clientNotes" id="clientNotes"
                                                      placeholder="Enter New Note..." class="form-control"></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="d-grid gap-2">
                                                {{--                                                    <button class="btn btn-primary btn-block comment-save-btn">Save</button>--}}
                                            </div>
                                        </div>
                                        </div>
{{--                                    </form>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="Upcoming Appointments">
                                    <h4>Upcomming Appointments</h4>
                                     <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Start Time</th>
                                                <th>Description</th>
                                                <th>Employee</th>
                                                <th>Qty</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($data_upcomming))
                                                @foreach($data_upcomming as $loop_variable)
                                                <tr>
                                                    <td>
                                                        {{ date('l, M d, Y',strtotime($loop_variable->activity_date)) }}
                                                    </td>
                                                    <td>
                                                        @forelse($loop_variable->appointments as $loop_var)
                                                            <div>{{ isset($loop_var->start_time)? date('h:i A',strtotime($loop_var->start_time)) :'' }}</div>
                                                        @empty   
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @forelse($loop_variable->appointments as $loop_var)
                                                            <div>{{ isset($loop_var->service)?$loop_var->service->name:'' }} (Regular Service) </div>
                                                            <div>Duration : {{ isset($loop_var->service)?$loop_var->service->minutes:'' }} Min.</div>
                                                        @empty   
                                                        @endforelse
                                                        @forelse($loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class) as $app_book_items)
                                                            @foreach($app_book_items->serviceitemable->service_items() as $loop_var)
                                                                <div>{{ $loop_var->packageitemable->name }} (Package Service) </div>
                                                                <div>{{ $loop_var->packageitemable->minutes }} Min.</div>
                                                            @endforeach
                                                        @empty   
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @forelse($loop_variable->appointments as $loop_var)
                                                            @if(isset($loop_var->employee_type_id) && $loop_var->employee_type_id !=null)
                                                        
                                                             <span>{{ $loop_var->employee->getFirstAndLastName() }}</span>
                                                            
                                                            @endif
                                                        @empty

                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @forelse($loop_variable->appointments as $loop_var)
                                                            <div>{{ isset($loop_var->quantity)?$loop_var->quantity:'' }}</div>
                                                        @empty   
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        {{ ($loop_variable->appointments->sum('price')) +  $loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class)->sum('price') }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="6">
                                                    No Record Found
                                                </td>
                                            </tr>
                                            @endif
                                            
     
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="text-muted">
                                   <h4>Recent Visits</h4>
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Start Time</th>
                                                <th>Description</th>
                                                <th>Employee</th>
                                                <th>Qty</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($data_previous))
                                                @foreach($data_previous as $loop_variable)
                                                <tr>
                                                    <td>
                                                        {{ date('l, M d, Y',strtotime($loop_variable->activity_date)) }}
                                                    </td>
                                                    <td>
                                                        @forelse($loop_variable->appointments as $loop_var)
                                                            <div>{{ isset($loop_var->start_time)? date('h:i A',strtotime($loop_var->start_time)) :'' }}</div>
                                                        @empty   
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @forelse($loop_variable->appointments as $loop_var)
                                                            <div>{{ isset($loop_var->service)?$loop_var->service->name:'' }} (Regular Service) </div>
                                                            <div>Duration : {{ isset($loop_var->service)?$loop_var->service->minutes:'' }} Min.</div>
                                                        @empty   
                                                        @endforelse
                                                        @forelse($loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class) as $app_book_items)
                                                            @foreach($app_book_items->serviceitemable->service_items() as $loop_var)
                                                                <div>{{ $loop_var->packageitemable->name }} (Package Service) </div>
                                                                <div>{{ $loop_var->packageitemable->minutes }} Min.</div>
                                                            @endforeach
                                                        @empty   
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @forelse($loop_variable->appointments as $loop_var)
                                                            @if(isset($loop_var->employee_type_id) && $loop_var->employee_type_id !=null)
                                                        
                                                             <span>{{ $loop_var->employee->getFirstAndLastName() }}</span>
                                                            
                                                            @endif
                                                        @empty

                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @forelse($loop_variable->appointments as $loop_var)
                                                            <div>{{ isset($loop_var->quantity)?$loop_var->quantity:'' }}</div>
                                                        @empty   
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        {{ ($loop_variable->appointments->sum('price')) +  $loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class)->sum('price') }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="6">
                                                    No Record Found
                                                </td>
                                            </tr>
                                            @endif
                                            
     
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div>
{{--                                    <form action="{{url('store/file/compliance')}}" method="post" class="dropzone" id="file_upload_form" enctype="multipart/form-data">--}}
{{--                                        <input type="hidden" name="compliance_data_id" value="1">--}}
                                        <div  class="fallback">
                                            <input name="clientImage" type="file" id="clientImage">
                                            {!! getAppointementImages($appt->id) !!}
                                            <div id="imageRecordCall" >
                                            </div>
{{--                                            <div class="dz-message needsclick">--}}
{{--                                                <div class="mb-3">--}}
{{--                                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>--}}
{{--                                                </div>--}}

{{--                                                <h4>Drop files here or click to upload.</h4>--}}
{{--                                            </div>--}}
                                        </div>
{{--                                    </form>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end accordion -->
        </div>

        <div class="row mb-3">
            <div class="col-xl-6">
                <label for="when" class="form-label required">Which Client?</label>
                <select id="select_client_drop_down" name="client_id" class="form-control select2 schedule_details_modal_submit">
                    <option value="">Select</option>
                    @foreach(\App\Models\Client::all() as $loopVariable)
                        <option value="{{ $loopVariable->id ?? '' }}" {{ isset($appt->client_id) && $appt->client_id==$loopVariable->id ?'selected':''  }}>{{ $loopVariable->name ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-6">
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


        <div class="row mb-3">
            <div class="col-lg-4">
                <label class="form-label required">Service</label>
                <select class="form-control services_items_dropdown" name="services_items_dropdown">
                     <option>-- Select Service -- </option>
                    @foreach(\App\Models\Service::all() as $service_loopVariable)
                    <option  value="{{ 'Service??'.$service_loopVariable->id ?? '' }}" >{{ $service_loopVariable->name ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4">
                <label class="form-label required">Product</label>
                <select class="form-control services_items_dropdown" name="services_items_dropdown">
                    <option>-- Select Product -- </option>
                    @foreach(\App\Models\Product::all() as $product_loopVariable)
                    <option value="{{ 'Product??'.$product_loopVariable->id ?? '' }}" >{{ $product_loopVariable->name ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4">
                <label class="form-label required">Package</label>
                <select class="form-control services_items_dropdown" name="services_items_dropdown">
                    <option>-- Select Package -- </option>
                    @foreach(\App\Models\Package::where('active','1')->get() as $package_loopVariable)
                    <option value="{{ 'Package??'.$package_loopVariable->id ?? '' }}" >{{ $package_loopVariable->name ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="mb-3">
                <select class="form-control select2 services_items_dropdown" name="services_items_dropdown">
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
            </div> --}}

        </div>
        <div class="row">
            <div class="col-lg-12">
                {{-- <div id="services_items_append_div"></div> --}}
                <div id="services_items_append_div">
                    <h3 class="heading-style">
                        Services:
                    </h3>
                    @forelse($appt->appointments as $appt_loopVariable)
                        @if(isset($appt_loopVariable->service_id) && $appt_loopVariable->service_id!=null)
                            <div class="deleteRow">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">
                                            <a href="#" onclick="deleteRow()">{{ $appt_loopVariable->service->name ?? '' }}
                                                <i class="fas fa-times pull-right close-btn"></i>
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
                                                        <option value="{{ $loopVariable->id ?? '' }}" {{ $loopVariable->id == $appt_loopVariable->employee_type_id ? 'SELECTED':'' }}>{{ $loopVariable->first_name ?? '' }} {{ $loopVariable->last_name ?? '' }}</option>
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
                        @endif
                    @empty
                        Empty Bucket !
                    @endforelse
                </div>
                <div id="products_items_append_div">
                    <h3 class="heading-style">
                        Products:
                    </h3>
                    @forelse( $appt->appointmentBookItems->where('serviceitemable_type','=',App\Models\Product::class) as $appt_loopVariable)
                        <div class="deleteRow">
                            <div class="card">
                                <h5 class="card-title card-heading">
                                    <a href="#" onclick="deleteRow()">{{ $appt_loopVariable->serviceitemable->name ?? '' }} <i class="fas fa-times float-end close-btn"></i>
                                    </a>

                                  </h5>
                                <div class="card-body">
                                    <input type="hidden" name="products[]" value="{{  $appt_loopVariable->serviceitemable_id }}">
                                    <div class="row">
                                        {{-- <div class="col-lg-6">
                                            <label for="when" class="form-label required">Employee Type</label>
                                            <select id="select_client_drop_down" name="employee_type_id[products][{{  $appt_loopVariable->serviceitemable_id }}]" class="form-control select2 schedule_details_modal_submit">
                                                <option value="">Select</option>
                                                @foreach(\App\Models\Employee::all() as $loopVariable)
                                                    <option value="{{ $loopVariable->id ?? '' }}" >{{ $loopVariable->first_name ?? '' }} {{ $loopVariable->last_name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <div class="col-lg-3">
                                            <label for="when" class="form-label required">Quantity</label>
                                            <input class="form-control schedule_details_modal_submit" name="quantity[products][{{  $appt_loopVariable->serviceitemable_id }}]" value="1" type="text" placeholder="Quantity">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="when" class="form-label required">Price</label>
                                            <input class="form-control schedule_details_modal_submit" name="price[products][{{  $appt_loopVariable->serviceitemable_id }}]" value="{{  $appt_loopVariable->serviceitemable->retail_price }}" type="text" placeholder="Price">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div id="packages_items_append_div">
                    <h3 class="heading-style">
                        Packages:
                    </h3>
                    @forelse( $appt->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class) as $appt_loopVariable)
                    <div class="deleteRow">
                         <div class="card">
                            <h5 class="card-title mb-0 card-heading">
                                <a href="#" onclick="deleteRow()">{{ $appt_loopVariable->serviceitemable->name ?? '' }} @if(isset($getData->category) && $getData->category!=null) <b>( {{ $appt_loopVariable->serviceitemable->categoryData->name }} ) </b> @endif <i class="fas fa-times float-end close-btn"></i>
                                </a>
                            </h5>
                            <div class="card-body">
                                <input type="hidden" name="packages[]" value="{{ $appt_loopVariable->serviceitemable_id }}">
                                <div class="row">
                                    {{-- <div class="col-lg-6">
                                        <label for="when" class="form-label required">Employee Type</label>
                                        <select id="select_client_drop_down" name="employee_type_id[packages][{{ $appt_loopVariable->serviceitemable_id }}]" class="form-control select2 schedule_details_modal_submit">
                                            <option value="">Select</option>
                                            @foreach(\App\Models\Employee::all() as $loopVariable)
                                                <option value="{{ $loopVariable->id ?? '' }}" >{{ $loopVariable->first_name ?? '' }} {{ $loopVariable->last_name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="col-lg-3">
                                        <label for="when" class="form-label required">Quantity</label>
                                        <input class="form-control schedule_details_modal_submit" name="quantity[packages][{{ $appt_loopVariable->serviceitemable_id }}]" value="{{ $appt_loopVariable->quantity }}" type="text" placeholder="Quantity">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="when" class="form-label required">Price</label>
                                        <input class="form-control schedule_details_modal_submit" name="price[packages][{{ $appt_loopVariable->serviceitemable_id }}]" value="{{ $appt_loopVariable->price }}" type="text" placeholder="Price">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <h3 class="heading-style">
                                        Services:
                                        </h3>
                                        <table class="table mb-0 table-hover table-striped">
                                          <tbody>
                                            @forelse($appt_loopVariable->serviceitemable->service_items() as $loopVariable)
                                            <tr>
                                              <th width="15%">{{ $loopVariable->quantity }}</th>
                                              <th width="15%">x </th>
                                              <td>{{ $loopVariable->packageitemable->name }}</td>
                                            </tr>
                                            @empty

                                            @endforelse

                                          </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <h3 class="heading-style">
                                        Products:
                                        </h3>
                                        <table class="table  mb-0 table-hover table-striped">
                                          <tbody>
                                            @forelse($appt_loopVariable->serviceitemable->product_items() as $loopVariable)
                                            <tr>
                                              <th width="15%">{{ $loopVariable->quantity }}</th>
                                              <th width="15%">x </th>
                                              <td>{{ $loopVariable->packageitemable->name }}</td>
                                            </tr>
                                            @empty

                                            @endforelse


                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                             <!-- end card body -->
                         </div>
                    </div>

                    @empty
                    @endforelse

                </div>


                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="mb-3">
                                <label for="when" class="form-label required">Notes</label>
                                <div class="input-group" id="datepicker1">
                                    <input type="text" class="form-control schedule_details_modal_submit" name="notes"
                                           placeholder="Notes"
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
