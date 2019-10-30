$(document).ready(function(){


    $('select[name="cityId"]').on('change',function(){
        debugger;
        console.log($(this).val());
        $('select[name="officeId"] option[data-city_id]').attr('disabled','disabled');
        $('select[name="officeId"] option[data-city_id="'+$(this).val()+'"]').removeAttr('disabled');
        $('select').formSelect();
    });

    $('select[name="officeId"] option[data-city_id]').attr('disabled','disabled');
    $('select').formSelect();


});
