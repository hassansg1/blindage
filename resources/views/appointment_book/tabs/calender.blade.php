<div class="row">
    <div class="col-lg-2">
        <div class="left-side-bar-wrapper">
            <label>Calender</label>
            <div data-provide="datepicker-inline" class="bootstrap-datepicker-inline"></div>
        
        <div class="card">
            <div class="">
                <div class="row">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button fw-medium" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                        aria-expanded="true" aria-controls="flush-collapseOne">
                                    Waitlist(0)
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                 aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample"
                                 style="">
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

        <div class="card">
            <div class="">
                <div class="row">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button fw-medium" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                        aria-expanded="true" aria-controls="flush-collapseOne">
                                    Move Appointment
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                 aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample"
                                 style="">
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
                            <span id="menu-navi"
                                  class="d-sm-flex flex-wrap text-center text-sm-start justify-content-sm-between">
                                <div class="d-sm-flex flex-wrap gap-1">
                                    <div class="btn-group mb-2" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-primary move-day" data-action="move-prev">
                                            <i class="calendar-icon ic-arrow-line-left mdi mdi-chevron-left"
                                               data-action="move-prev"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary move-day" data-action="move-next">
                                            <i class="calendar-icon ic-arrow-line-right mdi mdi-chevron-right"
                                               data-action="move-next"></i>
                                        </button>
                                    </div>


                                    <button type="button" class="btn btn-primary move-today mb-2"
                                            data-action="move-today">Today</button>
                                </div>

                                <h4 id="renderRange" class="render-range fw-bold pt-1 mx-3"></h4>

                                <div class="dropdown align-self-start mt-3 mt-sm-0 mb-2">
                                    <button id="dropdownMenu-calendarType" class="btn btn-primary" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i id="calendarTypeIcon" class="calendar-icon ic_view_month"
                                           style="margin-right: 4px;"></i>
                                        <span id="calendarTypeName">Dropdown</span>&nbsp;
                                        <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" role="menu"
                                        aria-labelledby="dropdownMenu-calendarType">
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-daily">
                                                <i class="calendar-icon ic_view_day"></i>Daily
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-weekly">
                                                <i class="calendar-icon ic_view_week"></i>Weekly
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-monthly">
                                                <i class="calendar-icon ic_view_month"></i>Month
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-weeks2">
                                                <i class="calendar-icon ic_view_week"></i>2 weeks
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-weeks3">
                                                <i class="calendar-icon ic_view_week"></i>3 weeks
                                            </a>
                                        </li>
                                        <li role="presentation" class="dropdown-divider"></li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-workweek">
                                                <input type="checkbox" class="tui-full-calendar-checkbox-square"
                                                       value="toggle-workweek" checked>
                                                <span class="checkbox-title"></span>Show weekends
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem" data-action="toggle-start-day-1">
                                                <input type="checkbox" class="tui-full-calendar-checkbox-square"
                                                       value="toggle-start-day-1">
                                                <span class="checkbox-title"></span>Start Week on Monday
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" role="menuitem"
                                               data-action="toggle-narrow-weekend">
                                                <input type="checkbox" class="tui-full-calendar-checkbox-square"
                                                       value="toggle-narrow-weekend">
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
                                <select class="form-control select2 schedule_details_modal_submit" name="branch_id">
                                    <option value="">All Branch</option>

                                    @foreach(\App\Models\Branch::all() as $branch)
                                        <option value="{{ $branch->id ?? '' }}">{{ $branch->name ?? '' }}</option>
                                    @endforeach
                                </select>
                                <button id="btn-new-schedule" type="button" class="btn btn-primary lnb-new-schedule-btn width-180"
                                        data-toggle="modal">
                                    New schedule
                                </button>
                            </div>
                         
                        </div>
                    </div>
                    <div id="calendarList" class="lnb-calendars-d1 mt-4 mt-sm-0 me-sm-0 mb-4">
                    </div>
                    <div id="calendar" style="height: 800px;"></div>

                </div>
            </div>
        </div>
    </div>
</div>

