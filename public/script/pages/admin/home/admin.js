/* *****************************************************************
 * LORSQUE LE CONTENU DU DOM EST CHARGE
 * ****************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- Variables DOM ---- */
    const iframes = document.querySelectorAll('iframe');
   
    /* ---- Redimentionne chacun des elements iframe ---- */
    iframes.forEach(item => {
        item.style.width = '100%';
        item.style.height = '100%';
    });
});