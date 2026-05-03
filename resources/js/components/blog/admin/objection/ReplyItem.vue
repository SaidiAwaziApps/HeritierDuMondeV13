<template>
    <div class="global-content" v-if="objection">
        <div class="reply-item" style="display: block;">
            <div class="reply-item-header">
                <a :href="storage_path_url+'/'+objection.auteur.auteable.photo" :title="objection.auteur.auteable.photo">
                    <img :src="storage_path_url+'/'+objection.auteur.auteable.photo" class="rounded-circle" /> 
                    <span>
                        {{ formatTextAuteur(window.innerWidth > 1000 ? objection.auteur.auteable.nom+' '+objection.auteur.auteable.prenom : objection.auteur.auteable.nom) }}
                    </span>   
                    <span :style="[objection?.moderation ? (objection.moderation?.mention.toLowerCase() == 'approved' ? { 'padding': '4px 8px 5px 8px','border-radius': '4px','background-color': 'green','color': 'white' } : {  'padding': '4px 8px 5px 8px','border-radius': '4px','background-color': 'pink','color': 'white'  }) : { 'padding': '4px 8px 5px 8px','border-radius': '4px','background-color': '#ccc','color': 'white' }]">
                        {{ objection?.moderation ? (objection.moderation?.mention?.toLowerCase() == 'approved' ? 'A' : 'R') : 'A' }}
                    </span>
                </a>

                <!-- Actions -->
                <div class="action-buttons">
                   <!-- Dropdown -->
                   <div class="dropdown">
                        <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="sr-only"></span>
                        </button>

                        <!-- Dropdown menu -->
                        <ModerateDropdownMenu @moderate="onModerate" :moderateable="objection" type="objection"/>
                    </div>

                    <div class="delete-button">
                        <button @click="deleteOne" type="button" class="btn btn-danger btn-sm">
                            <span>
                                <i class="fa fa-trash" v-if="!loading.active && (loading.task==null || loading.task=='delete')"></i>
                                <i class="fa fa-spinner fa-spin" v-if="loading.active && (loading.task==null || loading.task=='delete')"></i>
                            </span>
                        </button>
                    </div>
                </div> 
                <!-- Fin action-buttons -->
            </div> 

            <div class="reply-item-content">
                <div class="text-content">
                    <p>{{ objection.texte }}</p>
                </div>

                <div class="imgs-content" v-if="objection.fichiers">
                    <div class="img-item" v-for="file in objection.fichiers" :key="file.id">
                        <FileItem :file="file" />
                    </div>                  
                </div>
            </div>

            <!-- fin reply-item-content(body)  -->
            <div class="reply-item-footer">
                <span>
                    {{ timeAgo(objection.created_at) }}
                </span>    
            </div>
            <!-- fin reply-item-footer -->   
        </div>
    </div>
</template>

<style scoped>
    div.reply-item {
        padding: 2px;
        border-radius: 4px;
    }

    div.reply-item-header {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
    }

    div.reply-item-header > a {
        font-size: 16px;
        font-weight: bold;
        font-family: italic;
        color: black; 
        text-decoration: none;
        opacity: 0.8;
        padding-bottom: 4px;
    }

    div.reply-item-header > a img {
        width: 30px;
        height: 30px;
    }

    div.reply-item-header > a span {
        margin-left: 5px; 
    }

    div.reply-item-header > a span:nth-child(3) {
        opacity: 0.6;
        cursor: default;
    }

    div.reply-item-header > .action-buttons {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
    }

    div.reply-item-header > .action-buttons > div:nth-child(1) {
        margin-right: 1px;
    }

    div.reply-item-content {
        margin-left: 34px;
        padding-top: 6px;
        border-top: 1px solid #ccc;
    }

    div.reply-item-content > div.text-content p {
        font-size: 18px;
        font-family: italic;
    }

    div.reply-item-content > div.imgs-content {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        padding-bottom: 10px;
    }

    div.reply-item-content > div.imgs-content > div.img-item {
        width: 24%;
        margin-left: 6px;
        margin-bottom: 8px;
    }

    div.reply-item-footer {
        margin: 0px 0px 20px 44px;
        padding: 0px;
    }

    div.reply-item-footer span {
        font-size: 17px;
        font-weight: bold;
        font-family: italic;
        opacity: 0.4;
    }
</style>

<script>

import FileItem from '../fichier/FileItem.vue';
import ModerateDropdownMenu from '../moderation/ModerateDropdownMenu.vue';
import DeleteReplyService from '../../../../services/blog/admin/objection/delete';

import * as bootstrap from 'bootstrap';

import dayjs from 'dayjs';

export default {
    name: 'ReplyItem',
    props: ['objection'],
    components: {
        FileItem,
        ModerateDropdownMenu
    },

    mounted: function() {
        this.$nextTick(() => {
            const dropdown = this.$el.querySelector('.dropdown');

            if (dropdown) {
                const popoverElements = dropdown.querySelectorAll('[data-bs-toggle="popover"]');

                popoverElements.forEach(el => {
                    if (!el._popover) {
                        el._popover = new bootstrap.Popover(el, {
                            trigger: 'hover focus',
                            html: true
                        });
                    }
                });
            }
        });
    },

    data: function() {
        return {
            window: window,
            storage_path_url: window.STORAGE_PATH_URL,
            loading: {
                active: false,
                task: null
            }
        }
    },

    methods: {
        formatTextAuteur: function(defaultStringText) {
            if(window.innerWidth > 1000) {
                return defaultStringText; 
            }
            else if(window.innerWidth <= 800 && window.innerWidth >= 500) {
                return defaultStringText.length >= 20 ? defaultStringText.substring(0,18)+'...' : defaultStringText;
            } 
            else {
                return defaultStringText.length >= 9 ? defaultStringText.substring(0,8)+'...' : defaultStringText;
            } 
        },

        deleteOne: function() {
            const deleteReplyService = new DeleteReplyService(this);
            deleteReplyService.deleteOne(this.objection.id);
        },

        onModerate: function(event) {
            this.$emit('moderate', { moderation: event.moderation });
        },

        timeAgo: function(date) {
            return !date ? '' : dayjs(date).fromNow();
        }
    }
}
</script>