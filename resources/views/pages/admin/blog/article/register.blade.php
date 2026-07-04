

    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
             <div class="card-header">
                <span class="card-title">
                    <i class="fa fa-blog"></i> Nouvelle article
                </span>
                <a href="{{ route('admin.article.list') }}" title="Tous les articles" class="btn btn-default btn-sm">
                    <i class="fa fa-list"></i>
                </a>    
            </div>
            <div class="card-body">
                <form action="{{ route('admin.article.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="form_content">
                        <!-- form_input_content -->
                        <div id="form_input_content">
                            <!-- first_input_bloc -->
                            <div id="first_input_bloc">
                                <div id="title_bloc">
                                    <div class="form-group">
                                        <label for="titre">
                                            <i class="fa fa-header"></i> Titre:<i id="required-sign">*</i>
                                        </label>
                                        <input type="text" name="titre" id="titre" class="form-control" placeholder="Entrer le titre" maxlength="100" required>
                                    </div>
                                </div>
                                <div id="contenu_bloc">
                                    <div class="form-group">
                                        <label for="">
                                            <i class="fa fa-text-height"></i> Contenu:
                                            <i id="required-sign">*</i>
                                        </label>
                                        <textarea name="contenu" id="contenu" class="form-control" cols="30" rows="11" placeholder="Entrer le contentu de l'article" required></textarea>
                                    </div>    
                                </div>
                            </div>

                            <!-- second_input_bloc -->
                            <div id="second_input_bloc">
                                <div id="header_bloc">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- <div id="header_bloc_img">
                                                <img src="{{ asset('image/no_image.jpg') }}" alt="Image d'entete" class="rounded-thumbnail cover" style="width: 100%;height:100%;">
                                            </div> -->
                                            <div id="header_input_content">
                                                <div class="form-group">
                                                    <label for="header_image" style="background-image: url('<?php echo(asset('image/no_image.jpg'));?>'); ">
                                                        <span id="header-image-alternative">
                                                            <i class="fa fa-plus"></i> Image entente
                                                        <span>     
                                                    </label>
                                                    <input type="file" name="header_image" id="header_image" style="display: none;">           
                                                </div>     
                                            </div>
                                        </div>
                                    </div>

                                    <div class="progress" id="header_image_progress">
                                        
                                    </div>

                                </div>
                                <div id="categorie_bloc">
                                    @include('components.admin.categorie.all')    
                                </div>
                            </div>
                            <!-- fin second_bloc_input -->
                        </div>
                        <!-- fin form_input_content -->

                        <div id="submit_bloc">
                            <div class="d-grid">
                                <button type="submit" title="Cliquer pour publier l'article" class="btn btn-primary btn-sm btn-block active">
                                    <span>
                                        <i class="fa fa-upload"></i> Publier
                                    </span>
                                </button>
                            </div>
                        </div>


                        <!-- Contenu imaga -->
                        <div class="imgs-bloc">
                            <div class="imgs-bloc-context">
                                @include('components.admin.image.global.context')
                            </div>
                            <div class="imgs-bloc-content">
                                @include('components.admin.image.global.content')
                            </div>
                        </div>


                       <!-- Erreur validation -->
                        <div id="validator_errors_form">
                            @if($errors->any())
                            <div id="validator_errors_content" style="text-align: center;opacity: 0.9;">
                                @foreach($errors->all() as $error)
                                <span style="font-size: 18px;font-weight: bold;font-family: italic;color: red;">
                                    {{ $error }}
                                </span><br>
                                @endforeach
                            </div>
                            @endif
                        </div>

                    </div>
                </form> 
            </div>

        </div>

        <!-- Script interne -->
        <script type="text/javascript">
         
            document.querySelector('form').addEventListener('submit', function () {
                tinymce.triggerSave();
            });

            // Transforme le champ textarea en editeur de texte
            tinymce.init({
                selector: '#contenu',
                height: 300,
                setup: function (editor) {
                    editor.on('change keyup', function () {
                        tinymce.triggerSave();
                    });
                },
                menubar: true,
                // Plugins autorisés (aucun plugin image/media/file)
                plugins: [
                    'anchor', 'autolink', 'charmap', 'codesample',
                    'link', 'lists', 'searchreplace',
                    'table', 'visualblocks', 'wordcount'
                ],
                // Barre d'outils (aucune option file/media/image)
                toolbar: `
                    undo redo |
                    blocks |
                    bold italic underline |
                    alignleft aligncenter alignright alignjustify |
                    bullist numlist |
                    link |
                    table |
                    removeformat `,

                //---------------------------------------------------------
                // 🚫 Interdiction totale d'UPLOAD / FILE PICKER / DRAG & DROP
                //---------------------------------------------------------

                // Bloque le collage d’images (CTRL+V)
                paste_data_images: false,

                // Bloque le drag & drop
                images_upload_handler: () => false,

                // Désactive les file pickers
                file_picker_types: 'none',

                // Empêche tout bouton d’ouvrir le sélecteur de fichiers
                file_picker_callback: () => false,

                // Empêche TinyMCE d’essayer d’uploader quoi que ce soit
                automatic_uploads: false,

                // Désactive l’API interne d'upload
                images_upload_url: null,
                images_reuse_filename: false,

                //---------------------------------------------------------
                // 🚫 Menus TinyMCE (Insert > File) supprimés
                //---------------------------------------------------------

                menu: {
                    insert: { title: 'Insert', items: 'link charmap anchor codesample' }
                        // ❌ pas de 'file | image | media'
                },

                // Desactive le statusBar (footer)
                statusbar: false,

            });
        </script>

        <!-- Script externe uploaded images -->
        <script src="{{ asset('script/components/admin/image/upload/register.js') }}"></script>

        <!-- Script externe platform images (vignettes) -->
        <script src="{{ asset('script/components/admin/image/vignette/register.js') }}"></script>
        
        <!-- Script externe uploaded images -->
        <script src="{{ asset('script/components/admin/categorie/create.js') }}"></script>

        <script src="{{ asset('script/pages/admin/blog/article/register.js') }}"></script>

    </div>
    @endsection

