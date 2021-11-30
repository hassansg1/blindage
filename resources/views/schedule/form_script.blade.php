<script>
    var i = 1;
    function getDateRange(dateType) {
        if(dateType == 'next'){
            i++
        }  if(dateType == 'pre'){
            i--
        }
        $.ajax({
            type: "GET",
            url: '{{ route('schedule.get_date') }}',
            data: {incDec:i,dateType:dateType,lastDate:$('#lastDate').val(),},
            success: function (result) {
                if (result.status == 1) {
                    $('#lastDate').val(result.lastDate);
                    $('#dateRangeValue').html(result.result);
                    $('#calenderTable').html(result.dateData);
                }
            },
        });
    }
    function getModalData(dateValue,keyValue) {
        $.ajax({
            type: "GET",
            url: '{{ route('schedule.get_branch_time') }}',
            data: {dateValue:dateValue},
            success: function (result) {
                if (result.status == 1) {
                    $('#modalData').html(result.result);
                    $('#keyValue').val(keyValue);
                    $('#time_schedule_modal').modal('show');

                }
            },
        });
    }
    function setBranchTime() {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('schedule.set_branch_time') }}',
            data: $('#branchDataForm').serialize(),
            success: function (result) {
                if (result.status == 1) {
                $('#time_schedule_modal').modal('hide');

                    if (result.repeat == 1) {
                        for (var i=  0; i< result.dateArray.length; i ++){
                            $(`#${result.dateArray[i]}`).html(result.data[result.dateArray[i]])
                        }
                    }
                    if (result.repeat == 2) {
                        $(`#${result.dateValue}`).html(result.data);
                    }
                 }
            },
        });
    }
    function setGeneralSchedule() {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('schedule.set_branch_general_time') }}',
            data: $('#generalScheduleForm').serialize(),
            success: function (result) {
                if (result.status == 1) {
                $('.businessHoursModal').modal('hide');
                $('#calenderTable').html(result.result);

                 }
            },
        });
    }
</script>
