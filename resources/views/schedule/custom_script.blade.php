<script>

    $(document).ready(function () {
        resetCalender();
    });

    $('.calendar_branch').on('change', function () {
        var branch_id = $(this).val();
        getBranchAppointments(branch_id);

    });

    function resetCalender() {
        $('#calendar').html('');
        renderCalender(window, tui.Calendar); // set calendars
    }


    {{--function getAllAppointments() {--}}
    {{--    $.ajax({--}}
    {{--        type: "GET",--}}
    {{--        url: '{{ route('appointment.index') }}',--}}
    {{--        success: function (result) {--}}
    {{--            if (result.status) {--}}
    {{--                resetCalender();--}}
    {{--            }--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}




</script>
