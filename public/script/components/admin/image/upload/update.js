/* *************************************************************
 * CREER UNE INSTANCE IMAGE
 * ***********************************************************/
function createImgItem(imgURL){
    const imgItem = document.createElement('div');
    imgItem.setAttribute('class','upload-img-item');

    /* ---- FONCTION VERIFIANT S' IL D' UNE VIDEO ---- */
    const isVideo = function(){
        if(imgURL.includes('data:video') || imgURL.endsWith('.mp4') || imgURL.endsWith('.MP4') || imgURL.endsWith('.avi') || imgURL.endsWith('.AVI') || imgURL.endsWith('.flv') || imgURL.endsWith('.FLV') || imgURL.endsWith('.mpg') || imgURL.endsWith('.MPG') || imgURL.endsWith('.mpeg') || imgURL.endsWith('.MPEG') || imgURL.endsWith('.wmv') || imgURL.endsWith('.WMV') || imgURL.endsWith('.vob') || imgURL.endsWith('.VOB') || imgURL.endsWith('.mov') || imgURL.endsWith('.MOV') || imgURL.endsWith('.AVCHD') || imgURL.endsWith('.avchd') || imgURL.endsWith('.WebM')) {
            return true;   
        } else {
            return false;
        }
    } 

    /* ---- TYPE DE CONTENU IMAGE ---- */
    const content = isVideo(imgURL) ? '<video controls class="cover" style="width: 100%;height: 100%;"><source src="'+imgURL+'" class="img-data-url"></video>' : '<img src="'+imgURL+'" class="rounded-thumbnail cover img-data-url" style="width: 100%;height: 100%;"/>';

    /* ---- AFFICHAGE DU CONTENU ---- */
    const itemContent = '<div class="card">'+
        '<div class="card-body">'+
            '<div class="upload-img-bloc">'+
                ''+content+''
            +'</div>'+
            '<div class="upload-close-bloc">'+
                '<button type="button" title="Annuler l\'image" class="btn btn-danger btn-sm">'+
                    '<i class="fa fa-trash"></i>'
                +'</button>' 
            +'</div>'
        +'</div>'
    +'</div>';

    /************** CONTENU HTML ***************/
    imgItem.innerHTML = itemContent;
    
    return imgItem;
}



/* **************************************************************
 * FONCTION CREANT UNE INSTANCE INPUT
 * ************************************************************/
function createInputItem(file) {
    /* ---- ELEMENT INPUT ---- */
    const input = document.createElement('input');

    /* ---- MODIFIE LES VALEURS DES ATTRIBUTS ---- */
    input.setAttribute('type','file');
    input.setAttribute('name','imgs[]');
    input.setAttribute('id','imgs');
    input.style.display = 'none';
    input.value = file;

    return input;
}



/* **********************************************************************
 * FONCTION SUPPRIMANT UNE IMAGE EXISTANTE 
 * *********************************************************************/
function removeExistedImage(id) {
    /* ---- ELEMENT INPUT (IMAGES EXISTANT)  ---- */
    const remove_existed_files_input = document.createElement('input');

    /* ---- MODIFIE LES VALEURS DES ATTRIBUTS ---- */
    remove_existed_files_input.setAttribute('type','hidden');
    remove_existed_files_input.setAttribute('name','remove_uploads_id[]');
    remove_existed_files_input.setAttribute('id','remove_uploads_id');

    /* ---- VALEUR ELEMENT A RETIRER (SUPPRIMER) ---- */
    remove_existed_files_input.value = id;

    /* ---- AJOUT NOUVEAU ELEMENT INPUT AU FORMULAIRE ---- */  
    document.querySelector('form').prepend(remove_existed_files_input); 
}


/* ***********************************************************************
 * FONCTION SUPPRIMANT UNE IMAGE UPLOADEE
 * *********************************************************************/
function removeUplodedImage(input,indexToRemove){ 
    /* ---- OBJECT DataTransfert ---- */
    const dt = new DataTransfer();

    /* ---- PARCOURT ENSEMBLE DES FICHIERS ---- */
    Array.from(input.files).forEach((file,index) => {
        if (index !== indexToRemove) {
            dt.items.add(file);
        }
    });

    /* ---- ELEMENT (IMAGES) A TRANSFERER ---- */
    input.files = dt.files;
}


/* ****************************************************************************
 * CHARGE (UPLOAD) DES IMAGES
 * **************************************************************************/
