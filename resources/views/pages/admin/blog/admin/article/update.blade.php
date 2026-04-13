<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=initial-scale=1.0">
    <title>Blog</title>

    <link rel="stylesheet" href="{{ asset('css/blog/admin/article/components/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image/global/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image/upload/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image/vignette/style.css') }}">

    <script src="https://cdn.tiny.cloud/1/ee38iugviofz8h4oh6zztci4avjx4mkq8bq6k73l9mru5ej9/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    
    <style>
        div.card-header {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        div.card-header div:nth-child(1) span {
            font-size: 20px;
            font-family: italic;
        }

        div.card-header div:nth-child(1)  span i {
            opacity: 0.6;
        }



        div#form_input_content {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        div#form_input_content > div:nth-child(1) {
            width: 70%;
        }

        div#form_input_content > div:nth-child(2) {
            width: 29%;
        }


        @media all and (max-width: 500px) {
            div#form_input_content {
                display: block;
            }
            div#form_input_content > div:nth-child(1) {
                width: 100%;
            }
            div#form_input_content > div:nth-child(2) {
                width: 100%;
                margin-top: 30px;
            } 
        }

        div#form_input_content > div > div {
            margin-bottom: 12px;
        }


        div#second_input_bloc > div#header_bloc  > .card > .card-body > div:nth-child(1) {
            /* opacity: 0.6; */
            /* z-index: 1; */
            height: 160px;
        }

        div#second_input_bloc > div#header_bloc  > .card > .card-body > div div.form-group {
            width: 100%;
            height: 100%;
        }

        div#second_input_bloc > div#header_bloc  > .card > .card-body > div .form-group label {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            cursor: pointer;
            background-color: #ccc;
            background-image: url('<?php echo(asset('image/no_image.jpg'));?>');
            background-size: cover;
            background-repeat: no-repeat;
        }

        div#second_input_bloc > div#header_bloc  > .card > .card-body > div .form-group label:hover {
            opacity: 0.6;
            transform: scale(1.1);
        }

        div#second_input_bloc > div#header_bloc > .card > .card-body > div .form-group label span {
            font-size: 20px;
            color: white;
        }

        /***** Bar de progresseion **** */
        div#second_input_bloc > div#header_bloc > div.progress {
            margin-top: 6px;
            display: none;
        } 
        /***** **** */
      

        /**** Categorie bloc **** */
        div#second_input_bloc > div#categorie_bloc {
            margin-top: -6px;
        }

        div#second_input_bloc > div#categorie_bloc > div:nth-child(1) > div.form-group label {
            font-size: 16px;
        }

        div#second_input_bloc > div#categorie_bloc > div:nth-child(1) > div.form-group label i {
            opacity: 0.9;
        }

       
        div#second_input_bloc > div#categorie_bloc > div:nth-child(2) {
            text-align: center;
            margin-top: 10px;
        }

        div#second_input_bloc > div#categorie_bloc > div:nth-child(2) a {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
            text-decoration: none;
            color: cadetblue;        
        }

        div#second_input_bloc > div#categorie_bloc > div:nth-child(2) a:hover {
            opacity: 0.5;
        }


        div#second_input_bloc > div#categorie_bloc > div:nth-child(2) > div {
            display: none;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        div#second_input_bloc > div#categorie_bloc > div:nth-child(2) > div > div:nth-child(1) {
            width: 81%;
        }

        div#second_input_bloc > div#categorie_bloc > div:nth-child(2) > div > div:nth-child(2) {
            width: 18%;
        }

        div.toggle_add_categorie_form_content {
            display: flex;
        }


        button[type="button"] span i[id="add_categorie_spinner_icon"] {
            display: none;
        }

        /****************** ************/



        div#submit_bloc {
            width: 70%;
        }

        @media all and (max-width: 500px) {
            div#submit_bloc {
                width: 100%;
            } 
        }

        div#submit_bloc > .d-grid button span {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
        }



        label {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
        }

        label i:nth-child(1) {
            opacity: 0.6;
        }

        label i[id="required-sign"] {
            color: red;
        }



        

        .imgs-bloc > .imgs-bloc-context {
            position: fixed;
            top: 68%;
            left: 50%;
            z-index: 1100;
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
        }

        @media all and (max-width: 500px) {
            .imgs-bloc > .imgs-bloc-context {
                top: 54%;
                left: 46%;
            }
        }



       


    </style>

