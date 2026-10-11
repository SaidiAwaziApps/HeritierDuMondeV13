
/* ************************************************************
 * LORSQUE LE DOM EST CHARGE
 * ***********************************************************/

document.addEventListener('DOMContentLoaded', function() {

    /* ---- Variables DOM ---- */
    const animateNeedsContent = document.querySelector('.animate-needs-content');
    const animateNeedsActions = document.querySelector('.animate-needs-actions');
    const humanitarianNeedItemComponents = document.querySelectorAll('.humanitarian-situation-need-item-component');
    const voluntersContentItems = document.querySelectorAll('.volunters-content-item');
    const popoverElements = document.querySelectorAll('[data-bs-toggle="popover"]');

    popoverElements.forEach(function (popoverTriggerEl) {
        new bootstrap.Popover(popoverTriggerEl);
    });

    popoverElements.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
        });
    });

    // Parcourt des elements besoins
    let index = 0;

    animateNeedsContent.style.animation = 'animateNeedsFromBottom 4s ease-in-out infinite';

    animateNeedsActions.style.animation = 'animateNeedsFromTop 4s ease-in-out infinite';

    setInterval(() => {
        
        animateNeedsContent.querySelector('p').querySelector('span').innerHTML = besoins[index].intitule;
        animateNeedsActions.querySelector('a').setAttribute('href','/besoin/'+besoins[index].id);
        
        index = (index + 1) % besoins.length;

    }, 4000)


    // Redimentionne le dernier element se trouvant a une index impair pour le petit ecran
    if(humanitarianNeedItemComponents && humanitarianNeedItemComponents.length % 2 != 0 && window.innerWidth < 600) {
        humanitarianNeedItemComponents[humanitarianNeedItemComponents.length - 1].style.width = '100%';
    }

    
    // Redimentionne le dernier element se trouvant a une index impair pour le petit ecran
    if(voluntersContentItems && voluntersContentItems.length % 2 != 0 && window.innerWidth < 600) {
        voluntersContentItems[voluntersContentItems.length - 1].style.width = '100%';
    }

    
    
    
}); 