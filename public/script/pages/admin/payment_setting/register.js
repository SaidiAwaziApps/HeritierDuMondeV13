
/*****************************************************************
 * AU MOMENT DU CHARGEMENT DU DOM 
 * ***************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    // Variables input, button, items (DOM)
    const currencyInput = document.querySelector('input[name="currency"]');
    const currencyButton = document.querySelector('button[id="currency_button"]');
    const currencyItems = document.querySelectorAll('li[class="dropdown-item currency-item"]');

    // Parcourt des items
    currencyItems.forEach(item => {
        item.onclick = function(e) {
            const oldValue = currencyInput.value;
            const newValue = e.currentTarget.innerText;
            
            // Index le l' element clique
            const index = Array.from(currencyItems).findIndex(item => item == e.currentTarget);

            // Permutation des valeurs
            currencyItems[index].innerText = oldValue;
            currencyInput.value = newValue;

            // Mise a jour de texte du button clique 
            currencyButton.querySelector('span').innerHTML = newValue;  
                  
        }  
    });
});