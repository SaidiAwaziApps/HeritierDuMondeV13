<template>
    <div class="global-content" v-if="commentaire">
        <div class="comment-item">
            <div class="comment-item-header">
                <div class="comment-header-meta">
                    <a :href="storage_path_url+'/'+commentaire.auteur.auteable.photo" target="_blank" id="new_objection_auth_comment_link" title="Afficher profil de l'auteur">
                        <img :src="storage_path_url+'/'+commentaire.auteur.auteable.photo" class="rounded-circle" style="width: 40px;height: 40px;">
                        <span>
                            {{ formatTextAuteur(window.innerWidth > 1000 ? commentaire.auteur.auteable.nom+' '+commentaire.auteur.auteable.prenom : commentaire.auteur.auteable.nom) }}
                        </span>   
                    </a>
                    <span :style="[commentaire?.moderation ? (commentaire.moderation?.mention.toLowerCase() == 'approved' ? { 'padding': '4px 8px 5px 8px','border-radius': '4px','background-color': 'green','color': 'white' } : {  'padding': '4px 8px 5px 8px','border-radius': '4px','background-color': 'pink','color': 'white'  }) : { 'padding': '4px 8px 5px 8px','border-radius': '4px','background-color': '#ccc','color': 'white' }]">
                        {{ commentaire?.moderation ? (commentaire.moderation?.mention?.toLowerCase() == 'approved' ? 'A' : 'R') : 'A' }}
                    </span>
                </div>

                <div class="comment-header-actions">
                    <div class="reply-action" v-if="!replyDisabled">
                        <button @click.prevent="attemptReply" type="button" title="Commentaire" data-bs-toggle="popover" data-bs-content="Appuyer pour repondre ou afficher les objections(reponses) au commentaire" data-bs-trigger="hover focus" class="btn btn-primary btn-sm" ref="replyButtonMenu" :disabled="replyDisabled">
                            <span>
                                <i class="fa fa-envelope"></i> 
                            </span>
                        </button>              
                    </div>

                    <div class="dropdown">
                        <button type="button" title="Cliquer pour moderation de commentaire" class="btn btn-warning btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="sr-only"></span>
                        </button>

                        <ModerateDropdownMenu @moderate="onModerate" :moderateable="commentaire" type="commentaire"/>
                    </div>

                    <div class="delete-button">
                        <button @click.prevent="deleteOne" type="button" class="btn btn-danger btn-sm" title="Commentaire" data-bs-toggle="popover" data-bs-content="Appuyer pour supprimer le commentaire" style="opacity: 0.7;">
                            <span>
                                <i class="fa fa-trash" v-if="!loading.active && (loading.task==null || loading.task=='delete')"></i>
                                <i class="fa fa-spinner fa-spin" v-if="loading.active && (loading.task==null || loading.task=='delete')"></i>
                            </span> 
                        </button>
                    </div>
                </div>                               
            </div>

            <div class="comment-item-body" :style="[replyDisabled ? ( window.innerWidth <500 ? { 'margin-left': '26px','padding-left':'22px' } : { 'padding-left': '22px' } ) : { }]">
                <div class="comment-data-content">
                    <div class="text-content">
                        <p>{{ commentaire.texte }}</p>
                    </div>

                    <div class="files-content" v-if="commentaire.fichiers">
                        <div class="file-item" v-for="file in commentaire.fichiers" :key="file.id" :style="[replyDisabled ? ( window.innerWidth > 776 ? { 'width': '20.2%','height': '100px' } : { 'width': '31.6%','height': '100px' } ): { }]">
                            <FileItem :file="file"/>
                        </div>                      
                    </div>
                </div>
            </div>

            <div class="comment-item-footer">
                <ul>
                    <li>
                        {{ timeAgo(commentaire.created_at) }}
                    </li>
                    <li v-if="!replyDisabled">
                        <a @click.prevent="attemptReply" href="#" class="reply-link" title="Commentaire" data-bs-toggle="popover" data-bs-content="Cliquer pour repondre ou afficher les reponses(objections)" data-bs-trigger="hover focus">
                            Reponses({{ commentaire.objections.length }})
                        </a>
                    </li>
                </ul> 
            </div>     
        </div>                                 
    </div>
</template>

<style scoped>

.comment-item {
    margin-bottom: 16px;
} 

.comment-item-header {
    display: flex;
    justify-content: space-between;
    flex-wrap: nowrap;
    padding: 0 0 2px 0;
    margin: 0;
    position: relative;
}

