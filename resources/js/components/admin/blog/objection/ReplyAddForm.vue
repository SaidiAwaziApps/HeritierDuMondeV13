<template>
    <div class="global-content">
        <form @submit.prevent="register" method="POST" enctype="multipart/form-data" class="objection-form">
            <div class="form-content">
                <div class="inputs-content">
                    <div class="form-group">
                        <textarea name="texte" id="reply_texte" cols="30" rows="1" class="form-control" v-model="texte" placeholder="Taper votre reponse a ce commentaire ici ..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reply-files">
                            <i class="fas fa-paperclip"></i>
                            <i class="reply-uploaded-files-length">
                                <sup v-if="fichiers && fichiers.length > 0">
                                    {{ fichiers.length }} 
                                </sup>
                            </i>
                        </label>
                        <input @change="onFilesChange" type="file" name="fichiers[]" id="reply-files" class="reply-files" multiple style="display: none;">
                    </div>                     
                 </div>
                <div class="submit-bloc">
                    <div class="d-grid">
                        <button :disabled="submitDisabled" type="submit" class="btn btn-primary btn-sm btn-block" id="reply_submit_button">
                            <span>
                                <i class="fa fa-spinner fa-spin" style="color: white;" v-if="loading.active"></i>
                                <i class="fa fa-paper-plane" v-if="!loading.active"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- fin form-content -->

            <!-- Toast affichant la bar de progression -->
            <UploadProgressToastComponent :progress="progressPerFile"/>            
        </form>
    </div>
</template>

<style scoped>
    form.objection-form {
        width: 100%;
    }

    form.objection-form > div.form-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
        /* background-color: pink; */
    }


    form.objection-form > div.form-content > div.inputs-content {
        width: 94%;
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
        padding: 17px 4px 16px 10px;
        background-color: #f8f8ff;
        border-radius: 4px;
        border-radius: 26px;
        /* margin-left: -6%; */
    }

    @media all and (max-width: 500px) {
        form.objection-form > div.form-content > div.inputs-content {
            padding: 15px 4px 15px 10px;
        }
    }

    /* @media all and (max-width: 500px) {
        form.objection-form > div.form-content > div.inputs-content {
            margin-left: -10%; 
        }
    } */

    form.objection-form > div.form-content > div.submit-bloc {
        width: 7%;
        margin-top: 4px;
        padding: 18px 4px 4px 4px;
    }

    @media all and (max-width: 500px) {
        form.objection-form > div.form-content > div.submit-bloc {
            margin-right: 10px;
        }
    }

    form.objection-form > div.form-content > div.submit-bloc > .d-grid button {
        /* padding: 4px 8px 4px 8px; */
        border-radius: 6px;
        background-color: #1A73E8;
    }

    form.objection-form > div.form-content > div.submit-bloc > .d-grid button span {
        color: white;
    }


    form.objection-form > div.form-content > div.submit-bloc > .d-grid button:hover {
        opacity: 0.6;
    }

    form.objection-form > div.form-content > div.submit-bloc > .d-grid button span i[class="fa fa-spinner"] {
        display: none; 
    }

    form.objection-form > div.form-content > div.inputs-content > div.form-group:nth-child(1) {
        width: 93%;
    }

    form.objection-form > div.form-content > div.inputs-content > div.form-group:nth-child(1) textarea {
        border-radius: 28px;
        border: 2px solid white;
        border: 1px solid #ccc;
    }

    form.objection-form > div.form-content > div.inputs-content > div.form-group:nth-child(2) {
        width: 6%;
        padding-top: 8px;
    }  


    label[for="reply-files"] .reply-uploaded-files-length {
        font-size: 18px;
        font-weight: bold;
        font-family: italic;
        color: cadetblue;
        margin-left: 2px;
    }

    label[for="reply-files"]:hover {
        opacity: 0.6;
        cursor: pointer;
    }
</style>

<script>

    import UploadProgressToastComponent from '../../../global/UploadProgressToastComponent.vue';

    import RegisterReplyService from '../../../../services/admin/blog/objection/register';

    export default {
        name: 'ReplyAddForm',
        props: ['commentaire'],
        components: {
            UploadProgressToastComponent
        },
        watch: {
            commentaire: function(value) {
                if(value){
                    this.feedback.active = false;
                    this.loading.active = false;
                    this.texte = '';
                    this.fichiers = null;    
                }
            }
        },
        data: function(){
            return {
                feedback: {
                    active: false,
                    title: 'Commentaire',
                    response: null,
                    error: null
                },
                loading: {
                    active: false
                },
                submitDisabled: false,
                texte: '',
                fichiers: [],
                progressPerFile: null
            }
        },
        methods: {
            onFilesChange: function(e) {
                const registerReplyService = new RegisterReplyService(this);
                registerReplyService.onFilesChange(e); 
            },
            register: function() {
                const registerReplyService = new RegisterReplyService(this);
                registerReplyService.save();
            }       
        }
    }
</script>