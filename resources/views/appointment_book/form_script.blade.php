<script>

    $('#mobile_no').on('change', function () {
        resubmitForm();
    });
    $('#clientEmail').on('change', function () {
        resubmitForm();
    });

    $('#select_client_drop_down').on('change', function () {
        resubmitForm();
    });

    $('.schedule_details_modal_submit').on('change', function () {
        console.log('run');
        resubmitForm();
    });


    $('.services_items_dropdown').on('change', function () {
       let start =  $('#start_for_service').val();
       let end =  $('#end_for_service').val();
       let duration =  $('#duration_for_service').val();

       updateServicesItems(this.value,start,end,duration);

    });

    function deleteRow()
    {
        $(event.target).closest('.deleteRow').remove();
        //console.log('run');
    }


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

    function openScheduleDetailPopup(id,start=null,end=null) {
        $.ajax({
            type: "GET",
            url: '{{ route('appointment_book.getAppointmentDetailModal') }}',
            data: {
                id: id,
                start_time:start,
                end_time:end
            },
            success: function (result) {
                if (result.status) {
                    showModal(defaultModal, result.html);
                } else {
                }
            }
        });
    }


    function updateServicesItems(value,start=null,end=null,duration=null) {
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
                            $("#products_items_append_div").append(result.html);
                            doSuccessToast('Successfully Added in Bucket...');
                                    resubmitForm();
                            break;
                        case 'Service':
                            $("#services_items_append_div").append(result.html);
                            doSuccessToast('Successfully Added in Bucket...');
                                    resubmitForm();
                            break;
                        case 'Package':
                            $("#packages_items_append_div").append(result.html);
                            doSuccessToast('Success Fully Added In Bucket...');
                                    resubmitForm();
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

    $(document).ready(function(){
      $('.client-cancel-info').hide();
      $('#cancelApptBtn').click(function(){
         $('.client-cancel-info').show();
         $('.client-summary-info-main-wrapper').hide();
      });
      $('#backToCardBtn').click(function(){
        $('.client-cancel-info').hide();
        $('.client-summary-info-main-wrapper').show();
      });
    });

</script>
