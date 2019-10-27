$(document).ready(function() {
    var dateToday = new Date();
    $('.days-datepicker').datepicker({
        firstDay: 4,
        minDate: dateToday,
        format: 'yyyy-mm-dd'
    });
});