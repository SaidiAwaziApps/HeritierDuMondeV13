/* ***************************************************************
 * FONCTION SELECT IMAGE
 * *************************************************************/
function onSelectFile(e){
    const fileReader = new FileReader();
    fileReader.onload = function(e){
        var image = document.querySelector('img[id="input_logo_img"]');
        image.setAttribute('src',e.target.result);
    }
    fileReader.readAsDataURL(e.target.files[0]);
}


/* ***************************************************************
 * LORSQUE LE DOM EST CHARGE
 * *************************************************************/
document.addEventListener('DOMContentLoaded',function() {
    /* ---- Variables DOM ---- */
    const fileInput = document.querySelector('input[type="file"]');

    /* ---- Au moment du chargement du fichier (upload) ---- */
    fileInput.onchange = function(e){
        onSelectFile(e);
    }
})
