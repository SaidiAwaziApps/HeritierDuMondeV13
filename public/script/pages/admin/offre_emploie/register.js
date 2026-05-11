/* *****************************************************************************
 * AU MOMENT DU CHARGEMENT DU DOM (DOCUMENT CHARGE)
 * ****************************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- VARIABLES DOM ---- */
    const documentInput = document.querySelector('input[id="document"]');
    const documentFileName = document.querySelector('span[id="document_file_name"]');

    /* ---- MODIFIE LA VALEUR CHAMPS DOCUMENT ---- */
    documentInput.onchange = function(e) {
        documentFileName.innerHTML = e.target.files[0].name;
    }
});
