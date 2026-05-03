<template>
    <div class="global-content">
        <div class="modal fade" id="comment_reply_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <!-- comment-reply -->
                                <div class="comment-replies" v-if="commentaire">
                                    <div class="comment">
                                        <CommentItem 
                                            @deleted="onCommentDeleted"
                                            @moderate="onModerate"
                                            :commentaire="commentaire"
                                            :replyDisabled="true"
                                        />
                                    </div>

                                    <!-- reply -->
                                    <div class="replies">
                                        <div class="replies-content" v-if="commentaire?.objections?.length > 0">
                                            <div class="reply-body">
                                                <div class="reply-content">
                                                    <div class="reply-items">
                                                        <div v-for="objection in paginate(commentaire).data" :key="objection.id">
                                                            <ReplyItem 
                                                                @moderate="onModerate"
                                                                @deleted="onReplyDeleted"
                                                                :objection="objection"
                                                            />
                                                        </div>
                                                    </div>

                                                    <div class="all-replies-link" v-if="commentaire.objections.length > 5">
                                                        <a 
                                                            @click.prevent="toggleAllItems"
                                                            href="#"
                                                            :title="replyPaginate.showAllItems ? 'Cliquer pour afficher moins de commentaires' : 'Cliquer pour afficher tous les commentaires'"
                                                            class="all-comments-link"
                                                        >
                                                            <span>
                                                                {{ replyPaginate.showAllItems ? 'Moins de reponses' : 'Toutes les reponses' }}
                                                                <i class="fa fa-angle-up" v-if="replyPaginate.showAllItems"></i>
                                                                <i class="fa fa-angle-down" v-if="!replyPaginate.showAllItems"></i>
                                                            </span>    
                                                        </a>
                                                    </div>

                                                </div>     
                                            </div>        
                                        </div>         
                                    </div>
                                    <!-- Fin reply -->  
                                </div>

                                <!-- new reply -->
                                <div class="new-reply">
                                    <ReplyAddForm 
                                        @registered="onReplyRegistered"
                                        :commentaire="commentaire"
                                    />
                                </div>

                            </div>
                        </div> 
                        <!-- Fin Card --> 
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">
                            <span>Fermer</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

div.modal-footer button {
    border: 2px solid #f8f8ff;
}

div.modal-footer button:hover {
    opacity: 0.5;
}

div.modal-footer button span {
    font-size: 18px;
    font-weight: bold;
    font-family: italic;
}

div.comment-replies {
    height: 300px;
    overflow-y: auto;
}

@media all and (max-width: 500px) {
    div.comment-replies {
        height: 400px;
    }
}

div.comment-replies .comment {
    padding: 0px;
    margin: 0px;
}

div.comment-replies .replies {
    margin-top: 10px;
    padding: 2px 20px 0px 24px;
}

@media all and (max-width: 500px) {
    div.comment-replies .replies {
        padding: 2px 4px 0px 0px;
        margin-left: 40px;
    }
}

div.reply-header h6 {
    font-size: 10px;
    font-weight: bold;
    font-family: italic;
    color: cadetblue;
    opacity: 0.6;      
}

div.all-replies-link {
    margin-top: 4px;
    margin-left: 10px;
}

div.all-replies-link a {
    display: block;
    text-align: center;
    padding: 4px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: bold;
    color: cadetblue;
    text-decoration: none;
}

div.all-replies-link a:hover {
    opacity: 0.4;
}

div.replies-content {
    padding: 4px 16px 4px 16px;
}

@media all and (max-width: 500px) {
    div.replies-content {
        padding: 4px 0px 4px 0px;
    }
}

div.new-reply {
    margin-top: 16px;
    margin-left: 1px;
    padding-top: 6px;
    border-top: 2px solid #f8f8ff;
}

@media all and (max-width: 500px) {
    div.new-reply {
        margin-top: 24px;
        margin-left: 24px;
    }
}

</style>

<script>

import CommentItem from './CommentItem.vue';
import ReplyAddForm from '../objection/ReplyAddForm.vue';
import ReplyItem from '../objection/ReplyItem.vue';

/* ✅ SEULE CORRECTION ICI */
import * as bootstrap from 'bootstrap';

export default {
    name: 'CommentReply',
    props: ['commentaire'],
    components: {
        CommentItem,
        ReplyAddForm,
        ReplyItem
    },

    watch: {
        commentaire: {
            immediate: true,
            handler(value) {
                if (value?.objections?.length > 0) {
                    this.paginate(value);
                }
            }
        }
    },

    data() {
        return {
            window: window,
            storage_path_url: window.STORAGE_PATH_URL,
            replyPaginate: {
                showAllItems: false,
                data: []
            }
        };
    },

    methods: {

        formatTextAuteur(defaultStringText) {
            if (window.innerWidth > 1000) {
                return defaultStringText;
            } else if (window.innerWidth <= 800 && window.innerWidth >= 500) {
                return defaultStringText.length >= 20 ? defaultStringText.substring(0,18)+'...' : defaultStringText;
            } else {
                return defaultStringText.length >= 9 ? defaultStringText.substring(0,8)+'...' : defaultStringText;
            }
        },

        paginate(commentaire) {
            const sorted = [...commentaire.objections].sort(
                (a,b) => new Date(b.created_at) - new Date(a.created_at)
            );

            if (this.replyPaginate.showAllItems) {
                this.replyPaginate.data = sorted;
            } else {
                this.replyPaginate.data = sorted.slice(0, 5);
            }

            return this.replyPaginate;
        },

        toggleAllItems() {
            if (!this.replyPaginate.showAllItems) {
                this.replyPaginate.data = [...this.commentaire.objections].reverse();
                this.replyPaginate.showAllItems = true;
            } else {
                this.replyPaginate.data = [...this.commentaire.objections].reverse().slice(0, 4);
                this.replyPaginate.showAllItems = false;
            }
        },

        onReplyRegistered(event) {
            this.commentaire.objections.push(event.objection);
            this.paginate(this.commentaire);
            this.$emit('registered', { objection: event.objection });
        },

        onReplyDeleted(event) {
            const index = this.commentaire.objections
                .findIndex(item => item.id == event.objection.id);

            if (index !== -1) {
                this.commentaire.objections.splice(index, 1);
            }
        },

        onModerate(event) {
            if (event.moderation.moderateable_type.toLowerCase() == 'app\\models\\commentaire') {
                this.$emit('moderate', { moderation: event.moderation });
            } else {
                const updated = event.moderation.moderateable;
                if (!updated) return;

                const index = this.commentaire.objections
                    .findIndex(item => item.id == updated.id);

                if (index !== -1) {
                    this.commentaire.objections.splice(index, 1, {
                        ...this.commentaire.objections[index],
                        ...updated
                    });
                }
            }
        }
    }
};
</script>