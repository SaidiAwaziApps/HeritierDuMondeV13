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
   montant_field.value  = besoin.montant;
   contenu_field.value  = besoin.contenu;     
}


/*  ******************************************************************
 *  LORSQUE LE DOM EST CHARGE (DISPONIBLE)
 *  ******************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- Appel de la methode init ---- */
    init();   
});
