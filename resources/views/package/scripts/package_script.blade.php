<script>

    function selectProductForPackage()
    {
        let sel = $('#product_package_search');
        let id =sel.val();
        let item_class =sel.find(":selected").attr('data-modal');

        if($('#'+item_class+id).length == 0)
        {
            $.ajax({
                type: "GET",
                url: '{{ route('package_item.create') }}',
                data: {
                    id: id,
                    item_class: item_class,
                    ajax: true,
                },
                success: function (result) {

                    if (result.status == '1') {
                        $('#packageDetails').append(result.data);
                    } else {
                        doSomethingWentWrongToast();
                    }
                },
            });
        }
    }
    // function storePackageData(event) {
    // var form = new FormData;
    //
    // }
</script>
