/* ****************************************************************
 * INITIALISE LE CONTENU DYNAMIQUE 
 * ***************************************************************/
function init() {
    /* ---- Les variables span positif &negatif(Oui && Non) ---- */
    const positif_response = document.querySelector('span[id="positif_response"]');
    const negatif_response = document.querySelector('span[id="negatif_response"]');

    /* ---- Sign Ok(Check sign) ---- */
    const check_sign = document.createElement('i');
          check_sign.setAttribute('class','fa fa-check');
          check_sign.style.color = 'cadetblue';
          check_sign.style.marginRight = '-1px';

    /* ---- En cas d'existance de la reception ---- */      
    if(don.reception) {
        check_sign.remove();
        positif_response.prepend(check_sign);
    } else {
        check_sign.remove();
        negatif_response.prepend(check_sign);
    }
}


/************************************************************************
 * AU MOMENT DU CHARGEMENT DU DOM 
 * **********************************************************************/
document.addEventListener('DOMContentLoaded',function() {
    /* ---- Variables DOM ---- */  
    const reception_button = document.querySelector('a[id="reception_button"]');
    const reception_form   = document.querySelector('form[id="reception_form"]');
    
    init();  // Appel a la methode initiale (init) 

    /* ---- Au moment ou l' on clique sur le button (lien) reception ---- */
    reception_button.onclick = function(e) {
        e.currentTarget.style.display = 'none';
        setTimeout(function() {
            reception_form.style.display = 'none';
        },40);
    }
});
