/*  ******************************************************************
 *  VERIFIE S' AGISSANT D' UNE VIDEO OU PAS
 *  ******************************************************************/
function isVideo(imgURL) {
    if(imgURL.includes('data:video') || imgURL.endsWith('.mp4') || imgURL.endsWith('.MP4') || imgURL.endsWith('.avi') || imgURL.endsWith('.AVI') || imgURL.endsWith('.flv') || imgURL.endsWith('.FLV') || imgURL.endsWith('.mpg') || imgURL.endsWith('.MPG') || imgURL.endsWith('.mpeg') || imgURL.endsWith('.MPEG') || imgURL.endsWith('.wmv') || imgURL.endsWith('.WMV') || imgURL.endsWith('.vob') || imgURL.endsWith('.VOB') || imgURL.endsWith('.mov') || imgURL.endsWith('.MOV') || imgURL.endsWith('.AVCHD') || imgURL.endsWith('.avchd') || imgURL.endsWith('.WebM')) {
        return true;   
    } else {
        return false;
    }
}

/*  ****************************************************************************
 *  AFFICHE LE BLOS CATEGORIE
 *  *****************************************************************************/
function showCategorieFormContent(){
    document.querySelector('div[id="add_categorie_form_content"]').style.display = 'flex';
}  


/*  ******************************************************************
 *  CHARGE L' IMAGE D' ENTETE (HEADER IMAGE)
 *  ******************************************************************/
function uploadHeaderImage(file){
    /* ---- Bloc(div) progress ---- */
    const header_image_progress = document.querySelector('div[id="header_image_progress"]');

    /* ---- Create une instance progressbar ---- */
    const header_image_progressbar = document.createElement('div');
          header_image_progressbar.setAttribute('class','progress-bar');
          header_image_progressbar.setAttribute('id','header_image_progressbar');

    /* ---- Contenu du bloc header_image_progress ---- */
    header_image_progress.append(header_image_progressbar);

    /* ---- Instance fileReaders ---- */
    const fileReader = new FileReader(); 

    /* ---- Au moment du chargement du fichier ---- */
    fileReader.onload = function(e){
        // alert(isVideo(e.target.result))
        const labelElement = document.querySelector('label[for="header_image"]');

        // Initialize la valeur background-image label
        labelElement.style.backgroundImage = "url('../../../image.non_image.jpg')";

        // S'agissant d'une video
        if(isVideo(e.target.result)){
            const content = '<video controls class="rounded-thumnail cover" style="width: 100%;height: 100%;">'+
               '<source src="'+e.target.result+'"/>'
            +'<video>';
            // Contenu HTML du label
            labelElement.innerHTML = ''+content+'';
            // Affiche la bar de progression
            header_image_progress.style.display = 'block';
            // Calcul & affichage pourcentage
            const total = document.querySelector('input[id="header_image"]').files[0].size;
            const pourcentage = Math.round((e.loaded * total) / 100);
            header_image_progressbar.style.width = ''+pourcentage+'%';
            header_image_progressbar.innerText = ''+pourcentage+'%';
            //Cache la bar de progression
            setTimeout(() => {
                if(pourcentage >= 100) {
                   header_image_progress.innerHTML = '';
                   header_image_progress.style.display = 'none';
                }
            },2000);

        } else {
            labelElement.innerHTML = '<span id="header-image-alternative">'+
                                        '<i class="fa fa-plus"></i> Image entente'
                                     +'<span>';
            labelElement.style.backgroundImage = 'url('+e.target.result+')';
        } 
    }
    fileReader.readAsDataURL(file);   
}



/* ******************************************************************
 * LORSQUE LE DOM EST CHARGE (DISPONIBLE)
 * ******************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- Variables DOM ---- */
    const headerImgInput   = document.querySelector('input[id="header_image"]');
    const addCategorieLink = document.querySelector('a[id="add_categorie_link"]');

    /* ---- Au moment de chargement du fichier (Image) ---- */
    headerImgInput.onchange = function(e) {
        uploadHeaderImage(e.target.files[0]);
    }

    /* ---- Au moment du click sur le lien add categorie ---- */
    addCategorieLink.onclick = function() {
        showCategorieFormContent(); 
    }
});

