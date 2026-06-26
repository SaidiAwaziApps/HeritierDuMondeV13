<template>
    <div class="global-component">
        <div class="data-content">
            <img :src="storage_path_url+'/'+data?.expediteur?.auteable.photo" :alt="data?.expediteur?.auteable.nom" class="rounded-circle">
            <span class="auth-description">
                <b> {{ data?.expediteur.auteable.nom}} </b><br>
            </span>    
            <span class="text-content">
                {{ getTexteContent() }}
            </span>
            <span v-if="data?.messages?.filter(item => item.readed == false)?.length > 0" class="count-content">
                {{ data.messages.filter(item => item.readed == false).length }}
            </span>
        </div>
    </div>
</template>

<style scoped>
    .data-content {
        padding: 0px;
        margin: 0px;
        position: relative; /* nécessaire pour le ::after */
        padding-bottom: 5px; /* espace entre texte et bordure */
    }

    /* créer la bordure après l'image */
    .data-content::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50px; /* largeur de l'image + marge (ajuster selon ton layout) */
        right: 0;
        height: 1px; /* épaisseur de la bordure */
        background-color: #ccc; /* couleur de la bordure */
    }

    .data-content img {
        width: 40px;
        height: 40pxc;
    }

    .data-content span {
        font-size: 17px;
        font-family: italic;        
    }

    .data-content .auth-description {
        margin-left: 6px;
    }

    .data-content .text-content {
        margin-left: 46px;
        text-align: justify;
    }

    .data-content .count-content {
        float: right;
        margin-top: -20px;
        padding: 2px 10px 2px 10px;
        border-radius: 16px;
        background-color: darkgreen;
        color: white;
        opacity: 0.6;
    }
</style>

<script>
import GetMessageService from '../../../services/admin/contact/get';

    export default {
        name: 'AuthMessageGroupItemComponent',
        props: ['data'],
        data: function() {
            return {
                storage_path_url: window.STORAGE_PATH_URL
            }
        },
        methods: {
            getFileType: function(filename) {
                return GetMessageService.getFileType(filename);
            },
            getTexteContent() {
                const message = this.data?.messages?.[0];
                if (!message) return '';

                // TEXTE
                if (message.texte) {
                    const maxLength = window.innerWidth >= 800 ? 64 : 20;
                    return message.texte.length <= maxLength
                                  ? message.texte
                                  : message.texte.slice(0, maxLength) + ' ...';
                }

                // FICHIERS
                const fichiers = message.fichiers || [];

                const videos = fichiers.filter(f => this.getFileType(f.path) === 'video');
                const audios = fichiers.filter(f => this.getFileType(f.path) === 'audio');

                // Vidéo + audio → type dominant
                if (videos.length && audios.length) {
                    return videos.length >= audios.length ? 'vidéo' : 'audio';
                }

                // Un seul type
                if (videos.length) return 'vidéo';
                if (audios.length) return 'audio';

                // Autres fichiers
                return 'fichiers';
            }
        }
    }
</script>