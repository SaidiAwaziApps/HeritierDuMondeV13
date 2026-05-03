<template>
    <div class="global-content">
        <div class="modal fade" id="reply_list_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                
                            </div>
                        </div> 
                        <!-- Fin Card --> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">
                            <span>
                                Fermer
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ReplyList',
        props: ['commentaire'],
        data: function() {
            return {

            }
        },
        methods: {

        }
    }
</script>