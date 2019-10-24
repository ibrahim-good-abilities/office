$(function() {

    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";


    $('#offices').DataTable({
        "responsive": false,

        "language": {
            "url": language
        },
        columnDefs: [
            { orderable: false, targets: 7 }
        ]
    });
    $(document).on('click','a[href="#changeAdmin"]',function(e){

         var office_id = $(this).closest('tr').data('office_id');
         $("#changeAdmin input[name='office_id']").val(office_id);
         e.preventDefault();
    })


    $(document).ready(function() {
        $('.modal').modal();
    });

});
