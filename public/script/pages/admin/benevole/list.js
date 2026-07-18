/* ****************************************************************
 * METHODE FAISANT APPEL A L' API && AFFICHE LES RESULTATS
 * ***************************************************************/
async function autocompleteResult(search,suggestions) {
    /* Appel a la methode Http */
    await axios.get('/admin/benevole/search/'+encodeURIComponent(search)+'').then(response => {
        // Initialise le contenu du bloc
        suggestions.innerHTML = "";

        const benevoles = response?.data?.benevoles;

        if (benevoles?.length === 0) {
            suggestions.innerHTML =
                '<div class="no-result">Aucun résultat</div>';
        } else {

            const ul = document.createElement('ul');
            ul.setAttribute('class','list-group');

            benevoles.forEach(benevole => {

                const li = document.createElement("li");

                li.setAttribute('class','list-group-item');

                li.innerHTML = '<a href="/admin/benevole/details/'+benevole.id+'">'+
                                    '<img src="'+window.STORAGE_PATH_URL+'/'+benevole.photo+'" class="rounded-circle">'+
                                    '<span>'+benevole.nom+' '+benevole.prenom+'</span>'
                                +'</a>';             

                ul.appendChild(li);
            });

            suggestions.appendChild(ul);
        }
    })
    .catch(error => {
        suggestions.innerHTML =
                error.response   
                ? '<div class="no-result">Aucun resultat !!!</div>'
                : '<div class="no-result">Echec de connection au serveur !!!</div>'
    });
} 

/* ****************************************************************
 * LORSQUE LE CONTENU DU DOM EST CHARGE
 * ***************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* ---- Variables DOM & timeout ---- */
    const input = document.getElementById("search");
    const suggestions = document.getElementById("suggestions");
    
    let timeout = null;

    input.addEventListener("input", function () {

        clearTimeout(timeout);

        const search = this.value.trim();

        if (search.length < 2) {
            suggestions.style.display = "none";
            suggestions.innerHTML = "";
            return;
        }

        timeout = setTimeout(() => {
            suggestions.style.display = "block";
            autocompleteResult(search, suggestions); 
        }, 300);
    });

    /* ---- Lorsqu'on on clique en dehors du bloc autocomplete ---- */
    document.addEventListener("click", function(e){
        if(!e.target.closest(".autocomplete")){
            suggestions.style.display = "none";  
        }
    });
});


