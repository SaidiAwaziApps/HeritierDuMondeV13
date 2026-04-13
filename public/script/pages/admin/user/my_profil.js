/* **************************************************************************
 * METHODE CHARGEMENT DU FICHIER (IMAGE) 
 * **************************************************************************/
function onSelectFile(e){
    const fileReader = new FileReader();
    fileReader.onload = function(e){
        const image = document.querySelector('img[id="user_profil_img"]');
        image.setAttribute('src',e.target.result);
    }
    fileReader.readAsDataURL(e.target.files[0]);
}


/* **************************************************************************
 * LORSQUE LE DOM EST CHARGE (PRES)
 * *************************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- Variables DOM ---- */
    const inputFile = document.querySelectorAll('input[type="file"]');

    /* ---- Au moment de chargement du fichier (IMAGE) ---- */
    inputFile.onchange = function(e) {
        onSelectFile(e);
    };
});

