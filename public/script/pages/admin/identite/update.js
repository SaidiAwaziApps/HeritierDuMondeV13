/* ***************************************************************
 * INITIALISE LE CONTENU DU CHAMPS DU FORMULAIRE
 * *************************************************************/
function init() {
    /* ---- Variables DOM ---- */
    const descriptionField = document.querySelector('textarea[name="description"]');

    /* ---- Valeurs pa defaut ---- */
    descriptionField.value = identite.description;
}

/* ***************************************************************
 * FONCTION SELECT IMAGE
 * *************************************************************/
function onSelectFile(e){
    const fileReader = new FileReader();
    fileReader.onload = function(e){
        const image = document.querySelector('img[id="input_logo_img"]');
        image.setAttribute('src',e.target.result);
    }
    fileReader.readAsDataURL(e.target.files[0]);
}


/* ***************************************************************
 * LORSQUE LE DOM EST CHARGE
 * *************************************************************/
document.addEventListener('DOMContentLoaded',function() {
    /* ---- Variable DOM ---- */
    const fileInput = document.querySelector('input[type="file"]');

    /* ---- Au moment de chargement du fichier (upload) ---- */
    fileInput.onchange = function(e){
        onSelectFile(e);
    }

    /* ---- Appel a le methode initialisation (init) ---- */
    init();
})
