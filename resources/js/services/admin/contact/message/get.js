import axios from "axios";

class GetMessageService {

    /* ****************************************
     * RECUPERE UNE INSTANCE DEPUIS LE BACKEND  
     * ****************************************/
    static async getOne(id) {
        return await axios.get('/message/get-one/'+id);
    }


    /* ****************************************
     * RECUPERE PLUSIEURS INSTANCES DEPUIS LE BACKEND  
     * ****************************************/
    static async getAll() {
        return await axios.get('/message/get-all');
    }


    /* ****************************************
     * FORMATE LES DONNEES(DATA) MESSAGES  
     * ****************************************/
    static formatData(messages) {
        // Ensemble des expediteurs;
        let expediteurs = messages.map((item) => item.expediteur);
        // Filtrer que les auteurs(expediteurs) du type visiteur (guest)
        expediteurs = expediteurs.filter(item => item.auteable_type != 'App\\Models\\User');

        // Expediteurs non trouve
        if (!expediteurs || expediteurs.length == 0) {
            return;
        }

        // Filtre en eliminant les doublons
        expediteurs = [...new Map(expediteurs.map(e => [e.id, e])).values()];
        // Initialize te tableau dataObject
        let dataObject = [];
        // Parcourt ensemble des expediteurs
        expediteurs.forEach((expediteur) => {
            let dataItems= [];
            messages.forEach((message) => {
                if((message.expediteur.auteable_id === expediteur.auteable_id) && (message.expediteur.auteable_type === expediteur.auteable_type)) {
                    dataItems.push(message); 
                } 
            });  
            dataObject.push({
                _id: Math.random() + Math.random() + expediteur.id,
                expediteur: expediteur,
                messages: dataItems.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
            });
        });
        
        // Renvoie l' object dataObject
        return dataObject; 
    }


    /* ***********************************************************
     * RENVOIE LE FORMAT (TYPE) DE FICHIER
     * ************************************************************/
    static getFileType(filename) {
        if (!filename || typeof filename !== "string") return "unknown";

        const extension = filename.split('.').pop().toLowerCase();

        const audioExtensions = [
            "mp3", "wav", "flac", "aac", "ogg", "opus", "m4a", "wma",
            "aiff", "alac", "ape", "amr", "mid", "midi"
        ];

        const videoExtensions = [
            "mp4", "mkv", "avi", "mov", "wmv", "flv", "webm",
            "mpeg", "mpg", "m4v", "3gp", "3g2"
        ];

        const photoExtensions = ["jpg","jpeg","png","tiff","tif","heif","heic","avif","webp","raw","dng","cr2","cr3","nef","arw"];


        if (audioExtensions.includes(extension)) {
            return "audio";
        }

        if (videoExtensions.includes(extension)) {
            return "video";
        }

        if (photoExtensions.includes(extension)) {
            return "photo";
        }

        return "other";
    }
}

export default GetMessageService;