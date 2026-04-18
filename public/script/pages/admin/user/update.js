/* ***************************************************************
 * METHODE CHARGEMENT DU FICHIER (IMAGE) 
 * **************************************************************/
function onSelectFile(e){
    const fileReader = new FileReader();
    fileReader.onload = function(e){
        const image = document.querySelector('img[id="user_profil_img"]');
        image.setAttribute('src',e.target.result);
    }
    fileReader.readAsDataURL(e.target.files[0]);
}


/* ***********************************************************************
 * LORSQUE LE DOM EST CHARGE (PRES)
 * ***********************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- Variables DOM  ---- */
    const elements  = document.querySelectorAll('input[type="checkbox"]');
    const fileInput = document.querySelector('input[type="file"]');
    
    /* ---- Parcourt ensemble des roles && elements ---- */
    roles.forEach(role => {
        elements.forEach(element => {
            if(element.value == role.rolename) {
                element.checked = true;
            }
        });
    });

    /* ---- AU moment de chargement du fichier (IMAGE) ---- */
    fileInput.onchange = function(e){
        onSelectFile(e);
    };
});



