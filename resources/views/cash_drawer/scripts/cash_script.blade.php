<script>

    function setTotal(amount, id,typeBill) {
       var cash = $('#'+id).val();
       var oldTotal = $('#'+id+'Total').html();
       $('#'+id+'Total').html(parseFloat(amount) * parseFloat(cash));
      var total =  $('#'+id+'Total').html();

    if(typeBill == 'c'){
        $('#coinsTotal').val(parseFloat($('#coinsTotal').val()) + parseFloat(total)  - parseFloat(oldTotal));
    }else{
        $('#billsTotal').val(parseFloat($('#billsTotal').val()) + parseFloat(total) - parseFloat(oldTotal));
    }
    $('#grandTotal').val(parseFloat($('#billsTotal').val()) + parseFloat($('#coinsTotal').val()))
    }
    function setTimeFields() {
       var check =  $('#customTime').is(':checked');
       if(check){
           $('#allDays').prop('checked', false);
           $('#timeRange').css({
               display: 'inline-block',
           });
        }else{
           $('#allDays').prop('checked', true);
           $('#timeRange').css({
               display: 'none',
           });
       }
    }
</script>
