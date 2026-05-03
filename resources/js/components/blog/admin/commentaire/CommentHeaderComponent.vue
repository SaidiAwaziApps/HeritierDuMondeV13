<template>
    <div class="global-content">
        <div class="comment-header">
            <div class="comment-header-meta">
                <a :href="storage_path_url+'/'+commentaire.auteur.auteable.photo" target="_blank" id="new_objection_auth_comment_link" title="Afficher profil de l'auteur">
                    <img :src="storage_path_url+'/'+commentaire.auteur.auteable.photo"  class="rounded-circle" style="width: 40px;height: 40px;">
                    <span>
                        {{ formatTextAuteur(window.innerWidth > 1000 ? commentaire.auteur.auteable.nom+' '+commentaire.auteur.auteable.prenom : commentaire.auteur.auteable.nom) }}
                    </span>   
                </a>
                <span :style="[commentaire?.moderation ? (commentaire.moderation?.mention.toLowerCase() == 'approved' ? { 'padding': '4px 8px 5px 8px','border-radius': '4px','background-color': 'green','color': 'white' } : {  'padding': '4px 8px 5px 8px','border-radius': '4px','background-color': 'pink','color': 'white'  }) : { 'padding': '4px 8px 5px 8px','border-radius': '4px','background-color': '#ccc','color': 'white' }]">
                    {{ commentaire?.moderation ? (commentaire.moderation?.mention?.toLowerCase() == 'approved' ? 'A' : 'R') : 'A' }}
                </span>
            </div>
            <div class="comment-header-actions">
                <!-- relpy  -->
                <div class="reply-action" v-if="!replyDisabled">
                    <button  @click.prevent="attemptReply" title="Cliquer pour plus d'option" class="btn btn-primary btn-sm" ref="replyButtonMenu" :disabled="replyDisabled">
                        <span>
                            <i class="fa fa-envelope"></i> 
                        </span>
                    </button>              
                </div>

                <!-- Dropdown (moderation) -->
                <div class="dropdown">
                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <span class="sr-only"></span>
                    </button>

                    <!-- Dropdown menu -->
                    <ModerateDropdownMenu @moderate="onModerate" :moderateable="commentaire" type="commentaire"/>
                </div>

                <!-- Delete -->
                <div class="delete-button">
                    <button @click="deleteOne" class="btn btn-danger btn-sm" style="opacity: 0.7;">
                        <span>
                            <i class="fa fa-trash" v-if="!loading.active && (loading.task==null || loading.task=='delete')"></i>
                            <i class="fa fa-spinner fa-spin" v-if="loading.active && (loading.task==null || loading.task=='delete')"></i>
                        </span> 
                    </button>
                </div>
            </div>
        </div>    
    </div>
</template>

<style scoped>

    .comment-header {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
        padding: 0 0 2px 0;
        margin: 0;
        position: relative;
    }

    /* Bordure sur tout le bloc sauf sous la photo */
    .comment-header::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 46px; /* décalage = largeur image (40px) + marge (10px env.) */
        width: calc(100% - 50px);
        height: 1px;
        background-color: #ccc;
    }

    .comment-header > .comment-header-meta {
        width: 78%;
        padding-left: 6px;
    }

    .comment-header > .comment-header-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: nowrap;
        width: 20%;
    }

    .comment-header > .comment-header-meta > a,
    .comment-header > .comment-header-meta > span {
        font-size: 18px;
        font-weight: bold;
        font-family: italic;
    }

    .comment-header > .comment-header-meta a {
        margin-right: 4px;
        text-decoration: none;
        color: black;
        opacity: 0.7;
    } 

    .comment-header > .comment-header-meta a:hover {
        opacity: 0.3;
    }

    .comment-header > .comment-header-meta a img {
        width: 40px;
        height: 40px;
        margin-right: 4px;
    }

    .comment-header > .comment-header-meta > span {
        opacity: 0.4;  
        width: 20px;
        height: 20px;
    } 

    .comment-header > .comment-header-actions > div:nth-child(n+2) {
        margin-left: 4px;
    }

</style>

<script>

    import ModerateDropdownMenu from '../moderation/ModerateDropdownMenu.vue';
    import DeleteCommentService from '../../../../services/blog/admin/commentaire/delete';

    // ✅ SEUL CHANGEMENT ICI
    import * as bootstrap from 'bootstrap';

    export default {
        name: 'CommentHeaderComponent',
        props: ['commentaire','replyDisabled'],
        components: {
            ModerateDropdownMenu            
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
            deleteOne: function(){
                const deleteCommentService=new DeleteCommentService(this);
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
            }
        }
    }

</script>