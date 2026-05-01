<div class="global-component">
    <div class="modal fade" id="new_objection_modal" role="dialog">
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
                                <div class="new-objection-header">
                                    <a href="#" target="_blank" id="new_objection_auth_comment_link" title="Afficher profil de l'auteur">
                                        <img  class="rounded-circle" style="width: 40px;height: 40px;">
                                        <span>

                                        </span>
                                    </a>
                                </div>
                                <!-- new-objection-content -->
                                <div class="new-objection-body">
                                    <div class="comment-content">
                                        <div class="text-content">

                                        </div>
                                        <div class="imgs-content">

                                        </div>
                                    </div>  
                                    <div class="form-content">
                                        @include('components.blog.admin.objection.add-form')
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