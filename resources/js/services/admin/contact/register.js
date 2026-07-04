import axios from "axios";

import { toast } from "vue3-toastify";

class RegisterMessageService {
    constructor(refComp) {
        this.refComponent=refComp;
    }

    /*******
     * METHODE APPELEE AU 
     * MOMENT DE CHARGEMENT DE FICHIERS
     *  ****/
    onFilesChange (e) {

        this.refComponent.refTemplate.uploadedFilesLength.style.opacity='0';
        this.refComponent.refTemplate.uploadedFilesLength.innerHTML='0';

        let totalSize = 0;
        let totalLoaded = 0;

        const fileArray = Array.from(e.target.files);
        fileArray.forEach(file => totalSize += file.size);

        const MAX_FILE_SIZE = 2 * 1024 * 1024;
        
        if(totalSize < MAX_FILE_SIZE)
        {
            if (totalSize >= 1000) {

                this.refComponent.refTemplate.submitButton.disabled = true;
                this.refComponent.refTemplate.filesContainer.style.display = 'none';
                this.refComponent.refTemplate.progressContainer.style.display = 'flex';

                let loadedPerFile = new Array(fileArray.length).fill(0); // Pour suivre chaque fichier

                fileArray.forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onprogress = (e) => {
                        if (e.lengthComputable) {
                            // Met à jour la progression de ce fichier
                            loadedPerFile[index] = e.loaded;

                            // Total chargé = somme des chargements de tous les fichiers
                            totalLoaded = loadedPerFile.reduce((a, b) => a + b, 0);

                            // Calcul du pourcentage total
                            const percent = Math.round((totalLoaded * 100) / totalSize);
                            this.refComponent.refTemplate.progressBar.style.width = percent + '%';
                            this.refComponent.refTemplate.progressBar.innerText = percent + '%';
                        }
                    };

                    reader.onloadend = () => {
                        // Vérifie si tous les fichiers sont lus
                        if (loadedPerFile.every((val, i) => val === fileArray[i].size)) {

                            this.refComponent.fichiers = e.target.files;

                            setTimeout(() => {
                                this.refComponent.refTemplate.submitButton.disabled=false;
                                this.refComponent.refTemplate.filesContainer.style.display='flex';
                                this.refComponent.refTemplate.filesContainer.style.justifyContent='center';
                                this.refComponent.refTemplate.progressContainer.style.display = 'none';
                                this.refComponent.refTemplate.progressBar.style.width = '0%';
                                this.refComponent.refTemplate.progressBar.innerText = '';
                            }, 4000);

                            setTimeout(() => {
                                this.refComponent.refTemplate.filesContainer.style.display='none';
                                this.refComponent.refTemplate.uploadedFilesLength.style.opacity='1';
                                this.refComponent.refTemplate.uploadedFilesLength.style.color='cadetblue';
                                this.refComponent.refTemplate.uploadedFilesLength.innerHTML='<sup>'+fileArray.length+'</sup>'
                            },8000);

                            
                        }
                    };

                    reader.readAsDataURL(file);
                });

            } else {
                this.refComponent.fichiers = e.target.files;
            }
        }
        else {
            toast.error('Fichier trop volumineux !!!');
        }

    }


    /******
     * METHODE ILLUSTRANT L' ENSEMBLE DES EVENEMENT
     * SE PRODUISANT ENTRE LA REQUETTE ET LA REPONSE
     *  *****/
    feedback(response,error) {
        //Desactive le loading(spinner)
        setTimeout(() => {
            this.refComponent.loading.active = false;
            this.refComponent.refTemplate.replySubmitButton.disabled = false;
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
            if(response?.data?.message){
                this.refComponent.refTemplate.uploadedFilesLength.innerHTML = '';
                this.refComponent.texte = '';
                this.refComponent.fichiers = null;
                this.refComponent.$emit('registered',{
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
        //Instancie l'object FormData
        var formData = new FormData();

        //Construit les donnees
        formData.append('texte', this.refComponent.texte);

        // Ajouter chaque image individuellement
        if (this.refComponent?.fichiers && this.refComponent?.fichiers?.length > 0) {
            Array.from(this.refComponent.fichiers).forEach((file) => {
                formData.append('images[]', file); // Nom de champ avec []
            });
        }

        //Renvoie l'object
        return formData;
    }


    /*******
     * METHODE FAISANT APPEL A L' API 
     * POUR ENREGISTREMENT
     *  *****/
    save() {
        //Attente de la reponse du serveur
        this.refComponent.loading.active = true;

        //Desactive le button submit
        this.refComponent.refTemplate.submitButton.disabled = true;

        //Appel a l'API
        axios.post('/admin/message/register', this.dataFormat()).then((response)=>{
            this.feedback(response,null);
            console.log(response);
        })
        .catch((error)=>{
            this.feedback(null,response);
            console.log(error.response); 
        });
    }

}

export default RegisterMessageService;