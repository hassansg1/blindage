<script>

    $('#mobile_no').on('change', function () {
        resubmitForm();
    });
    $('#clientNotes').on('change', function () {
        resubmitForm();
         $('#clientCommentData').append($('#clientNotes').val());
        $('#clientNotes').html('');
    });
    var multiImages = [];
    $('#clientImage').on('change', function (e) {
        var form_data = new FormData();
        form_data.append("file", document.getElementById('clientImage').files[0]);
        form_data.append("appointment_book_id", $('#appointment_book_id').val());
        multiImages.push(URL.createObjectURL(document.getElementById('clientImage').files[0]));
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('appointment_book.store') }}',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if (result.status) {
                    getAllAppointments();
                    $('#imageRecordCall').html('')
                    for(var i=0; i < multiImages.length; i++){
                       var imageData =  '<img src="'+ multiImages[i] +'" widht="100px" height="100px" >';
                        $('#imageRecordCall').append(imageData)
                    }
                }
            },
        });
    });
    $('#clientEmail').on('change', function () {
        resubmitForm();
    });

    $('#select_client_drop_down').on('change', function () {
        console.log('client');
        resubmitForm();
        doSuccessToast('Successfully Change...');
    });

    $('#select_branch_drop_down').on('change', function () {
        console.log('branch');
        resubmitForm();
        doSuccessToast('Successfully Change...');
    });

    $('.schedule_details_modal_submit').on('change', function () {
        console.log('run');
        resubmitForm();
        doSuccessToast('Successfully Change...');
    });
    $('#appointment_type_id').on('change', function () {
        resubmitForm();
        doSuccessToast('Successfully Change...');
    });

    $('#select_service_drop_down').on('change', function () {
        console.log('service');

        resubmitForm();
        doSuccessToast('Successfully Change...');
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
    $('#submitFormClient').on('click', function () {
        $.ajax({
            type: "POST",
            url: '{{ route('addNewController') }}',
            data: $('#addNewClientModal').serialize(),
            success: function (result) {
                getAllAppointments();
            },
        });
    });

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

    function appointmentStatusUpdate(appointbook_id , value)
    {
        if(value!=null && value!="" && value!='')
        {
            $.ajax({
            type: "GET",
            url: '{{ route('appointment_book.appointment_status_update') }}',
            data: {
                appointbook_id: appointbook_id,
                value:value

            },
            success: function (result) {

                if (result.status) {
                    if(typeof result.html !== 'undefined')
                    {
                        $("#div_id_clientInfoModal_content").html(result.html);

                    }

                    doSuccessToast('Successfully Update...');
                } else {
                    doSuccessToast('Something Wrong...');
                }


            }
        });

        }
    }
        $('.addNewClient').click(function(){
            $('.bs-example-modal-center').modal('hide');
        });





</script>
