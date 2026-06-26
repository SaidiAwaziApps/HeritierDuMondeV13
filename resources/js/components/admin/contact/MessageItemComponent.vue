<template>
    <div class="global-component">
        <div class="msg-content" v-if="message">
            <div class="text-content">
                <p>
                    {{ message.texte }}
                </p>
            </div>
            <div class="files-content" v-if="message.fichiers && message.fichiers.length > 0">
                <div class="file-item" v-for="fichier in message.fichiers" :key="fichier.id">
                    <!-- Cas de fichier image(photo) -->
                    <a v-if="getFileType(fichier.path).toLowerCase() == 'photo'" :href="storage_path_url+'/'+fichier.path" target="_blank"> 
                        <img :src="storage_path_url+'/'+fichier.path"  style="width: 100%;height: 100%;" class="rounded-thumbnail cover">
                    </a>

                    <!-- Cas de fichier image(video) --> 
                    <video v-if="getFileType(fichier.path).toLowerCase() == 'video'" controls style="width: 100%;height: 100%;" class="rounded-thumbnail cover"> <source :src="storage_path_url+'/'+fichier.path"> </video>
                    
                    <!-- Cas de fichier audio -->
                    <audio v-if="getFileType(fichier.path).toLowerCase() == 'audio'" controls style="width: 100%;height: 100%;"><source :src="storage_path_url+'/'+fichier.path"></audio>

                    <!-- Cas autre format de fichier -->
                    <a  v-if="getFileType(fichier.path).toLowerCase() == 'other'" :href="storage_path_url+'/'+fichier.path" target="_blank">
                        <img :src="app_url+'/image/other_file_format.jfif'" alt="Message File" style="width: 100%;height: 100%;" class="rounded-thumbnail cover">
                    </a> 
                </div>
            </div>
            <div class="others-content">
                <span class="days-moment">
                    {{ timeAgo(message.created_at) }} 
                </span>    
                <span class="user-auth" v-if="message.expediteur.auteable_type == 'App\\Models\\User'">
                    <i class="fa fa-user"></i> {{ message.expediteur.auteable.id == window.user.id ? 'Moi' : message.expediteur.auteable.nom }}
                </span>
            </div>
        </div>
    </div>
</template>



<style scoped>

    .text-content {
        padding: 10px 10px 2px 10px;
        background-color: #f8f8ff;
        border-radius: 6px;
    } 

    .text-content p {
        font-size: 18px;
        font-style: italic;
        word-break: normal;
    }



    .files-content {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        /* width: 80%; */
    }

    @media all and (max-width: 500px) {
        .files-content {
            justify-content: space-between; 
            /* flex-wrap: nowrap; */
            /* width: 90%; */
        }
    }

    @media all and (min-width: 500px) {
        .files-content div {
            width: 24%;
            margin-right: 6px;
        }
    }

    .files-content div {
        height: 80px;
        margin-bottom: 6px;
        border-radius: 4px;
    }

    @media all and (max-width: 500px) {
        .files-content div {
            width: 48%;
        }
    }

    /* .files-content div img, */
    .files-content div video,
    .files-content div audio,
    .files-content div a,
    .files-content div a img {
        width: 100%;
        height: 100%;
    }



    .others-content .days-moment {
        font-family: italic;
        opacity: 0.6;
    }

    .others-content .user-auth {
        margin-left: 12px;
        font-family: italic;
        opacity: 0.6;
    }

    .others-content .user-auth i[class="fa fa-user"] {
        opacity: 0.7;
    }
</style>



<script>
   
    import GetMessageService from '../../../services/admin/contact/message/get';

    import dayjs from 'dayjs';

    export default {
        name: 'MessageItemComponent',
        props: ['message'],
        data: function() {
            return {
                window: window,
                app_url: window.APP_URL,
                storage_path_url: window.STORAGE_PATH_URL        
            }
        },
        methods: {
            getFileType: function(filename) {
                return GetMessageService.getFileType(filename);
            },
            timeAgo: function(date) {
                return !date ? '' : dayjs(date).fromNow();
            }
        }
    } 
</script>