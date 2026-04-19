/* **************************************************************
 * LORSQUE LE DOM EST CHARGE
 * *************************************************************/
document.addEventListener('DOMContentLoaded',function() {
    /* ---- Variables DOM ---- */
    let elements = document.querySelectorAll('input[name="access_ressources[]"]');
    let check_all_input = document.querySelector('input[id="check_all"]');

    /* ---- Parcourt ensembles du tableau access_ressource && elements ---- */
    access_ressources.forEach(access_ressource => {
        elements.forEach(element => {
            if(access_ressource.ressource.id == parseInt(element.value.split(',')[0]) && access_ressource.action==element.value.split(',')[1] && access_ressource.mention.toLowerCase()=='allowed') {
                element.checked = true; 
            }
        });
    });

    /* ---- Au moment du clic sur un des elements inputs ---- */
    check_all_input.onclick = function(e){
        if(e.currentTarget.checked == true){
            elements.forEach(item => {
                item.checked = true;   
            });        
        } else {
            elements.forEach(item => {
                item.checked = false;   
            }); 
        }
    }
});