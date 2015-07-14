$(document).ready(function() {
    $('input#time-of-appointment').datetimepicker({
        sideBySide: true
    });
    $('form#new-appointment').submit(function() {
        var appointmentInISOFormat = new Date($('input#time-of-appointment').val()).toISOString();
        $('input#time-of-appointment').val(appointmentInISOFormat);
    });
});
