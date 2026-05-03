import axios from 'axios';

import { toast } from "vue3-toastify";

class ModerationService {
    constructor(refComponent) {
       this.refComponent = refComponent;
    }


    /**********
     * Methode illustrant l' ensemble d' interaction
     *  entre la requette && la response
     *  ************/
    feedback(response,error) {
        setTimeout(() => {
            this.refComponent.loading.active = false;
        },2000);

        setTimeout(() => {
            if(response) {
                toast.success(response.data.moderation ? (response.data.moderation.mention.toLowerCase() == 'approved' ? 'Commentaire approuve avec success !!!' : 'Commentaire rejete avec success !!!') : '');
                this.refComponent.$emit('moderate', { moderation: response.data.moderation });
            } else {
                toast.error(error.response ? 'Echec de moderation !!!' : 'Echec de connection au serveur !!!');
                console.log(error.response);
            }
        },3000);
    }


     /******
     * Renvoie l' API define 
     * ******/
    define() {
        return axios.post('/moderation/define',{
           moderateable_type: this?.refComponent?.type,
           moderateable_id: this?.refComponent?.moderateable.id,
           mention: this?.refComponent?.mention
        });
    }

    /******
     * Renvoie l' API update 
     * ******/
    update() {
        return axios.put('/moderation/update/'+this?.refComponent?.moderateable?.moderation?.id,{
            mention: this?.refComponent?.mention         
        });
    }


    /**********
     * Renvoie le choix de l' aPI
     *  *****/
    apiDemo() {
        if(this?.refComponent?.moderateable?.moderation) {
            return this.update(this?.refComponent?.moderateable?.moderation?.id , this?.refComponent?.mention);
        } else {
            return this.define(this?.refComponent?.moderateable_type, this?.refComponent?.moderateable_id, this?.refComponent?.mention);
        }
    }


    /********
     * Methode appliquant la moderation
     *  *******/
    moderate(mention) {
        //Attente de la reponse http du serveur
        this.refComponent.mention = mention;
        this.refComponent.loading.active = true;
        //Appel a l' API pour moderation
        this.apiDemo(mention).then((response) => {
            this.feedback(response,null);
            console.log(response);
        })
        .catch((error) => {
            this.feedback(null,error);
            console.log(error);
        });
    }
}


export default ModerationService;