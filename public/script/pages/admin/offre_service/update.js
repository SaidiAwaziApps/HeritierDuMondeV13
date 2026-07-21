/* ******************************************************************
 * LORSQUE LE CONTENU DU DOM EST CHARGE
 * ******************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- Variables DOM ---- */
    const intituleField = document.querySelector('input[name="intitule"]');
    const descriptionField = document.querySelector('textarea[name="description"]');

    /* ---- Affectation valeurs par defaut ---- */
    intituleField.value = offre_service.intitule;
    descriptionField.value = offre_service.description;
});