<template>
    <div class="global-component">
        <!-- Header -->
        <div class="header">
            <div class="header-title-container">
                <h5>
                    <i class="fa fa-envelope"></i> Boite de messageries 
                    <i v-if="getNotReadMessages()?.length > 0"> {{ getNotReadMessages()?.length }} </i>
                </h5>
            </div>
            <div class="header-search-container" v-if="formattedMessages && formattedMessages.length > 0">
                <input
                    @input="search"
                    type="search"
                    class="form-control"
                    v-model="keyword"
                    placeholder="Rechercher contact"
                >
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="founded-items" v-if="formattedMessages && formattedMessages.length > 0">
                <div v-for="data in formattedMessages" :key="data._id">
                    <div class="content-item" @click="navigateToMessageList(data.expediteur)">
                        <AuthMessageGroupItemComponent :data="data" />
                    </div>
                </div>
            </div>
            <div v-if="!formattedMessages || formattedMessages.length === 0" class="not-found-items">
                <span>Aucun message trouvé !!!</span>
            </div>
        </div>
    </div>
</template>

<style scoped>
    /* --- Header --- */
   .header {
        display: flex;
        justify-content: space-around;
        flex-wrap: nowrap;  
    }

    @media all and (max-width: 800px) {
       .header {
            justify-content: space-between;
        }
    }

    @media all and (max-width: 500px) {
        .header {
            display: block;
        } 

        .header .header-title-container {
            display: none;
        }
    }

    .header .header-title-container h5 {
        font-style: italic;
    }

    .header-title-container h5 i:nth-child(1) {
        font-size: 20px;
        opacity: 0.5;
    }

    .header-title-container h5 i:nth-child(2) {
        padding: 6px 10px;
        border-radius: 14px;
        background-color: cadetblue;
        color: white;
        opacity: 0.6;
        font-size: 18px;
    }

    /* --- Content --- */
    .content {
        padding: 0 40px;
    }

    @media all and (max-width: 900px) {
        .content {
            margin-top: 10px;
            padding: 0 10px;
        }
    }

    @media all and (max-width: 500px) {
        .content {
            margin-top: 20px;
        }
    }

    /* --- Items --- */
    .founded-items {
        display: flex;
        flex-direction: column;
    }

    .content-item {
        margin-bottom: 4px;
        padding: 0; /* Comme dans le premier code */
    }

    .content-item:hover {
        padding: 0 2px;
        cursor: pointer;
        border-radius: 4px;
        background-color: #f8f8ff;
    }

    /* --- Router link adaptation --- */
    .router-link-no-style {
        text-decoration: none;   /* supprime le soulignement */
        color: inherit;          /* garde la couleur du texte */
        display: block;          /* prend toute la largeur et permet le hover */
    }

    /* --- Not found message --- */
    .not-found-items {
        text-align: center;
        margin-top: 8px;
    }

    .not-found-items span {
        font-size: 18px;
        font-style: italic;
        opacity: 0.8;
    }
</style>


<script>
    import AuthMessageGroupItemComponent from '../../../components/contact/admin/AuthMessageGroupItemComponent.vue';

    import GetMessageService from '../../../services/contact/admin/message/get';

    import useExpediteurStore from '../../../store/contact/expediteur';
    import useMessageStore from '../../../store/contact/message';
  
    export default {
        name: 'AuthMessageGroupView',
        components: { AuthMessageGroupItemComponent },
        created: function() {
            // Utilisation du store(pinia) useMessageStore
            const store = useMessageStore();
            store.setItems(window.messages);
            this.messages = store.items; 
        },
        data: function() {
            return {
                messages: [],
                keyword: ''
            };
        },
        computed: {
            formattedMessages: function() {
                return GetMessageService.formatData(this.messages);
            }
        },
        methods: {
            search: function() {
                const keywordLower = this.keyword.trim().toLowerCase();
                if (keywordLower.length > 0) {
                    this.messages = window.messages.filter(item => {
                        const nom = item.expediteur?.auteable.nom?.toLowerCase() || '';
                        const texte = item.texte?.toLowerCase() || '';
                        return nom.includes(keywordLower) || texte.includes(keywordLower);
                    });
                } else {
                    this.messages = window.messages;
                }
            },
            navigateToMessageList: function(expediteur) {
                // On récupère le store useExpediteur Pinia
                const store = useExpediteurStore();

                // On stocke l'objet expediteur dans le store
                store.setCurrent(expediteur);

                // Navigation SPA sans rechargement de page
                this.$router.push({ name: 'AuthMessageListView' });
            },
            getNotReadMessages: function() {
                return this.messages.filter(item => item.readed == false);
            }
        }
    }
</script>

