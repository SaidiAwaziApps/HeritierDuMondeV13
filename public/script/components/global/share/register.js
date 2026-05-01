
/* ***********************************************************************
 * ENSEMBLE DES ELEMENTS SE PRODUISANT ENTRE LA REQUETTE && LA REPONSE
 * ***********************************************************************/
function feedback(element,response,error) {
    // * ---- Desactive le spinner ---- */
    setTimeout(() => {
        element.disabled = false;                 // Button clique(element declencheur)
        element.children[0].style.opacity = '1';  // Icon reseau sociaux 
        element.children[1].style.opacity = '0';  // Spinner(loader)
    },1000);

    // * ---- Variable toastFeedback && initialization ---- */
    const toastFeedback = document.getElementById('feedbackToast');
    toastFeedback.children[0].children[0].innerHTML = '';

    // * ---- Instanciation du toast ---- *
    const toast = new bootstrap.Toast(toastFeedback,{
        animation: true,
        autohide: true,
        delay: 3000 // 3 secondes 
    });

    // * ---- Couleur de bordure de toast (couleur initiale) ---- */
    toastFeedback.style.borderLeft = '3px solid red';

    // * ---- En cas de reponse positive ---- */
    if(response) {
        if(!response?.data?.errors) {
            // Couleur de bordure de toast
            toastFeedback.style.borderLeft = '2px solid green';
            // Ouverture de la fenetre partage
            window.innerWidth > 800 ? window.open(response.data.share.url, 'popup', 'width=600,height=600,left=200,top=100') : window.open(response.data.share.url, '_blank');
            // Incremente le compteur de partage
            const shareLength = document.querySelector('i[class="share-length"]'); 
            shareLength.innerText = parseInt(shareLength.innerText) + 1;
        }
        else {
            
            // Erreur validations
            const validatorErrors = JSON.parse(response.data.errors);
            for(let key in validatorErrors) {
                for(let i = 0;i < validatorErrors[key].length; i++) {
                   toastFeedback.children[0].children[0].insertAdjacentHTML('beforeend','<i style="font-size: 20px;font-weight: bold;font-family: italic;">'+validatorErrors[key][i]+'</i>');
                   toast.show();                     
                }
            }
        }
    } else {
        toastFeedback.children[0].children[0].innerHTML = '<i style="font-size: 20px;font-weight: bold;font-family: italic;">'+error.response ? 'Echec de partage !!!' : 'Echec de connection au serveur' +'</i>';
        toast.show();
    }
}


/* ***************************************************************************
 * AU MOMENT DU CHARGEMENT DU CONTENU HTML (DOM)
 * ***************************************************************************/
document.addEventListener('DOMContentLoaded', function () {
    // * ---- Variables DOM ---- *
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const shareForm = document.querySelector('form[id="share_form"]');
    const mediaButtons = document.querySelectorAll('button[id="media"]');

    // * ---- Applique popover sur l' ensemble des elements ---- * 
    [...popoverTriggerList].map(el => new bootstrap.Popover(el));

    // * ---- Au moment ou l' on soumet le formulaire ---- *
    shareForm.addEventListener('submit', function(e) {
        e.preventDefault();
    });

    // * ---- Au moment ou l' on clique sur chacun des elements ---- * 
    mediaButtons.forEach((item) => {
        item.onclick = function(event) {
            // Previent comportement par defaut && propagation 
            event.preventDefault();
            event.stopPropagation();

            // Desactive le button
            this.disabled = true;

            // Affiche le loader 
            item.children[0].style.opacity = '0.4';
            item.children[1].style.opacity = '1';

            // Appel a la methode http 
            axios.post('/share/save', {
                    shareable_type: document.querySelector('input[name="shareable_type"]').value,
                    shareable_id: document.querySelector('input[name="shareable_id"]').value,
                    media: this.value
                }, {
                headers: {
                    'Accept': 'application/json',        // <- Pour que Laravel renvoie JSON sur erreurs
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // si CSRF activé
                }
            })
            .then((response) => {
                feedback(this,response,null);
                console.log(response);
            })
            .catch(error => {
                feedback(this,null,error);
                console.log(error);
            });
        }
    });
});





