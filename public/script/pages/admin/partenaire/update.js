/* **********************************************************************
 * Initialize le contenu du DOM (valuer par defaut du champ textarea)
 * *********************************************************************/
function init() { 
    /* ---- Variables DOM ----*/
    const descriptionField = document.querySelector('textarea[id="description"]');

    /* ---- Valeur par defaut ---- */
    descriptionField.value = partenaire.description ? partenaire.description : '';
}


/* ***************************************************************
 * LORSQUE LE DOM EST CHARGE
 * **************************************************************/
document.addEventListener('DOMContentLoaded', function() {

    /* ---- Variables DOM ---- */
    const logoInput   = document.querySelector('input[name="logo"]');
    const logoImgName = document.querySelector('span[id="logo-img-name"]');

    /* ---- Appel a la methode init ---- */
    init();

    /* ---- Upload Image (logo) ---- */
    logoInput.onchange = function(e) {
       logoImgName.innerHTML = e.target.files[0].name;
    }
});