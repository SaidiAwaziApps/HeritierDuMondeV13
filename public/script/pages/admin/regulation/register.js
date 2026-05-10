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
 * AU MOMENT DU CHARGEMENT DU DOM (DOCUMENT PRET)
 * ****************************************************************************/
$(document).ready(function(){   
    /* ---- Variables DOM ---- */
    const attemptAllToModeratedInput = document.querySelector('input[name="attempt_all_to_moderated"]');
    
    /* ---- Appel de la methode a l' initiale ---- */
    toggleFormField(attemptAllToModeratedInput.checked);

    /* ---- Au moment du click sur le champ input ---- */
    attemptAllToModeratedInput.onclick = function(e) {
        toggleFormField(e.currentTarget.checked);               
    } 

    /* ---- Initialisation de l' input denied_images ---- */
    $('#denied_images').select2({
        placeholder: "Sélectionnez une ou plusieurs catégories",
        allowClear: true
    });
});