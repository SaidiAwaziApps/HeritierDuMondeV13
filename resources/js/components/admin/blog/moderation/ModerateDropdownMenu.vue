<template>
    <ul class="dropdown-menu" id="moderateDropdownMenu" v-if="moderateable">
        <li class="dropdown-item">
            <span>
                <i class="fa fa-list"></i> Options <i class="fa fa-angle-down"></i>
            </span>    
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item">
            <button @click.prevent="moderate('approved')" type="button" :style="moderateable.moderation ? (moderateable.moderation.mention.toLowerCase() == 'approved' ? { 'background-color': 'cadetblue','color': 'white','cursor': 'not-allowed' } : {}) : {}" href="#" class="btn btn-default btn-sm" :title="popoverObject.title" data-bs-toggle="popover" :data-bs-content="popoverObject.dataContent.approuver" :disabled="moderateable?.moderation?.mention?.toLowerCase() == 'approved'" data-bs-trigger="hover focus">
                <span>
                    <i class="fa fa-check-circle" v-if="loading.active != true || mention.toLowerCase() != 'approved'"></i> <i class="spinner-border spinner-border-sm" v-if="loading.active && mention == 'approved'"></i> Approuver
                </span>
            </button>
        </li>
        <li class="dropdown-divider" v-if="!moderateable.moderation"></li>
        <li class="dropdown-item"  v-if="!moderateable.moderation">
            <button :style="[!moderateable.moderation ? { 'background-color': 'cadetblue', 'color': 'white','cursor': 'not-allowed' } : { }]" href="#" class="btn btn-default btn-sm" :title="popoverObject.title" data-bs-toggle="popover" :data-bs-content="popoverObject.dataContent.attente" data-bs-trigger="hover focus" disabled>
                <span>
                    <i class="fas fa-sync"></i> En attente
                </span>
            </button>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item">
            <button @click.prevent="moderate('rejected')" type="button" :style="moderateable.moderation ? (moderateable.moderation.mention.toLowerCase() == 'rejected' ? { 'background-color': 'cadetblue','color': 'white','cursor': 'not-allowed' } : {}) : {}" href="#" class="btn btn-default btn-sm" :title="popoverObject.title" data-bs-toggle="popover" :data-bs-content="popoverObject.dataContent.rejeter" data-bs-trigger="hover focus" :disabled="moderateable?.moderation?.mention?.toLowerCase() =='rejected'">
                <span>
                    <i class="fa fa-times-circle" v-if="loading.active != true || mention.toLowerCase() != 'rejected'"></i> <i class="spinner-border spinner-border-sm" v-if="loading.active && mention == 'rejected' "></i> Rejeter
                </span>
            </button>
        </li>
    </ul> 
</template>


<style scoped>
    ul li:hover {
        background-color: white;
    }

    ul li button {
        display: block;
        width: 140px;
        border: 1px solid #ccc;
        text-align: left;
    }

    ul li button:hover {
        /* transform: scale(1.1);  */
        background-color: cadetblue;
        color: white;
    }

    ul li span,
    ul li button span {
        font-size: 18px;
        font-family: italic;
    }

    ul li:nth-child(1) span {
        font-weight: bold;
    }

    ul li button span i {
        color: white;
    }

    ul li:nth-child(1) span i {
        opacity: 0.6;
    }

    ul li:nth-child(1) {
        text-align: center;
        opacity: 0.6;
    }

    ul li:nth-child(2n+3) span i {
        opacity: 0.8;
    }


    ul li:nth-child(3) button span i {
        color: green;
    }

    ul li:nth-child(5) button span i {
       color: #C82909;
    }

    ul li:nth-child(7) button span i { 
       color: red;
    }
</style>


<script>

    import ModerationService from '../../../../services/admin/blog/moderation/moderate.js';

    export default {
        name: 'ModerateDropdownMenu',
        props: ['moderateable','type'],
        mounted: function() {
            document.querySelectorAll('ul[id="moderateDropdownMenu"] li button').forEach((item) => {
                item.addEventListener('click', function (event) {
                    // Empêche le comportement par défaut
                    event.preventDefault();
                    // Empêche la fermeture automatique du dropdown
                    event.stopPropagation();
                });
            });
        },
        data: function() {
            return {
                loading: {
                   active: false
                },
                popoverObject: { 
                    title: "<h6 style='text-align: center;'>"+
                                "<i class='fa fa-cogs' style='opacity: 0.6;'></i> Moderation de commentaire"
                            +"</h6>",
                    dataContent: {
                        approuver: "<span> <i class='fa fa-check-circle' style='color: green;'></i> Appuyer pour approuver </span>" ,
                        attente: "<span> <i class='fas fa-sync' style='color: #C82909;'></i> Appuyer pour mise en attente</span>",
                        rejeter: "<span> <i class='fa fa-times-circle' style='color: red;'></i> Appuyer pour rejeter   </span>"
                    }       
                },
                mention: ''
            }
        },
        methods: {
            moderate: function(mention) {
                const moderationService = new ModerationService(this);
                moderationService.moderate(mention);
            }   
        }
    }
</script>