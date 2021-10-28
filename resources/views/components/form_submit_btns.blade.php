<div style="text-align: center">
    <button type="submit" class="btn btn-success waves-effect w-md submit_form">Save</button>
    <button type="button" onclick="addNewAfterSave()" style="display: {{ isset($edit) && $edit ? 'none' : 'inline'}} "  class="btn btn-info waves-effect w-md">Save and Add New</button>
    <button type="submit" class="btn btn-danger waves-effect waves-light w-md">
        <a class="href_btns" href="{{ url()->previous()  }}">Cancel</a>
    </button>
</div>

<script>
    function addNewAfterSave()
    {
        $('form').append('<input type="hidden" name="add_new" value="1" />');
        $('.submit_form').click();
    }
</script>
