import axios from "axios";

import { toast } from "vue3-toastify";

import useExpediteurStore from "../../../../store/contact/expediteur";

class RegisterMessageService {
    constructor(refComp) {
        this.refComponent = refComp;
        this.st
    }

    /*******
     * METHODE APPELEE AU 
     * MOMENT DE CHARGEMENT DE FICHIERS
     *  ****/
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
     * METHODE ILLUSTRANT L' ENSEMBLE DES EVENEMENT
     * SE PRODUISANT ENTRE LA REQUETTmii eE ET LA REPONSE
     *  *****/
    feedback(response,error) {
        //Desactive le loading(spinner)
        setTimeout(() => {
            this.refComponent.loading.active = false;
            this.refComponent.submitDisabled = false;
        },2000);

        // Active le ToastFeedback
        setTimeout(() => {
            if (response?.data?.errors) {
                var errorsMessage='';
                for (key in response.data.errors) {
                    for (error in response.data.errors[key]) {
                        errorsMessage += ' && '+response.data.errors[key];
                    }
                }
                toast.error(errorsMessage);
            } 
            else if (response) {
                toast.success('Message envoye !!!');
            } else {
                toast.error(error?.response ? 'Echec d\' envoie du message  !!!' : 'Echec de connection au serveur !!!');
            }
        },2600);

        // Renitialize le donnees du component && emet l'evenement registered
        setTimeout(() => { 
            if (response?.data?.message) {
                // Initialization de donnee etat (state)
                this.refComponent.uploadedFilesCount = 0;
                this.refComponent.texte = '';
                this.refComponent.fichiers = null;
                // emet evenement registered au composant parent
                this.refComponent.$emit('registered', {
                    message: response.data.message 
                });
            } 
        },6000)
    }



    /********
     * METHODE DE FORMATAGE DE DONNEES A
     * TRANSETTRE AU SERVEUR
     *  *****/
    dataFormat() {
        // Store (Expediteur store)
        const store = useExpediteurStore();

        // Instancie l'object FormData
        const formData = new FormData();

        // Construit les donnees (expediteur devient le destinateur du fait l' expediteur c est l' utilisateur connecte)
        formData.append('destinateur', JSON.stringify(store.current));
        formData.append('texte', this.refComponent.texte);

        // Ajouter chaque image individuellement
        if (this.refComponent?.fichiers && this.refComponent?.fichiers?.length > 0) {
            Array.from(this.refComponent.fichiers).forEach((file) => {
                formData.append('fichiers[]', file); // Nom de champ avec []
            });
        }

        //Renvoie l'object
        return formData;
    }


    
    /*******
     * METHODE FAISANT APPEL A L' API 
     * POUR ENREGISTREMENT
     *  *****/
    async save() {
        // Attente de la reponse du serveur
        this.refComponent.loading.active = true;

        // Desactive le button submit
        this.refComponent.submitDisabled = true;

        // Appel a l'API
        await axios.post('/message/save', this.dataFormat()).then((response) => {
            this.feedback(response,null);
            console.log(response);
        })
        .catch((error) => {  
            this.feedback(null,error);
            console.log(error.response); 
        });

        // Ecoutes evenement ContactMessageEvent
        window.Echo.channel('message').listen('contact-message', function(message) {
            alert(message.texte);
        });
    }

}

export default RegisterMessageService;