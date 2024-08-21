//Notif Time
document.addEventListener('DOMContentLoaded', function () {
    var successAlert = document.getElementById('successAlert');
    var deleteAlert = document.getElementById('deleteAlert');
    if (successAlert) {
        setTimeout(function () {
            var bsAlert = new bootstrap.Alert(successAlert);
            bsAlert.close();
        }, 5000); // 5000 milliseconds = 5 seconds
    }

    if (deleteAlert) {
        setTimeout(function () {
            var bsAlert = new bootstrap.Alert(deleteAlert);
            bsAlert.close();
        }, 5000); // 5000 milliseconds = 5 seconds
    }
});