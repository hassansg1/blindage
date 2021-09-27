<script>

    $('#select_service_drop_down').on('change', function () {
        resubmitForm();
    });

    $('#select_client_drop_down').on('change', function () {
        resubmitForm();
    });

    function resubmitForm() {
        $.ajax({
            type: "POST",
            url: '{{ route('appointment_book.store') }}',
            data: $('#appointment_form').serialize(),
            success: function (result) {
                if (result.status) {
                    getAllAppointments();
                }
            },
        });
    }

    function openScheduleDetailPopup(id) {
        $.ajax({
            type: "GET",
            url: '{{ route('appointment_book.getAppointmentDetailModal') }}',
            data: {
                id: id
            },
            success: function (result) {
                if (result.status) {
                    showModal(defaultModal, result.html);
                } else {
                }
            }
        });
    }
</script>