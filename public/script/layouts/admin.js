/* ******************************************************** 
 * METHODE SERVANT D' AFFICHER OU CACHER UN SIDEBAR
 * ********************************************************/
function toggleSidebar(evenement){
    //Le block sidebar
    const sidebar = document.querySelector('div[id="sidebar"]');

    //Click sur le button collapse
    if(evenement == 'collapse'){
        sidebar.style.display = 'block';
    }
    else {
        sidebar.style.display = 'none';  
    }
}


/* ******************************************************************* 
 * METHODE SERVANT D' AFFICHER OU CACHANT UN SOUS MENU PARAMETRE
 * *******************************************************************/
function toggleParameterSubMenu(parameterMenuLink, parameterSubMenu) {
    // Sous-menu visible
    if(parameterSubMenu.style.display == 'block') {
        parameterMenuLink.querySelectorAll('i')[1].setAttribute('class','fa fa-angle-down');
        parameterSubMenu.style.display = 'none';
    } else {
        parameterMenuLink.querySelectorAll('i')[1].setAttribute('class','fa fa-angle-up');
        parameterSubMenu.style.display = 'block';
    }
}


/* ******************************************************************
 * METHODE QUI AFFICHE LE MESSAGE DE MODERATION DE COMMENTAIRE
 * ******************************************************************/
function modrationMessage(notification) {
    setTimeout(() => {
        Swal.fire({
        title: 'Moderation de commentaire',
        text: notification.message,
        icon: notification.status.toLowerCase() == 'success' ? 'success' : 'warning',
        background: '#222', 
        color: 'white',   
        showConfirmButton: false,      
        // confirmButtonColor: '#41b883', 
        cancelButtonColor: '#ff5555',
        position: 'center',         
        showCancelButton: true,
        // confirmButtonText: 'OK',
        cancelButtonText: 'Cancel'
        });
        // Emission evenement notify
    },2000);
}

/* *****************************************************************
 * AU MOMENT DU CHARGEMENT DU DOM
 * *****************************************************************/
document.addEventListener('DOMContentLoaded',function() {
    /************* Variables DOM ************/
    const collapseButton = document.querySelector('button[id="collapse_button"]');
    const dismissButton = document.querySelector('button[id="dismiss_button"]');
    
    const parameterMenuLink = document.querySelector('a[id="parameter_menu_link"]');
    const parameterSubMenu = document.querySelector('ul[id="parameter_sous_menu"]');

    /******* Cache le sous menu a l' initiale *******/
    parameterSubMenu.style.display = 'none';

    /********** Clique sur le button collapse *********/
    collapseButton.onclick = function(){
        toggleSidebar('collapse');    
    }  

    /********** Clique sur le button dismiss *********/
    dismissButton.onclick = function(){
        toggleSidebar('dismiss');    
    }
    
    /********** Clique sur le lien parametre-menu *********/
    parameterMenuLink.onclick = function(e) {
        e.preventDefault();
        // Appel a la methode function
        toggleParameterSubMenu(parameterMenuLink, parameterSubMenu)
    }

    /********** Ecouteur d'evenement (Pusher) ***********/       
    window.Echo
        .private('App.Models.User.'+window.user.id)
        .notification((notification) => {
            // Notification pour moderation && page different de details pour blog article
            if(notification?.moderateable && window.currentRouteName != 'admin.article.details') {
                modrationMessage(notification); 
            }  
        });
});





