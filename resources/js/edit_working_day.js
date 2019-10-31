$(function() {

    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";


    $('#schedule').DataTable({
        "responsive": false,

        "language": {
            "url": language
        },
        columnDefs: [
            { orderable: false, targets: 5 }
        ]
    });
    $(document).ready(function() {
        var dateToday = new Date();
        $('.days-datepicker').datepicker({
            firstDay: 4,
            minDate: dateToday,
            format: 'yyyy-mm-dd'
        });
    });
});
