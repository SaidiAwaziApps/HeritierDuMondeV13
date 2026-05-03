<template>
  <div class="global-content" v-if="article">
    <div class="comments">
      <div class="comments-header">
        <h4 class="comments-title">
          <span>
            Commentaires <i>({{ commentaires ? commentaires.length : '0' }})</i>
          </span>
        </h4>
      </div>

      <div class="comments-body">
        <div class="add-comment">
          <NewComment @registered="onCommentRegistered" @notify="onNotify" :article="article" />
        </div>

        <div class="all-comments" v-if="commentaires?.length > 0">
          <div class="all-comments-content">
            <div
              class="comment-item"
              v-for="commentaire in commentPaginate.data"
              :key="commentaire.id"
            >
              <CommentItem 
                @attemptReply = "onAttemptReply"
                @deleted = "onCommentDeleted"
                @moderate = "onModerate"
                :commentaire = "commentaire"
                :replyDisabled = "false"
              />
            </div>
          </div>

          <div class="all-comments-link" v-if="commentaires.length > 3">
            <a
              @click.prevent="toggleAllItems"
              href="#"
              title="Cliquer pour afficher les commentaires"
              class="all-comments-link"
            >
              <span>
                {{ commentPaginate.showAllItems
                  ? 'Moins de commentaires'
                  : 'Tous les commentaires' }}
                <i class="fa fa-angle-down"></i>
              </span>
            </a>
          </div>
        </div>

        <div class="loading" v-if="loading.active">
          <span>Chargement ...</span>
        </div>
      </div>
    </div>

    <div class="new-reply-container">
      <CommentReply @moderate="onModerate" @registered="onReplyRegistered" @deleted="onReplyDeleted" :commentaire="dataToProps" />
    </div>
  </div>
</template>

<style scoped>
    div.comments {
        margin-top: 20px;
    }

    div.comments-header h4 span {
        /* font-size: 20px; */
        font-weight: bold;
        font-family: italic;
    }

    div.comments-header h4 span i {
        opacity: 0.8;
    }

    div.loading {
        text-align: center;
        padding: 6px;
        margin-top: 4px;
        background-color: #f8f8f8;
        border-radius: 4px;
    }

    div.loading span {
        font-size: 18px;
        font-weight: bold;
        font-family: italic;
        opacity: 0.8;
    }

    div.all-comments {
        margin-top: 14px;
        padding-top: 6px;
        border-top: 2px solid #f8f8ff;
    }

    div.all-comments-content {
        margin: 10px 0px 0px 6px;
    }

    div.all-comments-link {
        margin-top: 10px;
    }

    @media all and (min-width: 960px) {
        div.all-comments-link {
            margin-left: 52px;
        }
    }

    div.all-comments-link a {
        display: block;
        text-align: center;
        padding: 6px;
        border: 3px solid #f8f8ff;
        text-decoration: none;
        color: cadetblue;
    }

    div.all-comments-link a:hover {
        opacity: 0.8;
        /* border: 1px solid #ccc; */
        border: 2px solid #ccc; 
    }

    div.all-comments-link a span {
        font-size: 18px;
        font-weight: bold;
        font-family: italic;
    }

    div.all-comments-content .comment-item {
      margin-bottom: 20px;
    }

    div.toast-container {
        position: fixed;
        top: 60px;
        left: 80%;
        z-index: 2000;
    }
</style>

