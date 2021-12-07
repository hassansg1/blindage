<script>
    /******/
    "use strict";
    var CalendarList = [];

    function CalendarInfo() {
        this.id = null;
        this.name = null;
        this.checked = true;
        this.color = null;
        this.bgColor = null;
        this.borderColor = null;
        this.dragBgColor = null;
    }

    function addCalendar(calendar) {
        CalendarList.push(calendar);
    }

    function findCalendar(id) {
        var found;
        CalendarList.forEach(function (calendar) {
            if (calendar.id === id) {
                found = calendar;
            }
        });
        return found || CalendarList[0];
    }

    (function () {
        var calendar;
        var id = 0;
        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Company';
        calendar.color = '#ffffff';
        calendar.bgColor = '#50a5f1';
        calendar.dragBgColor = '#50a5f1';
        calendar.borderColor = '#50a5f1';
        addCalendar(calendar);
        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Family';
        calendar.color = '#ffffff';
        calendar.bgColor = '#f46a6a';
        calendar.dragBgColor = '#f46a6a';
        calendar.borderColor = '#f46a6a';
        addCalendar(calendar);
        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Friend';
        calendar.color = '#ffffff';
        calendar.bgColor = '#34c38f';
        calendar.dragBgColor = '#34c38f';
        calendar.borderColor = '#34c38f';
        addCalendar(calendar);
        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Travel';
        calendar.color = '#ffffff';
        calendar.bgColor = '#bbdc00';
        calendar.dragBgColor = '#bbdc00';
        calendar.borderColor = '#bbdc00';
        addCalendar(calendar);
        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'etc';
        calendar.color = '#ffffff';
        calendar.bgColor = '#9d9d9d';
        calendar.dragBgColor = '#9d9d9d';
        calendar.borderColor = '#9d9d9d';
        addCalendar(calendar);
        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Birthdays';
        calendar.color = '#ffffff';
        calendar.bgColor = '#f1b44c';
        calendar.dragBgColor = '#f1b44c';
        calendar.borderColor = '#f1b44c';
        addCalendar(calendar);
        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'National Holidays';
        calendar.color = '#ffffff';
        calendar.bgColor = '#ff4040';
        calendar.dragBgColor = '#ff4040';
        calendar.borderColor = '#ff4040';
        addCalendar(calendar);
    })();
    var ScheduleList = [];

    function ScheduleInfo() {
        this.id = null;
        this.calendarId = null;
        this.title = null;
        this.body = null;
        this.isAllday = false;
        this.start = null;
        this.end = null;
        this.category = '';
        this.dueDateClass = '';
        this.color = null;
        this.bgColor = null;
        this.dragBgColor = null;
        this.borderColor = null;
        this.customStyle = '';
        this.isFocused = false;
        this.isPending = false;
        this.isVisible = true;
        this.isReadOnly = false;
        this.goingDuration = 0;
        this.comingDuration = 0;
        this.recurrenceRule = '';
        this.state = '';
        this.raw = {
            memo: '',
            hasToOrCc: false,
            hasRecurrenceRule: false,
            location: null,
            "class": 'public',
            // or 'private'
            creator: {
                name: '',
                avatar: '',
                company: '',
                email: '',
                phone: ''
            }
        };
    }

    function getTimeStamp(myDate) {
        myDate = myDate.split("-");
        var newDate = new Date(myDate[0], myDate[1] - 1, myDate[2]);

        return newDate.getTime();
    }

    function getHours(myDate) {
        myDate = myDate.split(":");

        return myDate[0];
    }

    function getMinutes(myDate) {
        myDate = myDate.split(":");

        return myDate[1];
    }

    function getTimeStampFromDate(myDate) {
        myDate = myDate.split(":");

        return myDate[0] + ":" + myDate[1];
    }

    function generateScheduleEntries(calendar, renderStart, renderEnd, items) {
        items.forEach(function (item) {
            // console.log(item.notes);
            var activityDate = item.appointment_book.activity_date;
            var color = '';
            var service_name = '';
            var service_duration = '';
            var client = "Client Name";

            if (item.appointment_book.client) {
                client = item.appointment_book.client.name;
            }

            if (item.service) {
                color = item.service.color;
                service_name = item.service.name;
                service_duration = item.service.name;
            }

            if (item.start_time && activityDate) {
                var schedule = new ScheduleInfo();
                schedule.id = chance.guid();
                schedule.calendarId = calendar.id;
                if(item.notes!=null)
                {
                    schedule.title = "<div>" + client + "<div class='client-comment'><div class='tooltipCustom'><i class='fas fa-comment-alt'></i><span class='tooltiptext'>"+item.notes+"</span></div></div></div>";

                }
                else
                {

                    schedule.title = "<div>" + client + "</div>";
                }
                if (item.duration != -1)
                    schedule.title += "<div>" + service_name + " - " + item.duration + "Mins</div>";
                schedule.title += "<div>" + getTimeStampFromDate(item.start_time) + " - " + getTimeStampFromDate(item.end_time) + "</div>";
                schedule.body = "Body";
                schedule.isReadOnly = false;
                schedule.isAllday = false;
                schedule.category = 'time';
                var startDate = moment(getTimeStamp(activityDate));
                startDate.hours(getHours(item.start_time));
                startDate.minutes(getMinutes(item.start_time));
                schedule.start = startDate.toDate();

                var endDate = moment(getTimeStamp(activityDate));
                endDate.hours(getHours(item.end_time));
                endDate.minutes(getMinutes(item.end_time));

                schedule.end = endDate.toDate();
                schedule.isPrivate = item.appointment_book_id;
                schedule.color = '#ffffff';
                schedule.bgColor = color;
                schedule.dragBgColor = color;
                schedule.borderColor = item.appointment_book.appointment_type.color;
                ScheduleList.push(schedule);
            }
        });
    }

    function generateSchedule(viewName, renderStart, renderEnd, items) {
        ScheduleList = [];
        generateScheduleEntries(calendar, renderStart, renderEnd, items);
    }

    function renderCalender(window, Calendar, items) {
        var cal, resizeThrottled;
        var useCreationPopup = false;
        var useDetailPopup = false;
        var datePicker, selectedCalendar;
        cal = new Calendar('#calendar', {
            defaultView: 'week',
            useCreationPopup: useCreationPopup,
            useDetailPopup: useDetailPopup,
            calendars: CalendarList,
            allDayView: false,
            template: {
                milestone: function milestone(model) {
                    return '<span class="calendar-font-icon ic-milestone-b"></span> <span style="background-color: ' + model.bgColor + '">' + model.title + '</span>';
                },
                time: function time(schedule) {
                    return getTimeTemplate(schedule, false);
                }
            }
        }); // event handlers

        cal.on({
            'clickMore': function clickMore(e) {
                console.log('clickMore', e);
            },
            'clickSchedule': function clickSchedule(e) {
                console.log('clickSchedule', e);
                // console.log('clickSchedule', e.schedule.isPrivate);

                getAppointmentView(e.schedule.isPrivate);
            },
            'clickDayname': function clickDayname(date) {
                console.log('clickDayname', date);
            },
            'beforeCreateSchedule': function beforeCreateSchedule(e) {
                console.log(e);
                var start = e.start ? new Date(e.start.getTime()) : new Date();
                var end = e.end ? new Date(e.end.getTime()) : moment().add(1, 'hours').toDate();
                draftAppointment(start, end);
                refreshScheduleVisibility();
            },
            'beforeUpdateSchedule': function beforeUpdateSchedule(e) {
                var schedule = e.schedule;
                var changes = e.changes;
                console.log('beforeUpdateSchedule', e);
                cal.updateSchedule(schedule.id, schedule.calendarId, changes);


                refreshScheduleVisibility();
                updateAppointWhenDrag(e);

                doSuccessToast('SuccessFully Update...');
            },
            'beforeDeleteSchedule': function beforeDeleteSchedule(e) {
                console.log('beforeDeleteSchedule', e);
                cal.deleteSchedule(e.schedule.id, e.schedule.calendarId);
            },
            'afterRenderSchedule': function afterRenderSchedule(e) {
                var schedule = e.schedule; // var element = cal.getElement(schedule.id, schedule.calendarId);
                // console.log('afterRenderSchedule', element);
            },
            'clickTimezonesCollapseBtn': function clickTimezonesCollapseBtn(timezonesCollapsed) {
                console.log('timezonesCollapsed', timezonesCollapsed);

                if (timezonesCollapsed) {
                    cal.setTheme({
                        'week.daygridLeft.width': '77px',
                        'week.timegridLeft.width': '77px'
                    });
                } else {
                    cal.setTheme({
                        'week.daygridLeft.width': '60px',
                        'week.timegridLeft.width': '60px'
                    });
                }

                return true;
            }
        });

        /**
         * Get time template for time and all-day
         * @param {Schedule} schedule - schedule
         * @param {boolean} isAllDay - isAllDay or hasMultiDates
         * @returns {string}
         */

         function getTimeTemplate(schedule, isAllDay) {
            var html = [];
            var start = moment(schedule.start.toUTCString());

            if (!isAllDay) {
                html.push('<strong>' + start.format('HH:mm') + '</strong> ');
            }

            if (schedule.isReadOnly) {
                html.push('<span class="calendar-font-icon ic-readonly-b"></span>');
            } else if (schedule.recurrenceRule) {
                html.push('<span class="calendar-font-icon ic-repeat-b"></span>');
            } else if (schedule.attendees.length) {
                html.push('<span class="calendar-font-icon ic-user-b"></span>');
            } else if (schedule.location) {
                html.push('<span class="calendar-font-icon ic-location-b"></span>');
            }

            html.push(' ' + schedule.title);

            return html.join('');
        }

        /**
         * A listener for click the menu
         * @param {Event} e - click event
         */


         function onClickMenu(e) {
            var target = $(e.target).closest('a[role="menuitem"]')[0];
            var action = getDataAction(target);
            var options = cal.getOptions();
            var viewName = '';
            console.log(target);
            console.log(action);

            switch (action) {
                case 'toggle-daily':
                viewName = 'day';
                break;
                case 'toggle-3_days':
                viewName = '3_days';
                break;
                case 'toggle-weekly':
                viewName = 'week';
                break;

                case 'toggle-monthly':
                options.month.visibleWeeksCount = 0;
                viewName = 'month';
                break;

                case 'toggle-weeks2':
                options.month.visibleWeeksCount = 2;
                viewName = 'month';
                break;

                case 'toggle-weeks3':
                options.month.visibleWeeksCount = 3;
                viewName = 'month';
                break;

                case 'toggle-narrow-weekend':
                options.month.narrowWeekend = !options.month.narrowWeekend;
                options.week.narrowWeekend = !options.week.narrowWeekend;
                viewName = cal.getViewName();
                target.querySelector('input').checked = options.month.narrowWeekend;
                break;

                case 'toggle-start-day-1':
                options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
                options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
                viewName = cal.getViewName();
                target.querySelector('input').checked = options.month.startDayOfWeek;
                break;

                case 'toggle-workweek':
                options.month.workweek = !options.month.workweek;
                options.week.workweek = !options.week.workweek;
                viewName = cal.getViewName();
                target.querySelector('input').checked = !options.month.workweek;
                break;

                default:
                break;
            }

            cal.setOptions(options, true);
            cal.changeView(viewName, true);
            setDropdownCalendarType();
            setRenderRangeText();
            setSchedules();
        }

        function onClickNavi(e) {
            var action = getDataAction(e.target);
            if(action){
                switch (action) {
                    case 'move-prev':
                    cal.prev();
                    break;

                    case 'move-next':
                    cal.next();
                    break;

                    case 'move-today':
                    cal.today();
                    break;

                    default:
                    return;
                }
            }
            else{
                var selecetdDate =e.format();
                cal.clear();
                if (cal.getViewName() === 'week') {
                    cal.setDate(new Date(selecetdDate+1));
                    cal.changeView('week', true);
                }
            }

            setRenderRangeText();
            setSchedules();
        }

        function selectCompleteWeek(){
           var t = $(this).text();
           var today = new Date();
           var date = (7*t+1);
           $("#calenderValue").datepicker("setDate", new Date(today.getFullYear(), today.getMonth(), date));
           activeWeek();
       }



       function activeWeek() {      
        var WeekFirstDay = $( "#calenderValue" ).datepicker("getDate").getDate();
        var WeekLastDay = $( "#calenderValue" ).datepicker("getDate").getDate()+7;
        $('.day.active').closest('tr').find('td:eq(4)').css('background-color','#eee3b2');
        $('.day.active').closest('tr').find('td:eq(5)').css('background-color','#eee3b2');
        $('.day.active').closest('tr').find('td:eq(6)').css('background-color','#eee3b2');
        $('.day.active').closest('tr').next('tr').find('td:eq(0)').css('background-color', '#eee3b2');
        $('.day.active').closest('tr').next('tr').find('td:eq(1)').css('background-color', '#eee3b2');
        $('.day.active').closest('tr').next('tr').find('td:eq(2)').css('background-color', '#eee3b2');
        $('.day.active').closest('tr').next('tr').find('td:eq(3)').css('background-color', '#eee3b2');
    }


    function onNewSchedule() {
        var title = $('#new-schedule-title').val();
        var location = $('#new-schedule-location').val();
        var isAllDay = document.getElementById('new-schedule-allday').checked;
        var start = datePicker.getStartDate();
        var end = datePicker.getEndDate();
        var calendar = selectedCalendar ? selectedCalendar : CalendarList[0];

        if (!title) {
            return;
        }

        cal.createSchedules([{
            id: String(chance.guid()),
            calendarId: calendar.id,
            title: title,
            isAllDay: isAllDay,
            start: start,
            end: end,
            category: 'time',
            dueDateClass: '',
            color: calendar.color,
            bgColor: calendar.bgColor,
            dragBgColor: calendar.bgColor,
            borderColor: calendar.borderColor,
            raw: {
                location: location
            },
            state: 'Busy'
        }]);
        $('#modal-new-schedule').modal('hide');
    }

    function onChangeNewScheduleCalendar(e) {
        var target = $(e.target).closest('a[role="menuitem"]')[0];
        var calendarId = getDataAction(target);
        changeNewScheduleCalendar(calendarId);
    }

    function changeNewScheduleCalendar(calendarId) {
        var calendarNameElement = document.getElementById('calendarName');
        var calendar = findCalendar(calendarId);
        var html = [];
        html.push('<div class="calendar-bar" style="background-color: ' + calendar.bgColor + '; border-color:' + calendar.borderColor + ';"></div>');
        html.push('<div class="calendar-name">' + calendar.name + '</div>');
        calendarNameElement.innerHTML = html.join('');
        selectedCalendar = calendar;
    }

    function createNewSchedule(event) {
        var start = event.start ? new Date(event.start.getTime()) : new Date();
        var end = event.end ? new Date(event.end.getTime()) : moment().add(1, 'hours').toDate();

        if (useCreationPopup) {
            cal.openCreationPopup({
                start: start,
                end: end
            });
        }
    }

    function saveNewSchedule(scheduleData) {
        var calendar = scheduleData.calendar || findCalendar(scheduleData.calendarId);
        var schedule = {
            id: String(chance.guid()),
            title: scheduleData.title,
            isAllDay: scheduleData.isAllDay,
            start: scheduleData.start,
            end: scheduleData.end,
            category: 'time',
            dueDateClass: '',
            color: calendar.color,
            bgColor: calendar.bgColor,
            dragBgColor: calendar.bgColor,
            borderColor: calendar.borderColor,
            location: scheduleData.location,
            raw: {
                "class": scheduleData.raw['class']
            },
            state: scheduleData.state
        };

        if (calendar) {
            schedule.calendarId = calendar.id;
            schedule.color = calendar.color;
            schedule.bgColor = calendar.bgColor;
            schedule.borderColor = calendar.borderColor;
        }

        cal.createSchedules([schedule]);
        refreshScheduleVisibility();
    }

    function onChangeCalendars(e) {
        var calendarId = e.target.value;
        var checked = e.target.checked;
        var viewAll = document.querySelector('.lnb-calendars-item input');
        var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));
        var allCheckedCalendars = true;

        if (calendarId === 'all') {
            allCheckedCalendars = checked;
            calendarElements.forEach(function (input) {
                var span = input.parentNode;
                input.checked = checked;
                span.style.backgroundColor = checked ? span.style.borderColor : 'transparent';
            });
            CalendarList.forEach(function (calendar) {
                calendar.checked = checked;
            });
        } else {
            findCalendar(calendarId).checked = checked;
            allCheckedCalendars = calendarElements.every(function (input) {
                return input.checked;
            });

            if (allCheckedCalendars) {
                viewAll.checked = true;
            } else {
                viewAll.checked = false;
            }
        }

        refreshScheduleVisibility();
    }

    function refreshScheduleVisibility() {
        var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));
        CalendarList.forEach(function (calendar) {
            cal.toggleSchedules(calendar.id, !calendar.checked, false);
        });
        cal.render(true);
        calendarElements.forEach(function (input) {
            var span = input.nextElementSibling;
            span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
        });
    }

    function setDropdownCalendarType() {
        var calendarTypeName = document.getElementById('calendarTypeName');
        var calendarTypeIcon = document.getElementById('calendarTypeIcon');
        var options = cal.getOptions();
        var type = cal.getViewName();
        console.log('runssss');
        console.log(type);
            // console.log(type);

            var iconClassName;

            if (type === 'day') {
                type = 'Daily';
                iconClassName = 'calendar-icon ic_view_day';
            }
            else if(type === '3 days')
            {
                type = '3 days';
                iconClassName = 'calendar-icon ic_view_3_days';
            } 
            else if (type === 'week') {
                type = 'Weekly';
                iconClassName = 'calendar-icon ic_view_week';
            } else if (options.month.visibleWeeksCount === 2) {
                type = '2 weeks';
                iconClassName = 'calendar-icon ic_view_week';
            } else if (options.month.visibleWeeksCount === 3) {
                type = '3 weeks';
                iconClassName = 'calendar-icon ic_view_week';
            } else {
                type = 'Monthly';
                iconClassName = 'calendar-icon ic_view_month';
            }

            calendarTypeName.innerHTML = type;
            calendarTypeIcon.className = iconClassName;
        }

        function setRenderRangeText() {
            var renderRange = document.getElementById('renderRange');
            var options = cal.getOptions();
            var viewName = cal.getViewName();
            var html = [];

            if (viewName === 'day') {
                html.push(moment(cal.getDate().getTime()).format('YYYY.MM.DD'));
            } else if (viewName === 'month' && (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
                html.push(moment(cal.getDate().getTime()).format('YYYY.MM'));
            } else {
                html.push(moment(cal.getDateRangeStart().getTime()).format('YYYY.MM.DD'));
                html.push(' ~ ');
                html.push(moment(cal.getDateRangeEnd().getTime()).format(' MM.DD'));
            }

            renderRange.innerHTML = html.join('');
        }

        function setSchedules() {
            cal.clear();
            generateSchedule(cal.getViewName(), cal.getDateRangeStart(), cal.getDateRangeEnd(), items);
            cal.createSchedules(ScheduleList); // var schedules = [
            //     {id: 489273, title: 'Workout for 2019-04-05', isAllDay: false, start: '2018-02-01T11:30:00+09:00', end: '2018-02-01T12:00:00+09:00', goingDuration: 30, comingDuration: 30, color: '#ffffff', isVisible: true, bgColor: '#69BB2D', dragBgColor: '#69BB2D', borderColor: '#69BB2D', calendarId: 'logged-workout', category: 'time', dueDateClass: '', customStyle: 'cursor: default;', isPending: false, isFocused: false, isReadOnly: true, isPrivate: false, location: '', attendees: '', recurrenceRule: '', state: ''},
            //     // {id: 18073, title: 'completed with blocks', isAllDay: false, start: '2018-11-17T09:00:00+09:00', end: '2018-11-17T10:00:00+09:00', color: '#ffffff', isVisible: true, bgColor: '#54B8CC', dragBgColor: '#54B8CC', borderColor: '#54B8CC', calendarId: 'workout', category: 'time', dueDateClass: '', customStyle: '', isPending: false, isFocused: false, isReadOnly: false, isPrivate: false, location: '', attendees: '', recurrenceRule: '', state: ''}
            // ];
            // cal.createSchedules(schedules);

            refreshScheduleVisibility();
        }

        function setEventListener() {
            $('#menu-navi').on('click', onClickNavi);            
            $('#calenderValue').datepicker({
                format: 'mm/dd/yyyy',
            }).on('changeDate', onClickNavi)
            $('#selectWeek span').on('click', selectCompleteWeek)
            $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
            $('#lnb-calendars').on('change', onChangeCalendars);
            $('#btn-save-schedule').on('click', onNewSchedule);
            $('#btn-new-schedule').on('click', createNewSchedule);
            $('#dropdownMenu-calendars-list').on('click', onChangeNewScheduleCalendar);
            window.addEventListener('resize', resizeThrottled);
        }

        function getDataAction(target) {
            return target.dataset ? target.dataset.action : target.getAttribute('data-action');
        }

        resizeThrottled = tui.util.throttle(function () {
            cal.render();
        }, 50);
        window.cal = cal;
        setDropdownCalendarType();
        setRenderRangeText();
        setSchedules();
        setEventListener();
    }

    (function () {
        var calendarList = document.getElementById('calendarList');
        var html = [];
        CalendarList.forEach(function (calendar) {
            html.push('<div class="lnb-calendars-item"><label>' + '<input type="checkbox" class="tui-full-calendar-checkbox-round" value="' + calendar.id + '" checked>' + '<div style="border-color: ' + calendar.borderColor + '; background-color: ' + calendar.borderColor + ';"></div>' + '<div>' + calendar.name + '</div>' + '</label></div>');
        });
        calendarList.innerHTML = html.join('\n');
    })();
    




</script>