/* Bordure sur tout le bloc sauf sous la photo */
.comment-item-header::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 46px;
    width: calc(100% - 50px);
    height: 1px;
    background-color: #ccc;
}

.comment-item-header > .comment-header-meta {
    width: 78%;
    padding-left: 6px;
}

.comment-item-header > .comment-header-actions {
    display: flex;
    justify-content: flex-end;
    flex-wrap: nowrap;
    width: 20%;
}

.comment-item-header > .comment-header-meta > a,
.comment-item-header > .comment-header-meta > span {
    font-size: 18px;
    font-weight: bold;
    font-family: italic;
}

.comment-item-header > .comment-header-meta a {
    margin-right: 4px;
    text-decoration: none;
    color: black;
    opacity: 0.7;
}

.comment-item-header > .comment-header-meta a:hover {
    opacity: 0.3;
}

.comment-item-header > .comment-header-meta a img {
    width: 40px;
    height: 40px;
    margin-right: 4px;
}

.comment-item-header > .comment-header-meta > span {
    opacity: 0.4;  
    width: 20px;
    height: 20px;
}

.comment-item-header > .comment-header-actions > div:nth-child(n+2) {
    margin-left: 4px;
}

.comment-item .comment-item-body {
    margin-left: 5%;
    padding-top: 15px;
}

@media all and (max-width: 500px) {
    .comment-item .comment-item-body {
        margin: 2px 0px 0px 46px;
        padding-top: 6px;
    } 
}

.comment-item .comment-item-body .comment-data-content .text-content p {
    font-size: 18px;
    font-family: italic;
}

.comment-item .comment-item-body .files-content {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    margin-bottom: 16px;
}

.comment-item .comment-item-body .files-content .file-item {
    width: 12.1%;
    height: 100px;
    margin-right: 4px;
}

@media all and (max-width: 500px) {
    .comment-item .comment-item-body .files-content .file-item {
        width: 31.6%;
    } 
}

.comment-item .comment-item-footer {
    display: block;
    width: 100%;
}

.comment-item .comment-item-footer ul li {
    display: inline-block;
    margin-left: 14px;
    font-size: 17px;
    font-weight: bold;
    font-family: italic;
    opacity: 0.8;
}

.comment-item .comment-item-footer ul li:nth-child(1) {
    opacity: 0.4;
}

.comment-item .comment-item-footer ul li:nth-child(2) a {
    text-decoration: none;
}

.comment-item .comment-item-footer ul li:nth-child(2) a:hover {
    text-decoration: underline;
    opacity: 0.6;
}

</style>

<script>

import FileItem from '../fichier/FileItem.vue';
import ReplyItem from '../objection/ReplyItem.vue';
import ModerateDropdownMenu from '../moderation/ModerateDropdownMenu.vue';
import DeleteCommentService from '../../../../services/blog/admin/commentaire/delete';
import dayjs from 'dayjs';

/* ✅ SEULE CORRECTION */
import * as bootstrap from 'bootstrap';

export default {
    name: 'CommentItem',
    props: ['commentaire','replyDisabled'],
    components: {
        FileItem,
        ReplyItem,
        ModerateDropdownMenu
    },

    mounted: function() {
        const popoverElements = this.$el.querySelectorAll('[data-bs-toggle="popover"]');

        popoverElements.forEach(el => {
            if (!el._popover) {
                el._popover = new bootstrap.Popover(el, {
                    trigger: 'hover',
                    html: true,
                    placement: 'top'
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
            if(window.innerWidth > 1000) return defaultStringText; 
            if(window.innerWidth <= 800 && window.innerWidth >= 500)
                return defaultStringText.length >= 20 ? defaultStringText.substring(0,18)+'...' : defaultStringText;
            return defaultStringText.length >= 9 ? defaultStringText.substring(0,8)+'...' : defaultStringText;
        },
        deleteOne: function(){
            const deleteCommentService = new DeleteCommentService(this);
            deleteCommentService.deleteOne(this.commentaire.id);
        },
        attemptReply: function(){
            this.$emit('attemptReply',{ commentaire: this.commentaire });
        },
        onReplyDeleted: function(event) {
            this.$emit('deleted',{ objection: event.objection });
        },
        onModerate: function(event) {
            this.$emit('moderate',{ moderation: event.moderation });
        },
        timeAgo: function(date) {
            return !date ? '' : dayjs(date).fromNow();
        }
    }
}
</script>