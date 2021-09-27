<div style="text-align: right">
    <button type="submit" class="btn btn-primary w-md submit_form">Save</button>
</div>

<script>
    function addNewAfterSave()
    {
        $('form').append('<input type="hidden" name="add_new" value="1" />');
        $('.submit_form').click();
    }
</script>
