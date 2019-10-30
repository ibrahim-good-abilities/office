$(document).ready(function() {
    if ($("[name='officialTime']").is(':checked')) {
        $('.official').attr('disabled', 'disabled');
    }

    $("[name='officialTime']").on('change', function() {
        if ($(this).is(':checked')) {
            $('.official').attr('disabled', 'disabled');
        } else {
            $('.official').removeAttr('disabled');
        }
    });

    $('.timepicker').timepicker();
});