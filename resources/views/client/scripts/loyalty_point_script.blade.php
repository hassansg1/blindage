<script>

    $(document).ready(function () {
        $('#loyalty_points_table_el').DataTable();
    });

    function addLoyaltyPoints() {
        let balance = $('#loyalty_points_input').val() == '' ? 0 : $('#loyalty_points_input').val();
        let comment = $('#comments_loyalty').val();
        let clientId = $('#current_obj_id').val();

        $.ajax({
            type: "POST",
            url: '{{ route('loyalty_points.store') }}',
            data: {
                'balance': balance,
                clientId: clientId,
                ajax: true,
                comment: comment,
                '_token': '{{ csrf_token() }}'
            },
            success: function (result) {
                if (result.status) {
                    $('#loyalty_points_table').html(result.html);
                    $('#loyalty_points_table_el').DataTable();
                    doSuccessToast('Success..!!!');
                } else {
                    doSomethingWentWrongToast();
                }
            },
        });
    }
$(function () {
    var currentSrc = $('#Picture').attr('src');
    $('#Picture').attr('');
    $("#Picture").on('click', function () {
        $("#imgInp").trigger('click');
    });

});
function uploadProfileImage(url, csrf,user_id=null) {
    readURL(this, url, csrf,user_id);
}

function readURLIM(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#Picture').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function () {
    readURLIM(this);
});

function readURL(input, url, csrf,user_id) {
    var fileInput = document.getElementById('imgInp');
    var file = fileInput.files[0];
    var formData = new FormData();
    formData.append('user_profile', file);
    formData.append('user_id', user_id);
    formData.append('_token', csrf);
    formData.append('old_image', $('#old-image').val());
    formData.append('active_accordion', 'user_profile');
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        timeout: 15000,
        success: function (data) {
            if (data.status == false) {
                var error_title="";
                $.each(data.error, function (key, value) {
                    validateImage(key, value);
                    $('#' + key).addClass('has-error');
                     error_title += "<li>"+value+"</li>";

                });

                doSuccessToast('Encounters error ! <b> <ul>'+error_title+'</ul></b>');
    
            } else {
                $('#imgInp').val('');
                if (typeof (data.newFileName) != "undefined" && data.newFileName !== null) {
                    $('#old-image').val(data.newFileName);
                }
                doSuccessToast('Successfully Upload..!!!');

                return false;
            }
        },
    });
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#Picture').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

</script>