</head>
<body>

    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-title">
                        <i class="fa fa-blog"></i> Apportez vos modifications
                    </span>
                </div>    
                <!-- Menu deroulant -->
                <div class="dropdown">
                    @include('components.blog.admin.article.menu')
                </div> 
            </div>
            <div class="card-body">
                <form action="{{ route('article.update',['id'=>$article->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                        <input type="text" name="titre" id="titre" class="form-control" placeholder="Entrer le titre" maxlength="100" value="{{ $article->titre }}" required>
                                    </div>
                                </div>
                                <div id="contenu_bloc">
                                    <div class="form-group">
                                        <label for="contenu">
                                            <i class="fa fa-text-height"></i> Contenu:<i id="required-sign">*</i>
                                        </label>
                                        <textarea name="contenu" id="contenu" class="form-control" rows="10" required>{!! $article->contenu !!}</textarea>
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
                                                    <label for="header_image">
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
                                    <div id="add_categorie_select_form">
                                        <div class="form-group">
                                            <label for="categorie_id">
                                                <i>Categorie:</i>
                                                <i id="required-sign">*</i>
                                            </label>
                                            <select name="categorie_id" id="categorie_id" class="form-control" required>
                                                <option value="{{$article->categorie->id}}">
                                                    <!-- Categorie par defaut  -->
                                                    {{ $article->categorie->nom }}
                                                </option>
                                                @foreach($categories as $categorie)
                                                   @if($categorie->id!=$article->categorie->id)
                                                    <option value="{{$categorie->id}}">
                                                       {{ $categorie->nom }}
                                                    </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div style="text-align: center;">
                                        <a href="#" title="Cliquer pour ajouter une categorie" id="add_categorie_link">
                                            <span>
                                               <i class="fa fa-plus"></i> Add categorie
                                            </span>
                                        </a>
                                        <div id="add_categorie_form_content" class="toggle_add_categorie_form_content">
                                            <div class="form-group">
                                                <input type="hidden" name="categorie_csrf_token" value="{{ csrf_token() }}">
                                                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom categorie" maxlength="30">
                                            </div>
                                            <div class="d-grid">
                                                <button type="button" id="add_categorie_submit_button" class="btn btn-primary btn-sm">
                                                    <span>
                                                        <i class="fa fa-spinner" id="add_categorie_spinner_icon"></i> <i class="fa fa-upload" id="add_categorie_submit_icon"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="add_categorie_feedback" style="display: block;">
                                                   
                                        </div>
                                    </div>
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
                                @include('components.image.global.context')
                            </div>
                            <div class="imgs-bloc-content">
                                @include('components.image.global.content')
                            </div>
                        </div>


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

        <script type="text/javascript">
            // Variables (gloabals)
            window.STORAGE_PATH_URL = '<?php echo(env('STORAGE_PATH_URL'));?>';
            let article = <?php echo($article);?>;
            let images = article.images;
            let vignettes = article.vignettes;

            // Transforme le champ textarea en editeur de texte
            tinymce.init({
                selector: '#contenu',
                height: 300,
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


        <script src="{{ asset('script/image/upload/update.js') }}"></script>

        <script src="{{ asset('script/image/vignette/update.js') }}"></script>

        <script src="{{ asset('script/blog/admin/categorie/create.js') }}"></script>

        <script src="{{ asset('script/blog/admin/article/update.js') }}"></script>

    </div>
    @endsection

</body>
</html>