<script>
    import NewComment from './NewComment.vue';
    import CommentItem from './CommentItem.vue';
    import CommentReply from './CommentReply.vue';
    import GetCommentService from '../../../../services/blog/admin/commentaire/get';

    import { toast } from 'vue3-toastify';

    // ✅ CORRECTION UNIQUE ICI
    import * as bootstrap from 'bootstrap';
 
    export default {
      name: 'CommentHub',
      props: ['article'],
      components: {
        NewComment,
        CommentItem,
        CommentReply,
      },
      data: function() {
        return {
          loading: {
            active: false,
          },
          commentPaginate: {
            showAllItems: false,
            data: [],
          },
          dataToProps: null,
          commentaires: [],
        };
      },
      created: function() {
        if (this.article?.commentaires?.length > 0) {
          this.commentPaginate.data = [...this.article.commentaires].reverse().slice(0, 3);
        }
        this.getAll();
      },
      methods: {
        onAttemptReply: function(event) {
          this.dataToProps = event.commentaire;
          const modal = new bootstrap.Modal(document.getElementById('comment_reply_modal'));
          modal.show();
        },
        onReplyRegistered: function(event) {
          const index = this.commentaires.findIndex(item => item.id == event.objection.objectable_id);
          if (index !== -1) {
            const commentItem = this.commentaires[index];
            const updatedComment = {
              ...commentItem,
              objections: [...commentItem.objections, event.objection]
            };
            this.commentaires.splice(index, 1, updatedComment);
          }
        },
        onReplyDeleted: function(event) {
          const { commentaireId, objectionId } = event;

          const index = this.commentaires.findIndex(item => item.id === commentaireId);
          if (index !== -1) {
            const commentItem = this.commentaires[index];
            const updatedObjections = commentItem.objections.filter(ob => ob.id !== objectionId);

            const updatedComment = {
              ...commentItem,
              objections: updatedObjections
            };

            this.commentaires.splice(index, 1, updatedComment);
          }
        },
        onCommentRegistered: function(event) {
          this.commentaires.push(event.commentaire);
          this.commentPaginate.data = [...this.commentaires].reverse().slice(0, 3);
        }, 
        onCommentDeleted: function(event) {
          const index = this.commentaires.findIndex(item => item.id==event.commentaire.id);
          this.commentaires.splice(index,1);
          this.commentPaginate.data = [...this.commentaires];
        },
        onModerate: function(event) {
          const updated = event.moderation.moderateable;
          if (!updated) return;

          const index = this.commentaires.findIndex(item => item.id == event.moderation.moderateable.id);
  
          if (index !== -1) {
            this.commentaires.splice(index, 1, {
              ...this.commentaires[index],
               ...updated,
            });

            if (this.commentPaginate.showAllItems) {
              this.commentPaginate.data = [...this.commentaires].reverse();
            } else {
              this.commentPaginate.data = [...this.commentaires].reverse().slice(0, 3);
            }
          }
        },
        onNotify(event) {
          const updated = event.notification?.moderateable;
          if (!updated) return;

          const index = this.commentaires.findIndex(item => item.id === updated.id);
          if (index !== -1) {
            this.commentaires.splice(index, 1, {
              ...this.commentaires[index],
               ...updated,
            });

            if (this.commentPaginate.showAllItems) {
              this.commentPaginate.data = [...this.commentaires].reverse();
            } else {
              this.commentPaginate.data = [...this.commentaires].reverse().slice(0, 3);
            }
          }
        },

        toggleAllItems: function() {
          if (!this.commentPaginate.showAllItems) {
            this.commentPaginate.data = [...this.commentaires].reverse();
            this.commentPaginate.showAllItems = true;
          } else {
            this.commentPaginate.data = [...this.commentaires].reverse().slice(0, 4);
            this.commentPaginate.showAllItems = false;
          }
        },

        getAll: function() {
          this.loading.active = true;
          GetCommentService.getAll(this.article.id).then((response) => {
            setTimeout(() => {
              this.loading.active = false;
              this.commentaires = response.data.commentaires || [];
              this.commentPaginate.data = [...this.commentaires].reverse().slice(0, 3);
            }, 1000);
          })
          .catch((error) => {
            setTimeout(() => {
              this.loading.active = false;
              toast.error(
                error?.response ? 'Échec du chargement des commentaires.' : 'Erreur réseau.'
              );
            }, 1000);
          });
        },
      },
    };
</script>