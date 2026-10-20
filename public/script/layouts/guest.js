/* *************************************************************
 * LORSQUE LE DOM EST CHARGE
 * *************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- Variables DOM ---- */
    const layoutsCarousel = document.querySelector('#layouts-carousel');

    if(window.location.pathname != '/') {
        layoutsCarousel.style.height = '240px';
    }
});