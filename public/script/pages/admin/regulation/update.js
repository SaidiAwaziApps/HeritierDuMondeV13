/* *****************************************************************************
 * METHODE INITIALISATION (INITIE LES VALUERS PAR DEFAUTS)
 * ****************************************************************************/
function init() {
    /* ---- VARIABLES DOM ---- */
    const attemptAllToModerated = document.querySelector('input[id="attempt_all_to_moderated"]');
    const mustAlreadyModerated = document.querySelector('input[id="must_already_moderated"]');
    const nbrAlreadyModerated = document.querySelector('input[id="nbr_already_moderated"]');
    const deniedWords = document.querySelector('textarea[id="denied_words"]');
    // const deniedImages = document.querySelector('textarea[id="denied_images"]');

    /* ---- VALEURS PAR DEFAUT (DEFAULT VALUES) ---- */
    attemptAllToModerated.checked = regulation.attempt_all_to_moderated.toLowerCase() == 'oui' ? true : false ;
    mustAlreadyModerated.checked = regulation.must_already_moderated.toLowerCase() == 'oui' ? true : false ;
    nbrAlreadyModerated.value = regulation.must_already_moderated.toLowerCase() == 'oui' ? regulation.nbr_already_moderated : 1 ;
    deniedWords.value = regulation.denied_words;

    /* ---- APPLIQUE LES VALEURS SELECTIONNEES ---- */
    $('#denied_images').val(regulation.denied_images.split(',')).trigger('change');
}


/* *****************************************************************************
 * METHODE ACTIVE OU DESACTIVE LES ELEMENT DU FORMULAIRE
 * ****************************************************************************/
function toggleFormField(isActivated) {
    /* ---- VARIABLES DOM ---- */
    const mustAlreadyModeratedFiled = document.querySelector('input[id="must_already_moderated"]');
    const nbrAlreadyModeratedField = document.querySelector('input[id="nbr_already_moderated"]');
    const deniedImagesField = document.querySelector('select[id="denied_images"]');
    const deniedWordsField = document.querySelector('textarea[id="denied_words"]');

    /* ---- Array field (Contient tous les champs) --- */
    const fieldArray = [mustAlreadyModeratedFiled,nbrAlreadyModeratedField,deniedImagesField,deniedWordsField];

    /* ---- VALEUR INPUT EXISTANT (Champ coche) ---- */ 
    if(isActivated) {
        // Parcourt de l' ensemble des element du tableau
        fieldArray.forEach(item => {
            // Deux premiers champs
            fieldArray[0].checked = false;
            fieldArray[1].value = 1;
            // Iniatialize la valeur du champs
            item.value = '';
            // Rend disabled le champs
            item.disabled = true;
        });
    } else {
        // Parcourt de l' ensemble des element du tableau
        fieldArray.forEach(item => {
            item.disabled = false;
        }); 
    }
}  



/* *****************************************************************************
 * AU MOMENT DU CHARGEMENT DU DOM (DOCUMENT)
 * ****************************************************************************/
$(document).ready(function() {
    /* ---- Variables DOM ---- */
    const attemptAllToModeratedInput = document.querySelector('input[name="attempt_all_to_moderated"]');

    /* --- Initialise le champs ---- */
    $('#denied_images').select2({
        placeholder: "Sélectionnez une ou plusieurs catégories",
        allowClear: true
    });
     
    /* ---- Appel a la methode i nit(initialization des donnees du formulaire) ---- */
    init();

    /* ---- Appel de la methode a l' initiale ---- */
    toggleFormField(attemptAllToModeratedInput.checked);

    /* ---- Au moment du click sur le champ input ---- */
    attemptAllToModeratedInput.onclick = function(e) {
        toggleFormField(e.currentTarget.checked);               
    } 
});
