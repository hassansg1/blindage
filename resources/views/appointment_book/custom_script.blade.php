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