function onSelectFiles(e) {
    // VARIABLES DOM
    const upload_imgs_content = document.querySelector('div[id="upload_imgs_content"]');
    const progressContainer = document.querySelector('div[id="upload_progress"]');
    const progressBar = progressContainer.querySelector('div[id="progressbar"]');

    progressContainer.style.display = 'block';

    const fileArray = Array.from(e.target.files);

    let totalSize = 0;
    let totalLoaded = 0;

    // Calcule le poids total réel
    fileArray.forEach(file => totalSize += file.size);

    // Tableau pour suivre la progression de chaque fichier
    let loadedPerFile = new Array(fileArray.length).fill(0);

    fileArray.forEach((file, index) => {
        const reader = new FileReader();

        // --------------------------
        // 🔵 Progression par fichier
        // --------------------------
        reader.onprogress = (ev) => {
            if (ev.lengthComputable) {

                // Mise à jour du chargement de CE fichier
                loadedPerFile[index] = ev.loaded;

                // Total chargé = somme de tous les fichiers
                totalLoaded = loadedPerFile.reduce((a, b) => a + b, 0);

                const percent = Math.round((totalLoaded * 100) / totalSize);

                progressBar.style.width = percent + '%';
                progressBar.innerText = percent + '%';
            }
        };

        // -------------------------------------------------------
        // 🔵 Une fois ce fichier chargé
        // -------------------------------------------------------
        reader.onload = function(ev) {
            upload_imgs_content.append(createImgItem(ev.target.result));
        };

        // -------------------------------------------------------
        // 🔵 Une fois TOUS les fichiers chargés
        // -------------------------------------------------------
        reader.onloadend = function() {
            if (loadedPerFile.every((val, i) => val === fileArray[i].size)) {

                // Petit délai pour fluidité visuelle
                setTimeout(() => {
                    progressContainer.style.display = 'none';
                    progressBar.style.width = '0%';
                    progressBar.innerText = '';
                }, 800);
            }
        };

        reader.readAsDataURL(file);
    });
}



/****************************************************************************
 * DES QUE LE DOM EST CHARGE
 * **************************************************************************/
document.addEventListener('DOMContentLoaded', function () {

    /* ---- VARIABLES DOM ---- */
    const open_popup_btn = document.querySelector('#open_popup_btn');
    const upload_btn_group = document.querySelector('#upload_btn_group');
    const evenement_image_popup = document.querySelector('#evenement_image_popup');
    const remove_btn = document.querySelector('#upload_remove_btn');
    const upload_imgs_content = document.querySelector('#upload_imgs_content');
    const fileInput = document.querySelector('input[id="images"]');
     
    /* ---- IMAGES UPLOADEES (STOKEES) ----*/
    const storedImages = images.filter(item => item.img_source == 'upload');

    // Affichage des images s' ils existent
    if(storedImages && storedImages?.length > 0) {
        storedImages.forEach(item => {
            upload_imgs_content.append(createImgItem(window.STORAGE_PATH_URL+'/'+item.path));
        }); 
    } 

    // Au moment de chargement de fichier
    fileInput.onchange = function(e) {
        onSelectFiles(e);
    }

    // Modal ouvert
    evenement_image_popup.addEventListener('show.bs.modal', () => {
        open_popup_btn.style.display = 'none';
        upload_btn_group.style.display = 'flex';
    });

    // Modal fermé
    evenement_image_popup.addEventListener('hide.bs.modal', () => {
        upload_btn_group.style.display = 'none';
        open_popup_btn.style.display = 'block';
    });

    // Bouton supprimer (toggle overlay)
    remove_btn.addEventListener('click', (e) => {

        const icon = e.currentTarget.querySelector('i');

        if (upload_imgs_content?.querySelectorAll('.upload-close-bloc')?.length > 0) {
            icon.classList.toggle('fa-times');
            icon.classList.toggle('fa-minus'); 
        }

        upload_imgs_content
            .querySelectorAll('.upload-close-bloc')
            .forEach(bloc => {
                bloc.style.display =
                    bloc.style.display === 'flex' ? 'none' : 'flex';
            });
    });

    // ✅ DÉLÉGATION : clic sur une image supprimée
    upload_imgs_content.addEventListener('click', function (e) {

        const closeBtn = e.target.closest('.upload-close-bloc button');
        if (!closeBtn) return;

        const index = Array.from(document.querySelectorAll('.upload-close-bloc button')).findIndex(item => item == closeBtn);

        const imgItem = document.querySelectorAll('.upload-img-item')[index];
        if (!imgItem) return;

        const imgDataUrl = document.querySelectorAll('.img-data-url')[index];
        if(!imgDataUrl) return;
       
        const foundedImage = () => {
            if(storedImages) {
                return storedImages?.find(item => window.STORAGE_PATH_URL+'/'+item.path == imgDataUrl.getAttribute('src') );
            } 
            else {
                return null;
            }
        }

         

        if(foundedImage()) {
            // Inscrit le fichier existant (backend) a supprimer
            removeExistedImage(foundedImage().id);
            // Mets a jour la variable images (Supprime l 'element du tableau)
            const foundedImgIndex = storedImages.findIndex(item => item.id == foundedImage().id);
            storedImages.splice(foundedImgIndex,1); // Suppression via index 
        } else {
            // Position (index) pour fichier image
            const fileIndex = () => storedImages  ? (storedImages.length > 0 ? index - storedImages.length : index) : index;
            // Appel a la methode ( Redefinit les fichiers a uploader )
            
            removeUplodedImage(fileInput,fileIndex());
        }

        // Supprime l' element .img-item 
        imgItem.remove();

        // reset bouton si plus d’images
        if (document.querySelectorAll('.upload-img-item').length == 0) {
            remove_btn.innerHTML = '<i class="fa fa-minus"></i>';
        }
    });
});
 
