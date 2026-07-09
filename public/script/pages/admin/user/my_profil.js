/* **************************************************************************
 * METHODE CHARGEMENT DU FICHIER (IMAGE) 
 * **************************************************************************/
function onSelectFile(e){
    const fileReader = new FileReader();
    fileReader.onload = function(e){
        const image = document.querySelectorAll('img[id="user_profil_img"]')[0];
        image.setAttribute('src',e.target.result);
    }
    fileReader.readAsDataURL(e.target.files[0]);
}


/* **************************************************************************
 * LORSQUE LE DOM EST CHARGE (PRES)
 * *************************************************************************/
document.addEventListener('DOMContentLoaded',function() {
    /* ---- Variables DOM ---- */
    const inputFile = document.querySelector('input[type="file"]');

    /* ---- Au moment du chargement du fichier ---- */
    inputFile.onchange = function(e){
       onSelectFile(e);
    };
});

