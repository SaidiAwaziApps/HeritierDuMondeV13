
/* *******************************************************
 * RENVOIE LE MESSAGE DU SUCCESS
 * *******************************************************/
function successEvent(data, addCategorieDOMObject) {
    
    setTimeout(function(){
        addCategorieDOMObject.spinner_icon.style.display = 'none';
        addCategorieDOMObject.submit_icon.style.display  = 'block';
        addCategorieDOMObject.submit_button.disabled = false;
    },2000);
 
    setTimeout(function(){
        //En cas d'erreur validation formulaire
        if(data.errors) {
            let validatorErrors = data.errors;
            for(let key in validatorErrors) {
                for(let i = 0; i < validatorErrors[key].length; i++){
                    // Creer une element span
                    const span = document.createElement('span');

                    // Stylise l'element cree
                    span.style.fontSize   = '18px';
                    span.style.fontWeight = 'bold';
                    span.style.fontFamily = 'italic';
                    span.style.color      = 'red';
                    span.style.opacity    = '0.9';

                    // Contenu a l'element
                    span.innerHTML = ''+validatorErrors[key][i]+'<br>';

                    // Reinitialize le contenu feedback
                    addCategorieDOMObject.feedback.innerHTML = '';
            
                    // Ajoute l'element au bloc
                    addCategorieDOMObject.feedback.appendChild(span); 
                }
            }
        } 
        else { 
            // Select field
            const selectField = document.querySelector('select[id="categorie_id"]');
            // Creer un element option
            const fieldInnerHTML = selectField.innerHTML+'<option value="'+data.categorie.id+'">'+data.categorie.ctg_name+'</option>';
            // Nouveau contenu html
            selectField.innerHTML = ''+fieldInnerHTML+'';
            // Contenu du bloc
            addCategorieDOMObject.feedback.innerHTML = '<span style="font-size: 18px;font-weight: bold;font-family: italic;color: green;opacity: 0.7;">Categorie ajoute <i class="fa fa-sign-ok"></i></span>';
            // Reinitialize le contenu du bloc
        }
    },3000);

    setTimeout(function(){
        // Reinitialize le contenu du bloc
        addCategorieDOMObject.feedback.innerHTML = '';
    },7000);

    setTimeout(function(){
        //Reinitialize la valeur du champ nom pour categorie
        data.errors == null ? document.querySelector('input[name="nom"]').value = '' : '';
    },7500);

    setTimeout(function(){
        //Rend invisible le bloc add_categorie_form_content
        data.errors==null ? document.querySelector('div[id="add_categorie_form_content"]').style.display='none' : '';
    },9000);
}


/* ***********************************************************
 * AU MOMENT OU UNE ERREUR SE PRODUIT
 * ***********************************************************/
function failedEvent(error, addCategorieDOMObject) {

    /* ---- Cache l' icon submit && affiche le spinner ---- */
    setTimeout(function(){
        addCategorieDOMObject.spinner_icon.style.display = 'none';
        addCategorieDOMObject.submit_icon.style.display  = 'block';
        addCategorieDOMObject.submit_button.disabled = false;
    },2000);
    
    /* ---- Affiche message d' erreur ---- */
    setTimeout(() => {
        addCategorieDOMObject.feedback.innerHTML = error.response ? '<span style="font-size: 18px;font-weight: bold;font-family: italic; color: red; opacity: 0.9;">Echec enregistrement !!! <i class="fa fa-warning-sign"></i></span>' : '<span style="font-size: 18px;font-weight: bold;font-family: italic; color: red; opacity: 0.9;">Echec de connection au serveur !!! <i class="fa fa-warning-sign"></i></span>';
        console.log(error);
    },3000);
    
    /* ---- Reinitialize le contenu du bloc ---- */
    setTimeout(function() {
        /* ---- Reinitialize le contenu html du bloc add_categorie_feedback ---- */
        addCategorieDOMObject.feedback.innerHTML = '';
    },7000);
} 

/* ***************************************************************** 
 * ENSEMBLE EVENEMENTS ENTRE LA REQUETE && LA REPONSE 
 * *****************************************************************/
function feedback(data, error, addCategorieDOMObject) {
    if(data == null && error == null) {
        addCategorieDOMObject.submit_icon.style.display  = 'none';
        addCategorieDOMObject.spinner_icon.style.display = 'block';
        addCategorieDOMObject.submit_button.disabled = true;
    } 
    else if(data != null){
        successEvent(data, addCategorieDOMObject); 
    } else {
        failedEvent(error, addCategorieDOMObject);
    }
    console.log(data)
}

/* *******************************************************************
 * CREER (ENREGISTRE) UNE NOUVELLE INSTANCE CATEGORIE 
 * *******************************************************************/
async function createNewCategorie(ctg_name, ctg_type, addCategorieDOMObject) {  
    /* ---- Variable crsf_token ---- */
    const csrf_token = document.querySelector('input[name="ctg_csrf_token"]').value;

    /* ---- Attente de la reponse du serveur ---- */
    feedback(null, null, addCategorieDOMObject);

    /* ---- Envoie la requete http au serveur ---- */
    await axios.post('/admin/categorie/register', { 
        _token: csrf_token,
        ctg_name: ctg_name,
        ctg_type: ctg_type, 
    }).then((response) => {
        // Au moment ou le serveur repond avec message de success
        feedback(response.data, null, addCategorieDOMObject);
    })
    .catch((error) => {
        // Au moment ou le serveur repond avec message d' erreur
        feedback(null, error, addCategorieDOMObject);
        console.log(error);
    });
}


/* ************************************************************
 * LORSQUE LE CONTENU DU DOM EST CHARGE
 * ***********************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- Variables DOM ---- */
    const feedback       = document.querySelector('div[id="add_categorie_feedback"]');
    const spinner_icon   = document.querySelector('i[id="add_categorie_spinner_icon"]');
    const submit_icon    = document.querySelector('i[id="add_categorie_submit_icon"]');
    const submit_button  = document.querySelector('button[id="add_categorie_submit_button"]');
    const ctg_name_input = document.querySelector('input[name="ctg_name"]');
    const ctg_type_input = document.querySelector('input[name="ctg_type"]');

    /* ---- Regroupement d' une partie des variables DOM au sein de seul object ---- */
    const addCategorieDOMObject = {
        feedback, spinner_icon, submit_icon, submit_button, ctg_name_input, ctg_type_input 
    }

    /* ---- Click sur le button submit ---- */
    submit_button.onclick = function() {
        createNewCategorie(ctg_name_input.value, ctg_type_input.value, addCategorieDOMObject);     
    }
});