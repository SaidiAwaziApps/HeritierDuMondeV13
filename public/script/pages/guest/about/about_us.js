
/* ************************************************************
 * LORSQUE LE DOM EST CHARGE
 * ***********************************************************/

document.addEventListener('DOMContentLoaded', function () {

    setTimeout(() => {

        window.scrollTo({
            top: document.documentElement.scrollHeight,
            behavior: 'smooth'
        });
        
    }, 3000);

});