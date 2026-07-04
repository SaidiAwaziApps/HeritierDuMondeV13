import axios from "axios";

import { toast } from "vue3-toastify";

class RegisterReplyService {
    constructor(refComp) {
        this.refComponent = refComp;
    }

    /* *********************************************************
     * METHODE APPELEE AU MOMENT DE CHARGEMENT DE FICHIERS
     * *********************************************************/
    onFilesChange(e) {
        const files = Array.from(e.target.files);
        if (!files.length) return;

        // Calcul taille totale
        const totalSize = files.reduce((acc, file) => acc + file.size, 0);
        const MAX_FILE_SIZE = 6 * 1024 * 1024;

        if (totalSize > MAX_FILE_SIZE) {
            toast.error('Fichier trop volumineux !!!');
            return;
        }

        this.refComponent.submitDisabled = true;

        // Suivi de la progression de chaque fichier
        let loadedPerFile = new Array(files.length).fill(0);
        let totalLoaded = 0;

        // Initialise le toast
        this.refComponent.progressPerFile = {
            totalSize,
            loaded: {
                size: 0,
                file: 'Initialisation...'
            }
        };

        files.forEach((file, index) => {
            const reader = new FileReader();

            reader.onprogress = (event) => {
                if (!event.lengthComputable) return;

                loadedPerFile[index] = event.loaded;
                totalLoaded = loadedPerFile.reduce((a, b) => a + b, 0);

                // Met à jour le toast
                this.refComponent.progressPerFile = {
                    totalSize,
                    loaded: {
                        size: totalLoaded,
                        file: file.name
                    }
                };
            };

            reader.onloadend = () => {
                loadedPerFile[index] = file.size;

                const allFinished = loadedPerFile.every(
                    (val, i) => val === files[i].size
                );

                if (allFinished) {
                    // Les fichiers sont tous prêts
                    this.refComponent.fichiers = e.target.files;
                    
                    // Laisse le toast 1 seconde puis le cache
                    setTimeout(() => {
                        this.refComponent.progressPerFile = null;
                        this.refComponent.submitDisabled = false;
                    }, 1000);
                }
            };

            reader.readAsArrayBuffer(file); // Pour calculer la progression
        });
    }

    /******
     * Methode illustrant ensembles 
     * evenements entre la requette et la reponse 
     *  *****/
    feedback(response,error) {
        // Desactive le loading(spinner)
        setTimeout(() => {
            this.refComponent.loading.active = false;
            this.refComponent.submitDisabled = false;
        },2000);

        //Active le ToastFeedback
        setTimeout(() => {
            if(response?.data?.errors) {
                var errorsMessage = '';
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

        // Renitialize le donnees du component && emet l'evenement registered
        setTimeout(() => { 
            if (response?.data?.objection) {
                this.refComponent.texte = '';
                this.refComponent.fichiers = null;
                // Emet l' evemenenemt registered au composant parent 
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
        // Instancie l'object FormData
        var formData = new FormData();

        // Construit les donnees
        formData.append('_method','PUT');
        formData.append('texte',this.refComponent.texte);

        // Ajouter chaque image individuellement
        if (this.refComponent.fichiers && this.refComponent.fichiers.length > 0) {
            Array.from(this.refComponent.fichiers).forEach((file) => {
                formData.append('fichiers[]', file); // Nom de champ avec []
            });
        }

        // Renvoie l'object
        return formData;
    }


    /*******
     * Execute l'appel a l'API register
     *  *****/
    save() {
        // Attente de la reponse du serveur
        this.refComponent.loading.active =true;
        this.refComponent.loading.task = 'register';

        // Desactive le button submit
        this.refComponent.submitDisabled = true;

        // Appel a l'API
        axios.post('/admin/commentaire/'+this.refComponent.commentaire.id+'/add-objection',this.dataFormat()).then((response)=>{
            this.feedback(response,null);
            console.log(response);
        })
        .catch((error)=>{
            this.feedback(null,error);
            console.log(error.response); 
        });
    }

}

export default RegisterReplyService;