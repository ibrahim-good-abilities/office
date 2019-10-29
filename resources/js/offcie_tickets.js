$(function() {

    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";


    $('#tickets').DataTable({
        "responsive": false,

        "language": {
            "url": language
        },
        columnDefs: [
            { orderable: false, targets: 7 }

        ],

    });
    $(document).on('click','a[href="#feedback"]',function(e){
        debugger;
        var ticketRate = $(this).closest('td').data('rate');
        $("#rate").html(ticketRate);
        var ticketFeedback = $(this).closest('td').data('feedback');
        $("#ticket_feedback").html(ticketFeedback);

        e.preventDefault();
   })
    $(document).ready(function() {
        $('.modal').modal();
    });
});
