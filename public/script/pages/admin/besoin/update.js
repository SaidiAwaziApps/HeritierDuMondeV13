/* ********************************************************************************
 * CONVERSION MONTANT (USD - EURO)
 * *******************************************************************************/
function convertAmount(amount, amountCurrency) {
    if (
        window.paymentSetting.currency_display_mode.toLowerCase() != 'current' &&
        amountCurrency != window.paymentSetting.currency
        && currency_exchange_rate
    ) {
        return amountCurrency === 'USD'
            ? amount * currency_exchange_rate
            : amount / currency_exchange_rate;
    } else {
        return amount;
    }
}

/*  ******************************************************************
 *  INITIALISE LE CONTENU DE L' AFFICHAGE
 *  ******************************************************************/
function init(){
   /* ---- Variables DOM ----*/ 
   const intitule_field = document.querySelector('input[name="intitule"]');
   const montant_field  = document.querySelector('input[name="montant"]');
   const contenu_field  = document.querySelector('textarea[name="contenu"]');

   /* ---- Initialise les champs du formulaire ---- */
   intitule_field.value = besoin.intitule; 
   montant_field.value  = convertAmount(besoin.montant, besoin.currency);
   contenu_field.value  = besoin.contenu;     
}

/*  ******************************************************************
 *  LORSQUE LE DOM EST CHARGE (DISPONIBLE)
 *  ******************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- Appel de la methode init ---- */
    init();   
});
