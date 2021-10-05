<script>
    // .. Global Varible Define
    (function(global) {

        global.items_bucket = [];

    }(this));

    function selectProductForPackage()
    {
        let sel = $('#product_package_search');
        let id =sel.val();
        let item_class =sel.find(":selected").attr('data-modal');

        if(jQuery.inArray(item_class+id , items_bucket) != -1) {
            // console.log("is in array");
            doWarningToast('Item Already In Bucket !');
            return false;
        } 
        
        items_bucket.push(item_class+id);

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

</script>
