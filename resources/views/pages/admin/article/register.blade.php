<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=initial-scale=1.0">
    <title>Blog</title>

    <style>

        div.card-header span.card-title {
            font-size: 19px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.8;
        }

        div.card-header span.card-title i {
            opacity: 0.5;
        } 

        div.card-header a {
            float: right;
            padding: 4px;
            border-radius: 2px;
            opacity: 0.7;
        }

        div.card-header a:hover {
            opacity: 0.4;
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



        




        /********* Button image *********/
        div#image_bloc #open_button_bloc {
            position: fixed;
            top: 66%;
            left: 50%;
            z-index: 1;
            padding: 4px 8px 4px 8px;
            border: 2px solid #f8f8ff;
            border-radius: 16px;
            transform: scale(1.2);
            cursor: pointer;
        }

        @media all and (max-width: 700px) {
            div#image_bloc #open_button_bloc {
                top: 47%;
                left: 46%;
            }
        }


        /************* Modal image ************/
        div.modal-body > div.card {
            height: 800px;
            word-wrap: auto;
        } 

        div#img_content {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        div#img_content div#img_item {
            width: 24%;
            padding-bottom: 6px;
        }

        @media all and (max-width: 700px) {
            div#img_content {
                display: flex;
                justify-content: flex-start;
                flex-wrap: wrap;
            }
            div#img_content div#img_item {
                width: 49%;
                padding-bottom: 6px;
            }
        }

        div#img_content div#img_item:nth-child(n+1) {
            margin-right: 1%;
        }
        

        div#img_content div#img_item label {
            cursor: pointer;
        }

        div#img_item_content #img_bloc .card .card-body {
            height: 126px;
        }

        div#img_item_content #close_bloc {
            margin-top: -76px;
            text-align: center;
            display: none;
            opacity: 0.3;
        }

        div#img_item_content #close_bloc button {
            transform: scale(1);
            z-index: 1001;
        }


        div#action_image_buttons {
            position: fixed;
            top: 70%;
            left: 46%;
            z-index: 1100;
            width: 20%;
            display: none;
        }

        @media all and (max-width: 700px) {
            div#action_image_buttons {
                top: 56%;
            }
        }

        div#action_image_buttons .progress {
            margin-left: -70%;
            margin-bottom: 18px;
            /* padding-bottom: 14px; */
            border-bottom: 1px solid #ccc;
            opacity: 0.8;
            display: none;
        }

        div#action_image_buttons .progress .progress-bar {
            z-index: 1200;
        }

        /* div#action_image_buttons .progress .progress-bar {
           height: 100%;
           /* width: 100%; */
        /* } */ */

        @media all and (max-width: 600px) {
            div#action_image_buttons .progress {
                margin-left: -30%;
            }
        }

        div#action_image_buttons .btn-group {
            border: 2px solid #f8f8ff;
            border-radius: 8px;
            box-shadow: 5px 1px 15px 15px #f8f8ff;
            opacity: 0.7;
        }


    </style>

</head>
<body>

    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fa fa-blog"></i> Nouvelle Article
                </span>
                <a href="{{ route('article.list') }}" title="Liste d'articles" class="btn btn-default btn-sm active">
                    <i class="fa fa-list"></i>
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('article.save') }}" method="POST" enctype="multipart/form-data">
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
                                                @foreach($categories as $categorie)
                                                <option value="{{$categorie->id}}">
                                                    {{ $categorie->nom }}
                                                </option>
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

                        <div id="content_img_bloc">
                            <!-- Image -->
                            <div id="image_bloc_component">
                                @include('image.component.bloc_module')
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

        <!-- <script type="text/javascript">
            let csrf_token=<?php echo(csrf_token());?>
            alert(csrf_token);
        </script> -->

        <script src="{{ asset('script/image/register.js') }}"></script>

        <script src="{{ asset('script/blog/admin/categorie/create.js') }}"></script>

        <script src="{{ asset('script/blog/admin/article/register.js') }}"></script>

    </div>
    @endsection

</body>
</html>