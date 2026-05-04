<template>
    <div class="global-content">
        <form @submit.prevent="register" id="comment_form" method="POST" enctype="multipart/form-data"  class="comment-form">
            <div class="form-content">
                <div class="inputs-content">
                    <div class="form-group">
                        <textarea name="texte" id="comment_texte" cols="30" rows="1" class="form-control" v-model="texte" placeholder="Taper votre commentaire ici ..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fichiers">
                            <i class="fas fa-paperclip"></i>
                            <i class="comment-uploaded-files-length">
                                <sup v-if="fichiers && fichiers.length > 0">
                                    {{ fichiers.length  }}
                                </sup>
                            </i>
                        </label>
                        <input @change="onFilesChange" type="file" accept="image/*,video/*" name="fichiers[]" id="fichiers" multiple style="display: none;">
                    </div>                     
                </div>
                <div class="submit-bloc">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" id="comment_submit_button" :disabled="loading.active">
                            <span>
                                 <i class="fa fa-spinner fa-spin" style="color: white;" v-if="loading.active"></i>
                                <i class="fa fa-paper-plane" v-if="!loading.active"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Toast affichant la bar de progression -->
            <UploadProgressToastComponent :progress="progressPerFile"/>
        </form>
    </div>
</template>

<style scoped>

    form.comment-form > div.form-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap; 
    }

    @media all and (max-width: 500px) {
        form.comment-form > div.form-content {
            padding-right: 6px;
        } 
    }


    form.comment-form > div.form-content > div.inputs-content {
        width: 95%;
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
        padding: 12px 10px 4px 16px;
        background-color: #f8f8ff;
        border-radius: 26px; 
    }

    @media all and (max-width: 500px) {
        form.comment-form > div.form-content > div.inputs-content {
            padding: 12px 10px 4px 10px;
        } 
    }

    form.comment-form > div.form-content > div.submit-bloc {
        width: 4%;
        margin-top: 4px;
        padding: 14px 4px 14px 4px;
    }

    form.comment-form > div.form-content > div.submit-bloc > .d-grid button {
        padding: 4px 8px 4px 8px;
        border-radius: 6px;
        background-color: #1A73E8;
    }

    form.comment-form > div.form-content > div.submit-bloc > .d-grid button span {
        color: white;
    }

    form.comment-form > div.form-content > div.submit-bloc > .d-grid button span i[class="fa fa-spinner"] {
        display: none; 
    }

    form.comment-form > div.form-content > div.inputs-content > div.form-group:nth-child(1) {
        width: 96%;
    }

    form.comment-form > div.form-content > div.inputs-content > div.form-group:nth-child(1) textarea {
        border-radius: 28px;
        /* border: 2px solid white; */
        border: 1px solid #ccc;
    }

    form.comment-form > div.form-content > div.inputs-content > div.form-group:nth-child(2) {
        width: 3%;
        padding-top: 8px;
    }




    @media all and (min-width: 600px) {
        div#comment_images_content span {
            float: right;
        } 
    }


    label[for="fichiers"]:hover {
        opacity: 0.6;
        cursor: pointer;
    }

    label[for="fichiers"] i.comment-uploaded-files-length {
        font-size: 18px;
        font-weight: bold;
        font-family: italic;
        color: cadetblue;
        opacity: 0.8;
        margin-left: 4px;
    }
</style>

<script>

    import UploadProgressToastComponent from '../../../global/UploadProgressToastComponent.vue';

    import RegisterCommentService from '../../../../services/blog/admin/commentaire/register';

    import Swal from 'sweetalert2';
    
    export default {
        name: 'NewComment',
        props: ['article'],
        components: {
            UploadProgressToastComponent           
        },
        created: function() {
            window.Echo.private('App.Models.User.'+window.user.id)
                       .notification((notification) => {
                            setTimeout(() => {
                                Swal.fire({
                                    title: 'Moderation de commentaire',
                                    text: notification.message,
                                    icon: notification.status.toLowerCase() == 'success' ? 'success' : 'warning',
                                    background: '#222', 
                                    color: 'white',   
                                    showConfirmButton: false,      
                                    // confirmButtonColor: '#41b883', 
                                    cancelButtonColor: '#ff5555',
                                    position: 'center',         
                                    showCancelButton: true,
                                    // confirmButtonText: 'OK',
                                    cancelButtonText: 'Cancel'
                                });
                                //Emission evenement notify
                                // if(notification?.moderateable?.commentable_type) {
                                    this.$emit('notify', { notification });
                                // }
                            },5000);          
                       });
        },
        data: function() {
            return {
                loading: {
                    active: false
                },
                texte: '',
                fichiers: null,
                progressPerFile : null,
            }
        },
        methods: {
            onFilesChange: function(e) {
                const registerCommentService = new RegisterCommentService(this);
                registerCommentService.onFilesChange(e);
            },
            register: function() {
                const registerCommentService = new RegisterCommentService(this);
                registerCommentService.save();
            }
        }
    }
</script>