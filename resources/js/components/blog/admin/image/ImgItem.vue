<template>
    <div class="global-content">
        <div class="content-item">
            <!-- Cas image photo -->
            <a :href="storage_path_url+'/'+image.path" :title="image.path" v-if="!isVideo(image.path)">
                <img :src="storage_path_url+'/'+image.path" :alt="image.path" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
            </a>
            <!-- Cas image video  -->
            <video class="rounded-thumbnail cover" :alt="image.path" style="width: 100%;height: 100%;" controls v-if="isVideo(image.path)">
                <source :src="storage_path_url+'/'+image.path">
            </video>
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
    export default {
        name: 'ImgItem',
        props: ['image'],
        data: function() {
            return {
                storage_path_url: window.STORAGE_PATH_URL 
            }
        },
        methods: {
            isVideo: function(path) {
                const ext = path.split('.').pop().toLowerCase();
                return ['mp4', 'avi', 'flv', 'mpg', 'mpeg', 'wmv', 'vob', 'mov', 'avchd', 'webm'].includes(ext);
            }
        }
    }
</script>