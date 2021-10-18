
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
                    <div class="d-flex">
                        <div>
                            <button class="btn btn-outline-warning waves-effect waves-light">Today</button>
                        </div>
                        <div>
                            
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
                                                        <ul class="list-unstyled mb-0">
                                                            <li>
                                                               <a href="#"> Services </a>
                                                            </li>
                                                            <li>
                                                                <a href="#"> Appointment Types </a>
                                                            </li>
                                                        </ul>
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
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
