<template>
    <div class="global-component">
        <div class="content">
            <!-- Header -->
            <div class="header">
                <router-link :to="{ name: 'AuthMessageGroupView' }" class="back-link-header">
                    <i class="fa fa-arrow-left"></i>
                </router-link>
                <img 
                    :src="storage_path_url+'/'+expediteur.auteable.photo" 
                    :alt="'Profil '+expediteur.auteable.nom" 
                    class="rounded-circle"
                >
                <span>
                    {{ defineTextContent(
                        (expediteur?.auteable?.nom || '') + ' ' + (expediteur?.auteable?.prenom || '')
                    ) }}
                </span>
            </div>

            <!-- Body -->
            <div class="body" ref="bodyContainer">
                <div class="content-items" v-if="messages && messages.length > 0">
                    <div
                        class="msg-item"
                        :class="message.expediteur.auteable_type === 'App\\Models\\Guest'
                        ? 'msg-left'
                        : 'msg-right'"
                        v-for="message in messages"
                        :key="message.id"
                    >
                        <MessageItemComponent :message="message" />
                    </div>
                </div>
            </div> 

            <!-- Footer -->
            <div class="footer" >
                <NewMessageComponent @registered="onRegistered"/>
            </div>

        </div>
    </div>
</template>

<style scoped>
    .header {  
        padding: 6px 0px 6px 6px;
        border: 2px solid #f8f8ff;  
        /* box-shadow: 0px 2px 4px #f8f8ff; */
    }

    .header .back-link-header {
        margin-top: 6px; 
    }

    .header img {
        width: 40px;
        height: 40px;
        margin: 0px 10px 0px 10px;
    }

    .header span {
        font-size: 20px;
        font-weight: bold;
        font-family: italic;
        opacity: 0.7;
    }


    .body {
        height: 340px;
        overflow-y: scroll;
    }

    @media all and (max-width: 500px) {
        .body {
            height: 560px;
        }
    }

    .body .content-items {
        flex: nowrap;
        width: 100%;
        padding: 6px 4px 10px 4px;
    }
    
    .content-items .msg-item {
        width: 52%;
        margin-bottom: 6px;
        margin-bottom: 10px;
    }

    @media all and (max-width: 500px) {
        .content-items .msg-item {
            width: 64%;
        }   
    }


    /* Message reçu */ 
    .msg-left {
        margin-right: auto;
    }

    /* Message envoyé */
    .msg-right {
        margin-left: auto;
    }


    .footer {
        padding-top: 4px;
        border-top: 1px solid #c8c8c8;
        box-shadow: 4px 4px 4px #f8f8ff;
    }

</style>


<script>

import MessageItemComponent from '../../../components/admin/contact/MessageItemComponent.vue';
import NewMessageComponent from '../../../components/admin/contact/NewMessageComponent.vue';

import UpdateMessageService from '../../../services/admin/contact/message/update';

import useExpediteurStore from '../../../store/admin/contact/expediteur';
import useMessageStore from '../../../store/admin/contact/message';

export default {
    name: 'AuthMessageListView',
    components: {
        MessageItemComponent,
        NewMessageComponent
    },
    created: function() {
        // utilisation du store(pinia) useExpediteurStore
        const expediteurStore = useExpediteurStore();
        this.expediteur = expediteurStore.current;

        if (this.expediteur) {
            // utilisation du store(pinia) useMessageStore
            const messageStore = useMessageStore();

            // Filtrer les messages
            this.messages = messageStore.items.filter(item => {
                return (item.expediteur.id == this.expediteur.id && item.destinateurs.filter(item => item.auteable.id == window.user.id)) ||
                       (item.destinateurs.filter(item => item.auteable.id == this.expediteur.id))   
                }
            );

            // Scroller vers le bas en cas d existances des messages
            if(this.messages && this.messages.length > 0) {
                this.scrollToBottom();
            }


            // Appel a la methode setAuthReadedGroupMessage
            if(this.messages?.find(item => item.readed == false)) {
                this.setAuthReadedGroupMessage();
            }
        }
    },
    data: function() {
        return {
            storage_path_url: window.STORAGE_PATH_URL,
            messages: [],
            texte: [],
            expediteur: null
        }
    },
    methods: {
        scrollToBottom() {
            this.$nextTick(() => {
                const container = this.$refs.bodyContainer;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        },
        defineTextContent(texte) {
            if (!texte) return ''; // sécurité : vide si texte null/undefined

            const width = window.innerWidth;

            if (width >= 800) {
                return texte.length > 30 ? texte.slice(0, 30) + ' ...' : texte;
            } else if (width >= 400) {
                return texte.length > 18 ? texte.slice(0, 18) + ' ...' : texte;
            } else {
                return texte.length > 12 ? texte.slice(0, 12) + ' ...' : texte;
            }
        },
        onRegistered: function(event) {
            // Mets a jour les message && store
            this.messages.push(event.message);

            // utilisation du store(pinia) useMessageStore
            const store = useMessageStore();

            const items = store.items.slice(); 
            items.push(event.message);

            store.setItems(items);
        },
        setAuthReadedGroupMessage: function() {
            // Utilisation du service
            const updateMessageService = new UpdateMessageService(this);
            updateMessageService.setAuthReadedGroupMessage(true);
        }
       
    }
}
</script>
