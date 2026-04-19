/* **************************************************************
 * LORSQUE LE DOM EST CHARGE
 * *************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /******** VARIABLES DOM ********/
    const check_all_input = document.querySelector('input[id="check_all"]');
    const elements = document.querySelectorAll('input[name="access_ressources[]"]');

    /******* EN CAS DE CLICK SUR LA CASE ******/
    check_all_input.onclick = function(){    
        if(this.checked == true){
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

