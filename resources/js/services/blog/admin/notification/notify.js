
import Swal from "sweetalert2";

class NotifyService {

    constructor(refComponent) {
        this.refComponent = refComponent;
    }

    // Demarre (Ecoute) les channels pour notification
    run() {
        window.Echo.private('App.Models.User.'+window.user.id)
                   .notification((notification) => {
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
                                //Emission evenement notify
                                alert(notification?.moderateable?.commentable_type);
                                // if(notification?.moderateable?.commentable_type) {
                                //     this.refComponent.$emit('notify', { notification });
                                // }
                    },5000);          
        });
    }
}

export default NotifyService;