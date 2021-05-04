$(function () {
    //Textare auto growth
    autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        clearButton: true,
        weekStart: 1
    });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });


    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });


    // RANGE  PIKER today
    $('.date-end').bootstrapMaterialDatePicker({
        clearButton: true,
        weekStart: 1,
        minDate: new Date(),
        time: false
    });
    $('.date-start').bootstrapMaterialDatePicker({
        clearButton: true,
        weekStart: 1,
        minDate: new Date(),
        time: false
    }).on('change', function (e, date) {
        $('.date-end').bootstrapMaterialDatePicker('setMinDate', date);
    });
    
    // RANGE  PIKER any day
    $('#date-end').bootstrapMaterialDatePicker({
        clearButton: true,
        weekStart: 1,
        time: false
    });
    $('#date-start').bootstrapMaterialDatePicker({
        clearButton: true,
        weekStart: 1,
     
        time: false
    }).on('change', function (e, date) {
        $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
    });

});