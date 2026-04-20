
/* *****************************************************************************
 * AU MOMENT DU CHARGEMENT DU DOM (DOCUMENT CHARGE)
 * ****************************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- REPONSE PAR DEFAUT ----*/
    document.querySelector('textarea[name="reponse"]').value = questionnement.reponse;
});
