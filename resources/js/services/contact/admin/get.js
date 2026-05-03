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
        // Filtre en eliminant les doublons
        expediteurs = [...new Map(messages.map(m => [m.expediteur.id, m.expediteur])).values()];
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
                messages: dataItems.sort((a,b) => b.created_at - a.created_at)       
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

        if (audioExtensions.includes(extension.toLowerCase())) {
            return "audio";
        }

        if (videoExtensions.includes(extension.toLowerCase())) {
            return "video";
        }

        return "other";
    }
}

export default GetMessageService;