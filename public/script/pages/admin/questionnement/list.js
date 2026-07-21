/* *****************************************************************************
 * METHODE ACCORDION BUTTON CLOOPASE
 * ****************************************************************************/
function onCollapsedAccordion(element) {
    /* ---- Questionnement item --- */
    const questionnement = questionnements.find(function(item){
        return element.getAttribute('data-bs-target') == '#accordion_item_'+item.id;     
    });

    /* ---- Variables add_bloc, delete_bloc && update_bloc --- */
    const add_bloc = document.querySelector('div[id="add_bloc"]');
    const delete_bloc = document.querySelector('div[id="delete_bloc"]');
    const update_bloc = document.querySelector('div[id="update_bloc"]');

    /* ---- Verifie si l'accordeon-item est visible --- */
    if(element.getAttribute('aria-expanded')==true || element.getAttribute('aria-expanded')=='true') {
        // Cache le bloc ajouter
        add_bloc.style.display='none';
        // Affiche le block supprimer && modifier
        delete_bloc.style.display='block';
        update_bloc.style.display='block';
        // Modifie l'attribut action du formulaire
        delete_bloc.querySelector('form').setAttribute('action','/admin/questionnement/delete-one/'+questionnement.id); 
        // Modifie l'url du lien ajouter
        update_bloc.querySelector('a').setAttribute('href','/admin/questionnement/update/'+questionnement.id);             
    } 
    else {
        // Cache le bloc ajouter
        add_bloc.style.display='block';
        // Affiche le block supprimer && modifier
        delete_bloc.style.display='none';
        update_bloc.style.display='none';
        // Modifie l'attribut action du formulaire
        delete_bloc.querySelector('form').setAttribute('action',''); 
        // Modifie l'url du lien ajouter
        update_bloc.querySelector('a').setAttribute('href','#'); 
    }
}


/* *****************************************************************************
 * AU MOMENT DU CHARGEMENT DU DOM (DOCUMENT CHARGE)
 * ****************************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- VARIABLES DOM ---- */
    const accordionButtons = document.querySelectorAll('button[class="accordion-button collapsed"]');

    /* ---- PARCOURT ELEMENTS BUTTONS ---- */
    accordionButtons.forEach(element => {
        element.onclick = function(e) {
            onCollapsedAccordion(e.currentTarget); 
        }
    });
});



