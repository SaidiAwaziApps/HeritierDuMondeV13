/* *********************************************************************
 * AU MOMENT OU LE DOM EST CHARGE
 * *********************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    // Variables icones
    const imagesIcon = document.querySelector('i[class="fa fa-images"]');
    const globeIcon = document.querySelector('i[class="fa fa-globe"]');

    // Modifie la couleur des icones
    imagesIcon ? imagesIcon.style.color = 'cadetblue' : '';
    globeIcon ? globeIcon.style.color = 'cadetblue' : '';
});