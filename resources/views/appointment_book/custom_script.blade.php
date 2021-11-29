<script>

    $(document).ready(function () {
        getAllAppointments();
    });

    $('.calendar_branch').on('change', function () {
        var branch_id = $(this).val();
        getBranchAppointments(branch_id);

    });

    function resetCalender(items) {
        $('#calendar').html('');
        renderCalender(window, tui.Calendar, items); // set calendars
    }

    function getBranchAppointments(branch_id) {
        $.ajax({
            type: "GET",
            url: '{{ route('appointment.getBranchAppointments') }}',
            data: {
                branch_id: branch_id,
            },
            success: function (result) {
                if (result.status) {
                    console.log(result.items);
                    resetCalender(result.items);
                }
            }
        });
    }

    function getAllAppointments() {
        $.ajax({
            type: "GET",
            url: '{{ route('appointment.index') }}',
            success: function (result) {
                if (result.status) {
                    resetCalender(result.items);
                }
            }
        });
    }

    function openCustomCreateSchedulePopup(start, end, id) {
        $.ajax({
            type: "GET",
            url: '{{ route('appointment_book.getAppointmentModal') }}',
            data: {
                start: start,
                end: end,
                id: id,
            },
            success: function (result) {
                if (result.status) {
                    showModal(centerModal, result.html);
                    getAllAppointments();
                } else {
                }
            }
        });
    }

    function draftAppointment(start, end) {
        $.ajax({
            type: "POST",
            url: '{{ route('appointment_book.store') }}',
            data: {'_token': '{{ csrf_token() }}'},
            success: function (result) {
                if (result.status) {
                    openCustomCreateSchedulePopup(start, end, result.id);
                } else {
                }
            },
        });
    }

    function getAppointmentView(appointment_book_id)
    {
        console.log(appointment_book_id);
        $.ajax({
            type: "GET",
            url: '{{ route('appointment.getAppointmentView') }}',
            data: {
                appointment_book_id: appointment_book_id,
            },
            success: function (result) {
                if (result.status) {
                    console.log(result.items);
                    $("#div_id_clientInfoModal_content").html(result.html);
                    $('#clientInfoModal').modal('show');

                }
            }
        });
    }


</script>


    <script type="text/javascript">
        $(function () {
    listData();
});
var t = '';
// var today_val = ;
function listData() {
    t = $('#view-List').DataTable({
        "lengthChange": false, 
        "dom": 'Btipr',
        "processing": true,
        "serverSide": true,
        "aaSorting": [0 ,'asc'],
        "ajax": {
            "url": '{{ route('appointment_book.get_Appointment') }}',
            "dataType": "json",
            "type": "POST",
            data: function(data) {
                data._token = '{{ csrf_token() }}';
                data.today = $("#appt_view_today").val();
                data.status_flag = $("#status_flag").val();
                data.date_range = $("#dateRange_appointmentList").val();
                data.branch_id = $("#branch_id_search").val();
            },
            "timeout": 15000
        },
        "columns": [
            {"data": "id"},
            {"data": "clientName"},
            {"data": "dated"},
            {"data": "services"},
            {"data": "status"},
            {"data": "employee"},
            {"data": "payment"},
            {"data": "total"}
        ],
        "columnDefs": [{
                "targets": [0, 1, 2, 3, 4, 5, 6],
                "sortable": false,
                "orderable": false
            }]
    });

    $.fn.dataTable.ext.errMode = 'throw';

    $("#appt_view_today_label").on('click', function (e) {
        t.draw();
    });

    $("#status_flag").on('change', function (e) {
        t.draw();
    });

    $("#dateRange_appointmentList").on('change',function(e){
        t.draw();
    });

    $("#branch_id_search").on('change',function(e){
        t.draw();
    });


    $('#search_data').on('click', function (e) {
        var v = $("#search").val(); // getting search input value
        if (v) {
            t.search(v).draw();
        }
    });

}

    //Buttons examples





$(function() {
  $('input[id="dateRange_appointmentList"]').daterangepicker({
    opens: 'left',
    alwaysShowCalendars:true,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
       'This Week': [moment().startOf('isoWeek'), moment()],
       'Last 7 Days': [moment().subtract('days', 6), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
    </script>
<script>
        // ...............   Funtion For New Schdeule Appointment

    $('.create_new_services_items_dropdown').on('change', function () {
       let start =  $('#start_for_service').val();
       let end =  $('#end_for_service').val();
       let duration =  $('#duration_for_service').val();

       create_new_updateServicesItems(this.value,start,end,duration);

    });


    function create_new_updateServicesItems(value,start=null,end=null,duration=null) {

        $.ajax({
            type: "GET",
            url: '{{ route('appointment_book.getItemsDataView') }}',
            data: {
                value: value,
                start: start,
                end: end,
                duration: duration
            },
            success: function (result) {
                    // console.log('get');
                    // console.log(result);
                if (result.status) {
                    switch(result.modal_name) {
                        case 'Product':
                            $("#create_new_products_items_append_div").append(result.html);
                            doSuccessToast('Successfully Added in Bucket...');

                            break;
                        case 'Service':
                            $("#create_new_services_items_append_div").append(result.html);
                            doSuccessToast('Successfully Added in Bucket...');

                            break;
                        case 'Package':
                            $("#create_new_packages_items_append_div").append(result.html);
                            doSuccessToast('Success Fully Added In Bucket...');

                            break;
                        default:
                            doWarningToast("Record Not Found...");
                            return false;
                    }



                } else {
                }
            }
        });

    }
    function deleteRow()
    {
        $(event.target).closest('.deleteRow').remove();
        //console.log('run');
    }

    function create_new_appointment_save()
    {
        $.ajax({
            type: "POST",
            url: '{{ route('appointmentBook.create_new_store') }}',
            data: $('#create_new_schedule_form').serialize(),
            success: function (result) {
                if (result.status) {
                    $(".newScheduleModal").modal('hide');
                    doSuccessToast('Appointment SuccessFully Added...');
                    setInterval(function() {
                       location.reload();
                    }, 1000);
                    // getAllAppointments();
                } else {
                    doWarningToast("Something Wrong Please Check...");
                }
            },
        });
    }
    function updateAppointWhenDrag(value) {

        var time =  value.changes.start._date.getHours() + ":"  
            + value.changes.start._date.getMinutes() + ":" 
            + value.changes.start._date.getSeconds();

        var id = value.schedule.isPrivate;

        var start_date = value.changes.start._date.getDate() + "-"
            + (value.changes.start._date.getMonth()+1)  + "-" 
            + value.changes.start._date.getFullYear();

        var end_date = value.changes.end._date.getDate() + "-"
            + (value.changes.end._date.getMonth()+1)  + "-" 
            + value.changes.end._date.getFullYear();

        $.ajax({
            type: "POST",
            url: '{{ route('appointment_book.updateAppointWhenDrag') }}',
            data: {'_token': '{{ csrf_token() }}',appt_id:id,start_date:start_date,end_date:end_date,time:time },
            success: function (result) {
                if (result.status) {
                    console.log(result);
                    
                } else {
                }
            },
        });
    }
</script>
