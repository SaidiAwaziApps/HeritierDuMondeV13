<template>
    <div class="global-content">
        <div class="content-item" v-if="file">
            <!-- Cas image photo -->
            <a :href="storage_path_url+'/'+file.path" :title="file.path" v-if="getFileType(file.path).toLowerCase()  == 'photo'">
                <img :src="storage_path_url+'/'+file.path" :alt="file.path" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
            </a>

            <!-- Cas image video  -->
            <video class="rounded-thumbnail cover" :alt="file.path" style="width: 100%;height: 100%;" controls v-if="getFileType(file.path).toLowerCase()  == 'video'">
                <source :src="storage_path_url+'/'+file.path">
            </video>

            <!-- Cas de fichier audio -->
            <audio v-if="getFileType(file.path).toLowerCase() == 'audio'" controls style="width: 100%;height: 100%;">
                <source :src="storage_path_url+'/'+file.path">
            </audio>

            <!-- Cas autre format de fichier -->
            <a  v-if="getFileType(file.path).toLowerCase() == 'other'" :href="storage_path_url+'/'+file.path" target="_blank">
                <img :src="app_url+'/image/other_file_format.jfif'" alt="Message File" style="width: 100%;height: 100%;" class="rounded-thumbnail cover">
            </a> 
        </div>
    </div>
</template>


<style scoped>

    div.global-content {
        width: 100%;
        height: 100%;
    }

    div.content-item {
        width: 100%;
        height: 100%;
    }

    img, video {
        border-radius: 4px;
    }
    
</style>


<script>
    
    import GetGlobalService from '../../../../services/admin/global/get';

    export default {
        name: 'FileItem',
        props: ['file'],
        data: function() {
            return {
                app_url: window.APP_URL,
                storage_path_url: window.STORAGE_PATH_URL 
            }
        },
        methods: {
            getFileType: function(path) {
                return GetGlobalService.getFileType(path);
            }
        }
    }
</script>