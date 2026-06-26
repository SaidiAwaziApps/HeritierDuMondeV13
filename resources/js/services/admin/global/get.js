
class GetGlobalService {

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

export default GetGlobalService;