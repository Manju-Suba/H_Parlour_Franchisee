(function($) { 

    $("#from_date").datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: 0,
        onSelect: function () {
            var dt2 = $('#to_date');
            var startDate = $(this).datepicker('getDate');

            var minDate = $(this).datepicker('getDate');
            var dt2Date = dt2.datepicker('getDate');
            // var dateDiff = (dt2Date - minDate)/(86400 * 1000);
            var dateDiff = (dt2Date )/(86400 * 1000);
            
            startDate.setDate(startDate.getDate() );
            // alert(startDate);

            if (dt2Date == null || dateDiff < 0) {
                    dt2.datepicker('setDate', null);
            }
            else if (dateDiff > 30){
                    dt2.datepicker('setDate', dt2Date);
            }
            dt2.datepicker('option', 'maxDate', 'today');
            dt2.datepicker('option', 'minDate', startDate);
        }
    });
    $('#to_date').datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: 0,
    });
})(jQuery)