
/* ************************************************************
 * LORSQUE LE DOM EST CHARGE
 * ***********************************************************/

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (popoverTriggerEl) {
        new bootstrap.Popover(popoverTriggerEl);
    });

    document.querySelectorAll('[data-bs-toggle="popover"]').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
        });
    });
}); 