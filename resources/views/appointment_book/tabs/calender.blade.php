<div class="main-schedule-wrapper">
    <div class="row">
        <div class="col-lg-2 pr-0 custom-width">
            <div class="left-side-bar-wrapper pb-2">
                <label class="p-2">Calender</label>
                <div data-provide="datepicker-inline" class="bootstrap-datepicker-inline"></div>
                <div class="card no-border m-2">
                    <div class="">
                        <div class="row">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                            Waitlist(0)
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                        <div class="accordion-body text-muted">
                                            Nothing here
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
                        <div class="modal fade newScheduleModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Appointment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action=" method">
                                            <div class="row">
                                                <div class="input-search col-md-5">
                                                    <h4>Select Client</h4>
                                                    <div class="mb-2 icon-wrapper">
                                                        <i class="fa fa-search icon"></i>
                                                        <input class="form-control" type="text" name="" placeholder="Search for an existing client or add a new client..." />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-flex justify-content-between">
                                                        <a class="addNewClient" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".addNewClientModal"> <i class="fa fa-plus mr-5"></i> <span> Add New Client</span> </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <div class="input-group" id="datepicker2">
                                                            <input type="text" class="form-control" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-date-container="#datepicker2" data-provide="datepicker" />
                                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                        <!-- input-group -->
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check form-check-warning mb-3 checkbox_styling">
                                                        <input class="form-check-input" type="checkbox" id="reapeat_checkbox" />
                                                        <label class="form-check-label" for="reapeat_checkbox">
                                                            Recurring
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center gap-3 justify-content-end">
                                                        <div>
                                                            Appointment Type
                                                        </div>
                                                        <div>
                                                            <select class="form-select" name="">
                                                                <option value="">None</option>
                                                                <option value="">Request</option>
                                                                <option value="">Transient</option>
                                                                <option value="">New</option>
                                                                <option value="">New Request</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Recurring Box Section Start-->
                                            {{--
                                            <div class="recurringBoxWrapper">
                                                <div class="weeks_data" id="weeks_data">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="repeat_every_data mb-3">
                                                                <div class="repeat_text">Repeat every</div>
                                                                <div>
                                                                    <input type="number" name="" class="form-control" value="1" />
                                                                </div>
                                                                <select class="form-select" id="">
                                                                    <option selected="">Week</option>
                                                                    <option value="1">Month</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="repeat_on_data mb-3">
                                                                <div class="repeat_on_text">Repeat on</div>
                                                                <div class="week_wrapper">
                                                                    <ul class="mb-0">
                                                                        <li><button>S</button></li>
                                                                        <li><button>M</button></li>
                                                                        <li><button>T</button></li>
                                                                        <li><button>W</button></li>
                                                                        <li><button>T</button></li>
                                                                        <li><button>F</button></li>
                                                                        <li><button>S</button></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="end_date_calender d-flex mb-3 align-items-center">
                                                                <div class="repeat_on_text" style="width: 156px;">Repeat End Date</div>
                                                                <div class="input-group" id="datepicker1">
                                                                    <input type="text" class="form-control" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-date-container="#datepicker1" data-provide="datepicker" />
                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                </div>
                                                                <!-- input-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            --}}
                                            <!--Recurring Box Section End-->
                                            <div class="row mb-3">
                                                <div class="col-lg-4">
                                                    <label class="form-label required">Service sdsfd</label>
                                                    <select class="form-control services_items_dropdown" name="services_items_dropdown">
                                                        <option>-- Select Service -- </option>
                                                        @foreach(\App\Models\Service::all() as $service_loopVariable)
                                                        <option value="{{ 'Service??'.$service_loopVariable->id ?? '' }}">{{ $service_loopVariable->name ?? '' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label required">Product</label>
                                                    <select class="form-control services_items_dropdown" name="services_items_dropdown">
                                                        <option>-- Select Product -- </option>
                                                        @foreach(\App\Models\Product::all() as $product_loopVariable)
                                                        <option value="{{ 'Product??'.$product_loopVariable->id ?? '' }}">{{ $product_loopVariable->name ?? '' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label required">Package</label>
                                                    <select class="form-control services_items_dropdown" name="services_items_dropdown">
                                                        <option>-- Select Package -- </option>
                                                        @foreach(\App\Models\Package::where('active','1')->get() as $package_loopVariable)
                                                        <option value="{{ 'Package??'.$package_loopVariable->id ?? '' }}">{{ $package_loopVariable->name ?? '' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    {{--
                                                    <div id="services_items_append_div"></div>
                                                    --}}
                                                    <div id="services_items_append_div">
                                                        <h3 class="heading-style">
                                                            Services:
                                                        </h3>
                                                    </div>
                                                    <div id="products_items_append_div">
                                                        <h3 class="heading-style">
                                                            Products:
                                                        </h3>
                                                    </div>
                                                    <div id="packages_items_append_div">
                                                        <h3 class="heading-style">
                                                            Packages:
                                                        </h3>
                                                    </div>

                                                    <!-- end card -->
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <hr />

                                            <!--Appointment Notes Section Start-->
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h4>Appointment Notes <i></i></h4>
                                                    <textarea placeholder="Enter Appointment notes..." class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <!--Appointment Notes Section End-->
                                            <div class="text-left">
                                                <button class="btn btn-primary">Schedule</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--New Schedule Modal End-->
                </div>
            </div>
        </div>
    </div>
</div>
