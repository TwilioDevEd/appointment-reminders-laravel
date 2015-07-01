$(document).ready(function() {
    $('input#time-of-appointment').datetimepicker();
    $('form#new-appointment').submit(function() {
        var appointmentInISOFormat = new Date($('input#time-of-appointment').val()).toISOString();
        $('input#time-of-appointment').val(appointmentInISOFormat);
    });
});
