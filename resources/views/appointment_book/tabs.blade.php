
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
                            <button class="btn btn-outline-warning waves-effect waves-light">Today</button>
                        </div>
                        <div class="d-flex">
                            <div>
                                <select class="form-control">
                                    <option>1</option>
                                </select>
                            </div>
                            <div>
                                <select class="form-control">
                                    <option>Time Block </option>
                                    <option>Closed</option>
                                    <option>No Show </option>
                                    <option>Canceled </option>
                                    <option>Voided </option>
                                </select>
                            </div>
                        </div>
                    </div>
                       <div class="custom_table_div">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                <thead class="table-light custom_table_head">
                                <tr>
                                    <th class="">ID</th>
                                    <th>
                                        Status
                                    </th>
                                    <th>Client Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Services</th>
                                    <th>Employee</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody id="table_content_div_body">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
                                                           <div class="input-search col-md-5">
                                                                <div class="mb-2 icon-wrapper">
                                                                   <i class="fa fa-search icon"></i> 
                                                                   <input class="form-control" type="text" name="" placeholder="Search Services /  Category">
                                                                </div>
                                                           </div>
                                                           <table class="table">
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Color</th>
                                                                    <th></th>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                        <div>
                                                                            <label class="form-label">Simple input field</label>
                                                                            <input type="text" class="form-control" id="colorpicker-default" value="#50a5f1">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                               
                                                           </table>
                                                       </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="v-pills-appointment" role="tabpanel" aria-labelledby="v-pills-appointment-tab">
                                                       <h3>Service Color Codes</h3>
                                                       <p>Change the appointment block colors for services and categories.</p>
                                                       <div class="services-search-wrapper">
                                                           <div class="input-search col-md-5">
                                                                <div class="mb-2 icon-wrapper">
                                                                   <i class="fa fa-search icon"></i> 
                                                                   <input class="form-control" type="text" name="" placeholder="Search Services /  Category">
                                                                </div>
                                                           </div>
                                                           <table class="table">
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Color</th>
                                                                    <th></th>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                        <div class="mb-3">
                                                                            <label for="colorpicker-togglepaletteonly" class="form-label">Appt. Color</label>
                                                                            <input type="text" class="form-control spectrum with-add-on" name="color"
                                                                                   id="colorpicker-togglepaletteonly"
                                                                                   value="{{ isset($item) ? $item->color:old('color') ?? ''  }}">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                               
                                                           </table>
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
</div>
