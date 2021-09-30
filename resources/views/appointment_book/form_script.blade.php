<script>

    $('#select_service_drop_down').on('change', function () {
        resubmitForm();
    });

    $('#select_client_drop_down').on('change', function () {
        resubmitForm();
    });    

    $('.schedule_details_modal_submit').on('change', function () {
        resubmitForm();
    });


    $('.services_items_dropdown').on('change', function () {
        updateServicesItems(this.value);
        // resubmitForm();
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

    function updateServicesItems(value) {
        // console.log(value);

        $.ajax({
            type: "GET",
            url: '{{ route('appointment_book.getItemsDataView') }}',
            data: {
                value: value
            },
            success: function (result) {
                if (result.status) {
                   
                } else {
                }
            }
        });
        
    }



</script>