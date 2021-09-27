<script>

    $(document).ready(function () {
        getAllAppointments();
    });

    function resetCalender(items) {
        $('#calendar').html('');
        renderCalender(window, tui.Calendar, items); // set calendars
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
</script>
