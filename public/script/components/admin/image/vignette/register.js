
/*******************************************
 * VARIABLES GLOBALES
 ******************************************/
const DEFAULT_IFRAME_TEXT = "Insérer un iframe";

/*******************************************
 * CRÉATION D'UN ITEM
 ******************************************/
function createVgnItem() {
    const vgnItem = document.createElement('div');
    vgnItem.classList.add('card', 'vgn-img-item');

    vgnItem.innerHTML = `
        <div class="card-body">
            <div class="vgn-img-bloc">
                <div class="vgn-iframe-input">
                    <span contenteditable="false">${DEFAULT_IFRAME_TEXT}</span>
                </div>
                <div class="vgn-iframe-result"></div>
            </div>
            <div class="vgn-close-bloc" style="display:none;">
                <button type="button" class="btn btn-danger btn-sm vgn-close-btn">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    `;
    return vgnItem;
}



/*******************************************************
 * CREATION D' UN ELEMENT INPUT
 * *****************************************************/
function createVgnInput() {
    const input = document.createElement('input');
    input.setAttribute('type','hidden');
    input.setAttribute('name','iframes[]');
    input.setAttribute('id','iframes');

    return input;
}


/*******************************************
 * VERIFIE LA VALIDATION D' UN IFRAME
 ******************************************/
function isValidIframe(content) {
    content = content.trim();

    // Regex valide même sur plusieurs lignes et empêche des attributs JS
    const iframeRegex = /^<iframe\b([^>]*)>([\s\S]*?)<\/iframe>$/i;

    const match = content.match(iframeRegex);
    if (!match) return false;

    let attributes = match[1];

    // Vérifie la présence d'un attribut src="..."
    const srcMatch = attributes.match(/\bsrc=["']([^"']+)["']/i);
    if (!srcMatch) return false;

    const srcValue = srcMatch[1].trim();
    if (srcValue.length === 0) return false;

    // Interdit les attributs JS dangereux
    const forbidden = /(on\w+=|javascript:)/i;
    if (forbidden.test(attributes)) return false;

    return true;
}







/*******************************************
 * LORSQUE LE DOM EST CHARGÉ
 ******************************************/
