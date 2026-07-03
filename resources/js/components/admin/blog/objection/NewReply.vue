<template>
    <div class="global-content">
        <div class="modal fade" id="new_reply_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal">

                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- card -->
                        <div class="card">
                            <div class="card-body">
                                <!-- new-objection -->
                                <div class="new-objection">
                                    <div class="new-objection-header" v-if="commentaire">
                                        <a :href="'/'+commentaire.auteur.auteable.photo" target="_blank" id="new_objection_auth_comment_link" title="Afficher profil de l'auteur">
                                            <img :href="'/'+commentaire.auteur.auteable.photo"  class="rounded-circle" style="width: 40px;height: 40px;">
                                            <span>
                                                {{ commentaire.auteur.auteable.nom+' '+commentaire.auteur.auteable.prenom }} 
                                            </span>
                                        </a>
                                    </div>
                                    <!-- new-objection-content -->
                                    <div class="new-objection-body">
                                        <div class="comment-content" v-if="commentaire">
                                            <div class="text-content">
                                                <span>
                                                    {{ commentaire.texte  }}
                                                </span>                          
                                            </div>
                                            <div class="imgs-content" v-if="commentaire.fichiers">
                                                <div v-if="commentaire.fichiers.length!=0">
                                                    <div class="img-item" v-for="file in commentaire.fichiers" :key="file.id">
                                                        <FileItem :file="file"/>
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="form-content">
                                            <ReplyAddForm @registered="onRegistered" :commentaire="commentaire"/>
                                        </div> 
                                    </div>
                                    <!-- fin new-objection-content -->
                                </div>
                                <!-- fin new-objection -->
                            </div>
                        </div>
                        <!-- fin card -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm active" data-bs-dismiss="modal">
                            <span style="font-size: 18px;font-family: italic;">
                                Fermer
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    div.new-objection {
        padding: 0px;
        margin: 0px;
    }

    div.new-objection-header {
        padding: 0px 0px 0px 0px;
        margin: 0px;
    }

    div.new-objection-header a {
        font-size: 18px;
        font-weight: bold;
        font-family: italic;
        color: black;
        opacity: 0.7;
        text-decoration: none;
    }

    div.new-objection-header a:hover {
        opacity: 0.3;
    }

    div.new-objection-header a img {
        width: 40px;
        height: 40px;
    }

    div.new-objection-header a span {
        display: inline-block;
        width: 86%;
        padding-bottom: 6px;
        border-bottom: 2px solid #ccc;
        opacity: 0.9;
        color: cadetblue;
        margin-left: 4px;
    }   

    @media all and (max-width: 400px) {
        div.new-objection-header a span {
            display: inline-block;
            width: 82%;
        } 
    }

    div.new-objection-body {
        padding: 0px;
        margin: 0px;
        width: 100%;
        /* background-color: yellow; */
    }


    div.new-objection-body > div {
        width: 100%;
        /* padding: 0px; */
        margin: 0px;
        /* background-color: blue; */
    }

    /* 
    div.new-objection-body > div.comment-body {
        padding-left: 40px;
    } */


    div.new-objection-body > div.comment-content {
        width: 100%;
        padding-top: 4px;
    }

    @media all and (max-width: 540px) {
        div.new-objection-body > div.comment-content {
            padding: 0px 6px 6px 0px;
            padding-top: 11px;
        }
    }

    @media all and (min-width: 540px) {
        div.new-objection-body > div.comment-content {
            margin-left: 18px;
            width: 90%;
        } 
    }


    div.new-objection-body > div.comment-content > div.text-content {
        padding: 4px 4px 4px 18px;
        margin: 10px 0px 10px 0px;
        opacity: 0.8;
        padding-bottom: 4px;
        margin-bottom: 10px;
        border-left: 3px solid black;
    } 

    @media all and (max-width: 900px) {
        div.new-objection-body > div.comment-content > div.text-content {
            padding: 4px 4px 4px 16px;
            margin: 10px 0px 10px 0px;
        } 
    }


    div.new-objection-body > div.comment-content > div.text-content  p {
        font-size: 18px;
        font-family: italic;
        opacity: 0.8;
    }


    div.new-objection-body > div.comment-content > div.imgs-content > div {
        display: flex;
        justify-content: flex-start;
        flex-wrap: nowrap;  
    }

    div.new-objection-body > div.comment-content > div.imgs-content > div > div.img-item {
        width: 24.2%;
        height: 100px;
        margin-right: 4px;
        border-radius: 8px;
    }

    @media all and (max-width: 500px) {
        div.new-objection-body > div.comment-content > div.imgs-content > div > div.img-item {
            width: 31.6%;
        }
    }



    div.new-objection-body > div.form-content {
        padding-top: 8px;
        margin-top: 40px;
        border-top: 1px solid #ccc;
    }


    /* @media all and (min-width: 400px) {
        div.new-objection-body > div.form-content {
            display: flex;
            justify-content: space-around;
        }
    }

    @media all and (min-width: 400px) {
        div.new-objection-body > div.form-content > form {
            width: 84%;
        }
    } */


    /* div.new-objection-body > div.form-content > div.inputs-content > div:nth-child(1) {
        width: 90%;
        background-color: blue; 
    } */
</style>

<script>


    import FileItem from '../fichier/FileItem.vue';
    import ReplyAddForm from './ReplyAddForm.vue';

    import Swal from 'sweetalert2';
    

    export default {
        name: 'NewReply',
        props: ['commentaire'],
        components: {
            FileItem,
            ReplyAddForm,        
        },
        mounted: function() { 
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
                            },2000);          
                        });
        },
        data: function() {
            return {
                auteur: {
                    nom: this.commentaire ? this.commentaire.auteur.auteable.nom : '',
                    prenom: this.commentaire ? this.commentaire.auteur.auteable.prenom : '',
                    photo: this.commentaire ? this.commentaire.auteur.auteable.photo: '',
                }
            }
        },
        methods: {
            onRegistered: function(event){
                this.$emit('registered',{ objection: event.objection });
                console.log(event);
            }
        }
    }
</script>