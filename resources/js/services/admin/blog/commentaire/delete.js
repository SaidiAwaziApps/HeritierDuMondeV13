import axios from "axios";

import { toast } from "vue3-toastify";



class DeleteCommentService {
    constructor(refComp){
        this.refComponent=refComp;
    }

    /*************
     * Evenement entre la requette && la reponse HTTP
     * ***************/
    feedback(response,error) {
        //Desactive le loading(spinner)
        setTimeout(() => {
            this.refComponent.loading.active=false;
        },2000);
        //Interaction avec le serveur
        setTimeout(() => {
            if(response) {
                toast.success('Commentaire supprime !!!');
            } else {
                toast.error(error?.response ? 'Echec de suppression !!!' : 'Echec de connection au serveur !!!');
            }
        },2600); 
        //Renitialize le donnees du component && emet l'evenement registered
        setTimeout(() => { 
            this.refComponent.images=null;
            if(response){
                this.refComponent.$emit('deleted',{
                    commentaire: response.data.commentaire 
                });
            }
        },6000)
    }


    /*******
     * Execute la suppression
     *  *****/
    deleteOne(id) {
        //Attente de la reponse du serveur (active le loader)
        this.refComponent.loading.active=true;
        //Appel a l'API delete-one
        axios.delete('/admin/commentaire/delete-one/'+id).then((response) => {
            this.feedback(response,null);
            console.log(response);
        })
        .catch((error) => {
            this.feedback(null,error);
            console.log(error); 
        });
    } 
}

export default DeleteCommentService;