document.addEventListener('DOMContentLoaded', function () {

    const vignetteImagePopup = document.querySelector('#vignette_image_popup');
    const openPopupBtn = document.querySelector('#open_popup_btn');
    const vgnImgsContent = document.querySelector('#vgn_imgs_content');

    const vgnAddBtn = document.querySelector('#vgn_add_btn');
    const vgnRemoveBtn = document.querySelector('#vgn_remove_btn');

    const vgnInputs = document.querySelector('.vignette-inputs');

    let deleteMode = false; // mode suppression activé ?


    /*******************************************
     * AJOUT DES 3 ITEMS INITIAUX
     ******************************************/
    for (let i = 0; i < 3; i++) {
        vgnImgsContent.appendChild(createVgnItem());
        
        vgnInputs.appendChild(createVgnInput());
    }


    /*******************************************
     * AFFICHAGE / MASQUAGE DU BOUTON OUVERTURE
     ******************************************/
    if (vignetteImagePopup && openPopupBtn) {
        vignetteImagePopup.addEventListener('show.bs.modal', () => {
            openPopupBtn.style.display = 'none';
        });
        vignetteImagePopup.addEventListener('hide.bs.modal', () => {
            openPopupBtn.style.display = 'block';
        });
    }


    /*******************************************
     * AJOUT D’UNE NOUVELLE VIGNETTE
     ******************************************/
    vgnAddBtn.addEventListener('click', () => {
        const newItem = createVgnItem();
        vgnImgsContent.appendChild(newItem);
        
        // Ajout d' un element input au bloc vgnInputs (.vignette-inpu)
        vgnInputs.appendChild(createVgnInput());

        // Synchronise avec mode suppression
        if (deleteMode) {
            newItem.querySelector('.vgn-close-bloc').style.display = 'flex';
        }
    });


    /*******************************************
     * ACTIVATION / DÉSACTIVATION DU MODE SUPPRESSION
     ******************************************/
    vgnRemoveBtn.addEventListener('click', () => {
        deleteMode = !deleteMode;
        vgnRemoveBtn.classList.toggle('active', deleteMode);

        // changer icône
        vgnRemoveBtn.innerHTML = deleteMode
            ? '<i class="fa fa-times"></i>'
            : '<i class="fa fa-minus"></i>';

        // affichage des boutons "fermer"
        document.querySelectorAll('.vgn-close-bloc').forEach(bloc => {
            bloc.style.display = deleteMode ? 'flex' : 'none';
        });
    });


    /*******************************************
     * DÉLÉGATION D'ÉVÉNEMENTS SUR TOUTE LA ZONE
     ******************************************/
    vgnImgsContent.addEventListener('click', function (e) {

        /*******************************************
         * 1. CLIC SUR UN BOUTON DE SUPPRESSION
         ******************************************/
        const closeBtn = e.target.closest('.vgn-close-btn');

        if (closeBtn) {
            const allItems = document.querySelectorAll('.vgn-img-item');
            const index = Array.from(document.querySelectorAll('.vgn-close-btn')).findIndex(item => item == closeBtn);

            const iframeInput = document.querySelectorAll('.vgn-iframe-input')[index];
            const iframeResult = document.querySelectorAll('.vgn-iframe-result')[index];
            const closeBloc = document.querySelectorAll('.vgn-close-bloc')[index];

            // Reset contenu
            iframeResult.style.display = 'none';
            iframeInput.style.display = 'flex';
            iframeInput.querySelector('span').textContent = `${DEFAULT_IFRAME_TEXT}`;

                     
            // Si plus de 3 → suppression physique
            if (allItems.length > 3) {
                allItems[index].remove();

                vgnInputs.children[index].remove();  // Supprime input element 
            } else {
                closeBloc.style.display = 'none';
            }

            return; // éviter d'autres actions
        }


        /*******************************************
         * 2. CLIC SUR UNE ZONE D’ENTRÉE IFRAME
         ******************************************/
        const iframeInput = e.target.closest('.vgn-iframe-input');

        if (iframeInput) {
            const span = iframeInput.querySelector('span');

            // If first click: nettoyer texte par défaut
            if (span && span.textContent === DEFAULT_IFRAME_TEXT) {
                span.textContent = "";
            }

            // activer édition
            span.setAttribute('contenteditable', 'true');
            span.focus();
            
            return;
        }
    });


    /*******************************************
    0 * GESTION DU BLUR (SORTIE ZONE EDITION)
     ******************************************/
    vgnImgsContent.addEventListener('blur', function (e) {
        const iframeInput = e.target.closest('.vgn-iframe-input'); 
        if (!iframeInput) return;

        const span = iframeInput.querySelector('span');
        if (!span) return;

        span.setAttribute('contenteditable', 'false');

        const rawHTML = span.innerText.trim(); // Mieux que textContent ici

        if (rawHTML.length === 0) {
            span.innerHTML = DEFAULT_IFRAME_TEXT;
            return;
        }


        // Cacher zone input
        iframeInput.style.display = 'none';

        // Trouver index
        const index =
            Array.from(document.querySelectorAll('.vgn-iframe-input'))
                 .findIndex(item => item == iframeInput);

        const iframeResult =
            document.querySelectorAll('.vgn-iframe-result')[index];


        if (isValidIframe(rawHTML)) {
            // Affectation de element input le contenu input
            vgnInputs.children[index].value = rawHTML;

            // Contenu HTML du bloc result
            iframeResult.innerHTML = rawHTML;

            // Redimensionnement
            const iframe = iframeResult.children[0];
            iframe.style.width = "100%";
            iframe.style.height = "100%";

            // Affichage du resultat
            iframeResult.style.display = "flex";

            return; // ← IMPORTANT : ne pas remettre le texte par défaut !
        }

        // Rend null le contenu input
        vgnInputs.children[index].value = null;

        // Sinon iframe non valide
        iframeResult.style.display = 'flex';
        iframeResult.style.justifyContent = 'center';
        iframeResult.style.alignItems = 'center';

        iframeResult.style.backgroundColor = 'pink';
        // iframeResult.style.marginTop = window.innerWidth >500 ? '-85%' : '-56%';
        
        iframeResult.innerHTML = '<span style="font-weight: bold;font-family: italic;">'+
                                    'Iframe incorrect !!!'
                                 +'</span>';

        setTimeout(() => {
            iframeResult.style.display = 'none';
            iframeResult.style.justifyContent = 'flex-start';
            iframeResult.style.alignItems = 'flex-start';

            iframeResult.innerHTML = ''; 

            // Cacher zone input
            iframeInput.style.display = 'flex';
        },4000);                         

        // alert("Not valide iframe");
        span.innerHTML = DEFAULT_IFRAME_TEXT;

        console.log(iframeResult);
    }, true);

}); 
