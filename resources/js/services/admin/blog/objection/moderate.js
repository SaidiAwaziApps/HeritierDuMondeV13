import axios from "axios";

import { toast } from "vue3-toastify";

class RegisterReplyService {
    constructor(refComp) {
        this.refComponent=refComp;
    }

    

    /******
     * Methode illustrant ensembles 
     * evenements entre la requette et la reponse 
     *  *****/
    feedback(response,error) {
        //Desactive le loading(spinner)
        setTimeout(() => {
            this.refComponent.loading.active = false;
            this.refComponent.refTemplate.replyModerateButton.disabled = false;
        },2000);
        //Active le ToastFeedback
        setTimeout(() => {
            if(response?.data?.errors) {
                var errorsMessage='';
                for(key in response.data.errors) {
                    for(error in response.data.errors[key]) {
                        errorsMessage+=' && '+response.data.errors[key];
                    }
                }
                toast.error(errorsMessage);
            } 
            else if(response) {
                toast.success('Reponse(commentaire) ajoute !!!');
            } 
            else {
                toast.error(error?.response ? 'Echec enregistrement !!!' : 'Echec de connection au serveur !!!');
            }
        },2600); 
        //Renitialize le donnees du component && emet l'evenement registered
        setTimeout(() => { 
            if(response?.data?.objection){
                this.refComponent.images=null;
                this.refComponent.$emit('registered',{
                    objection: response.data.objection 
                });
            } 
        },6000)
    }


    /********
     * Methode descrivant le
     * format de donnee de la requette
     *  *****/
    dataFormat() {
        //Instancie l'object FormData
        var formData=new FormData();
        //Construit les donnees
        formData.append('_method','PUT');
        formData.appen('mention',this.refComponent.objection.moderation.mention.toLowerCase()=='approuve' ? 'attente' : 'approuve' );
        //Renvoie l'object
        return formData;
    }


    /*******
     * Execute l'appel a l'API register
     *  *****/
    moderate() {
        //Attente de la reponse du serveur
        this.refComponent.loading.active =true;
        this.refComponent.loading.task = 'register';
        //Desactive le button submit
        this.refComponent.refTemplate.replySubmitButton.disabled=true;
        //Appel a l'API
        axios.post('/objection/'+this.refComponent.objection.id+'/moderate',this.dataFormat()).then((response)=>{
            this.feedback(response,null);
            console.log(response);
        })
        .catch((error)=>{
            this.feedback(null,response);
            console.log(error.response); 
        });
    }

}

export default RegisterReplyService;