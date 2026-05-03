<template>
    <div class="global-component">
        <form @submit.prevent="register" method="POST" enctype="multipart/form-data" class="message-form">
            <div class="form-content">
                <div class="inputs-content">
                    <div class="form-group">
                        <textarea name="texte" id="message_texte" cols="30" rows="1" class="form-control" v-model="texte" placeholder="Nouveau message ..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fichiers">
                            <i class="fas fa-paperclip"></i>
                            <i class="uploaded-files-length" id="uploaded_files_length" style="color: cadetblue;font-weight: bold;">
                                <sup v-if="fichiers && fichiers.length > 0">
                                    {{ fichiers.length }}
                                </sup>
                            </i>
                        </label>
                        <input @change="onFilesChange" type="file" name="fichiers" id="fichiers" class="fichiers" multiple style="display: none;">
                    </div>                     
                </div>
                <div class="submit-bloc">
                    <div class="d-grid">
                        <button type="submit" :disabled="submitDisabled" class="btn btn-primary btn-sm btn-block" id="submit_button" ref="submitButton">
                            <span>
                                <i class="fa fa-spinner fa-spin" style="color: white;" v-if="loading.active"></i>
                                <i class="fa fa-paper-plane" v-if="!loading.active"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        
        </form>
        <!-- Toast affichant la bar de progression -->
        <UploadProgressToastComponent :progress="progressPerFile"/>
    </div>
</template>    


<style scoped>
    form {
        width: 100%;
    }

    form .form-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
        /* background-color: pink; */
    }


    form .form-content .inputs-content {
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
        form .form-content .inputs-content {
            padding: 15px 4px 15px 10px;
        }
    }


    form .form-content .submit-bloc {
        width: 7%;
        margin-top: 4px;
        padding: 18px 4px 4px 4px;
    }

    @media all and (max-width: 500px) {
        form .form-content .submit-bloc {
            margin-right: 10px;
        }
    }

    form .form-content .submit-bloc .d-grid button {
        /* padding: 4px 8px 4px 8px; */
        border-radius: 6px;
        background-color: #1A73E8;
    }

    form .form-content .submit-bloc .d-grid button span {
        color: white;
    }


    form .form-content .submit-bloc .d-grid button:hover {
        opacity: 0.6;
    }

    form .form-content .submit-bloc .d-grid button span i[class="fa fa-spinner"] {
        display: none; 
    }

    form .form-content .inputs-content .form-group:nth-child(1) {
        width: 93%;
    }

    form .form-content .inputs-content .form-group:nth-child(1) textarea {
        border-radius: 28px;
        border: 2px solid white;
        border: 1px solid #ccc;
    }

    form .form-content .inputs-content .form-group:nth-child(2) {
        width: 6%;
        padding-top: 8px;
    }  

    /* @media all and (min-width: 600px) {
        div#comment_file_content span {
            float: right;
        } 
    } */

    label[for="fichiers"] .uploaded-files-length {
        font-size: 18px;
        font-weight: bold;
        font-family: italic;
        color: cadetblue;
        margin-left: 2px;
    }

    label[for="fichiers"]:hover {
        opacity: 0.6;
        cursor: pointer;
    }
</style>


<script>

    import UploadProgressToastComponent from '../../global/UploadProgressToastComponent.vue';

    import RegisterMessageService from '../../../services/contact/admin/message/register';

    export default {
        name: 'NewMessageComponent',
        components: {
            UploadProgressToastComponent 
        },
        data: function() {
            return {
                loading: {
                    active: false
                },
                submitDisabled: false,
                texte: '',
                fichiers: [],
                progressPerFile : null
            }
        },
        methods: {
            onFilesChange: function(e) {
                const registerMessageService = new RegisterMessageService(this);
                registerMessageService.onFilesChange(e);
            },
            register: function() {
                const registerMessageService = new RegisterMessageService(this);
                registerMessageService.save();
            }
        }
    }
</script>