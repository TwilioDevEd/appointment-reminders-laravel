$(document).ready(function() {
    $('input#time-of-appointment-local').datetimepicker({
        sideBySide: true
    });
    $('form#new-appointment').submit(function() {
        var appointmentInISOFormat = new Date($('input#time-of-appointment-local').val()).toISOString();
        $('input#time-of-appointment').val(appointmentInISOFormat);
        $('input#user-timezone').val(new Date().getTimezoneOffset());
    });
});
