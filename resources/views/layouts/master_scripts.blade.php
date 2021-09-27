<script src="{{ URL::asset('/assets/libs/toastr/toastr.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/toastr.init.js') }}"></script>
<script>
    $(document).ready(function () {
        let flashMessage = '{{ \Illuminate\Support\Facades\Session::get('message') }}';
        if (flashMessage != "") {
            doToast(flashMessage, '{{ \Illuminate\Support\Facades\Session::get('alert-class') }}');
        }
        $('.form-select-input').select2({
            placeholder: "Select an option",
            allowClear: true,
            tags: true,
        });

        $('.form-select-input-no-add').select2({
            placeholder: "Select an option",
            allowClear: true,
        });
    });

    function doSuccessToast(flashMessage = "Success...!!!") {
        doToast(flashMessage, 'success');
    }

    function doToast(flashMessage, type) {
        toast(flashMessage, type);
        $.ajax({
            type: "POST",
            url: '{{ url('clearSession') }}',
            data: {'_token': '{{ csrf_token() }}'},
            success: function (result) {
            },
        });
    }


    let defaultModal = 'default_modal';
    let centerModal = 'center_modal';
    let smallModel = 'small_modal';

    function instantiateElementsAfterAjax()
    {
    }

    function showModal(name, content) {
        $('.modal').modal('hide');
        $('#' + name + '_content').html(content);
        $('#' + name).modal('show');
        $('.select2').select2({
            dropdownParent: $('#'+name)
        });
        instantiateElementsAfterAjax();
    }
</script>

