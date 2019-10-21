/*================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 5.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
================================================================================

NOTE:
------
PLACE HERE YOUR OWN JS CODES AND IF NEEDED.
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR CUSTOM SCRIPT IT'S BETTER LIKE THIS. */
function notify(text)
{
    var toastHTML = `<span >${text}</span><button class="btn-flat toast-action modal-trigger">Close</button>`;
    M.toast({html: toastHTML});
}
$(document).ready(function() {


    $(document).on('click', '.delete-with-confirmation', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: "Are you sure?",
            icon: 'warning',
            buttons: {
                cancel: true,
                delete: 'Yes, Delete It'
            }
        }).then((willDelete) => {
            if (willDelete) {
                $(this).removeClass('delete-with-confirmation');
                window.location.href = href; //causes the browser to refresh and load the requested url
            }
        });

        $(document).on('click','.btn-flat.toast-action',function(){
            var toastElement = document.querySelector('.toast');
            var toastInstance = M.Toast.getInstance(toastElement);
            toastInstance.dismiss();
        });





    });


    $('.upload-preview').change(function(){
        document.getElementById('output').src = window.URL.createObjectURL(this.files[0])
    });


   
    $( "#call_captain" ).click(function(e) {
        var data = {
            '_token': $('#_order_token').val(),
            'target': 'captain',
            'sender' : $(this).data('sender'),
        };
        $.post( base_url + "/order/send-new-notification",data, function( response ) {
          
          });
    });

    $( "#call_parista" ).click(function() {
        var data = {
            '_token': $('#_order_token').val(),
            'target': 'parista',
            'sender' : $(this).data('sender'),
        };
        $.post( base_url + "/order/send-new-notification",data, function( response ) {
          
          });
    });

    $( "#call_cashier" ).click(function() {
        var data = {
            '_token': $('#_order_token').val(),
            'target': 'cashier',
            'sender' : $(this).data('sender'),
        };
        $.post( base_url + "/order/send-new-notification",data, function( response ) {
           
          });
        });


});
