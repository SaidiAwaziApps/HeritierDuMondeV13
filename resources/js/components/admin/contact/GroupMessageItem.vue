<template>
    <div class="global-component">
        <div class="item-content">
            <img src="" alt="" srcset="" v-if="message.origine.id != user.id">
            <span>
                {{ message.origine.nom+' '+message.origine.prenom }}
            </span> 
            <span>

            </span>
        </div>
    </div>
</template>

<style scoped>

</style>


<script>
    export default {
        name: 'GroupMessageItem',
        props: ['expediteurs'],
        data: function() {
            return {
               user: window.user
            }
        },
        methods: {

        }
    }
</script>