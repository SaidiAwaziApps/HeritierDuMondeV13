<?php
    function isVideo($path) {
        $extension_array=['mp4','MP4','mpeg','MPEG','mpeg-2','MPEG-2','avi','AVI','mov','MOV','wmv','WMV','avi','AVI','avchd','AVCHD','flv','FLV','f4v','F4V','swf','SWF','mkv','MKV','webm','WEBM'];
        if(in_array(pathinfo($path,PATHINFO_EXTENSION),$extension_array)) {
            return true;
        } else {
            return false;
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <style>
        div.card-header span {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.7; 
        }

        div.card-header span i {
            opacity: 0.6;
        }

        div.card-header a {
            float: right;
        }


        div.card-body #infos_content {
            padding: 0px 10px 0px 10px;
        }


        div#header_title h5 {
            text-align: center;
            font-weight: bold;
            font-family: italic;
        }

        div#header_image > div {
            width: 100%;
            height: 200px;
        }


        div#content_bloc {
            padding: 10px 0px 2px 0px;
        }

        div#content_bloc p {
           font-size: 18px;
           font-family: italic;
           text-align: justify;
        }

        div#content_bloc p:nth-child(2) {
            font-size: 16px;
            margin-top: -8px;
            padding: 0px 0px 0px 4px;
        }

        div#content_bloc p:nth-child(2) span {
            opacity: 0.8;
        }

        div#content_bloc p:nth-child(2) span:nth-child(2n+2) {
            font-weight: bold;
        }


        div#media_image_content {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        div#media_image_content > div {
            width: 24%;
            height: 180px;
            margin-right: 0.4%;
            margin-bottom: 6px;
        }

        @media all and (max-width: 500px) {
            div#media_image_content > div {
               width: 100%;
               height: 180px;
               margin-top: 0.6%;
               margin-right: 0%;
            }  
        }






        div.comments {
            margin-top: 20px;
        }

        div.form-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
        }


        div.form-content > div.inputs-content {
            width: 95%;
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
            padding: 6px;
            background-color: #f8f8ff;
            border-radius: 4px;
            border-radius: 26px;
        }

        div.form-content > div.submit-bloc {
            width: 4%;
            margin-top: 4px;
            padding: 4px 4px 4px 4px;
        }

        div.form-content > div.submit-bloc > .d-grid button {
            padding: 4px 8px 4px 8px;
            border-radius: 6px;
            background-color: #1A73E8;
        }

        div.form-content > div.submit-bloc > .d-grid button span {
            color: white;
        }

        div.form-content > div.submit-bloc > .d-grid button span i[class="fa fa-spinner"] {
            display: none; 
        }

        div.form-content > div.inputs-content > div.form-group:nth-child(1) {
            width: 96%;
        }

        div.form-content > div.inputs-content > div.form-group:nth-child(1) textarea {
            border-radius: 28px;
            border: 2px solid white;
            border: 1px solid #ccc;
        }

        div.form-content > div.inputs-content > div.form-group:nth-child(2) {
            width: 3%;
            padding-top: 8px;
        } 

        div#comment_file_content {
            text-align: center;
        } 
        
        @media all and (min-width: 600px) {
            div#comment_file_content span {
               float: right;
            } 
        }


        label[for="comment_file"]:hover {
            opacity: 0.6;
            cursor: pointer;
        }


        div#toast_container {
            display: fixed;
            width: 260px;
            top: 8%;
            right: 0%;
            z-index: 11;
        }

        div.toast-body {
            text-align: center;
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
                    <i class="fa fa-blog"></i> Details sur l'article
                </span>
                <a href="{{ route('article.list') }}" title="Liste d'articles" class="btn btn-default btn-sm active">
                    <i class="fa fa-list"></i>
                </a>
            </div>
            <div class="card-body">
                <div id="infos_content">
                    <div id="header">
                        <div id="header_title">
                            <h5>
                                {{ $article->titre }}
                            </h5>
                        </div>
                        <div id="header_image">
                            @if($article->header_image)
                            <div class="header_image_content">
                                @if(isVideo($article->header_image))
                                <video class="rounded-thumbnail cover" alt="Image Entete" style="width: 100%;height: 100%;" controls>
                                    <source src="{{ Storage::url($article->header_image) }}">
                                </video>
                                @else
                                <a href="{{ Storage::url($article->header_image) }}" title="Afficher image d'entete">
                                    <img src="{{ Storage::url($article->header_image) }}" class="rounded-thumbnail cover" alt="Image" style="width: 100%;height: 100%;">
                                </a>
                                @endif    
                            </div>
                            @endif
                        </div>
                    </div>    
                    <div id="content_bloc">
                        <p>
                            {{ $article->contenu }}
                        </p>
                        <p>
                            <span>
                                <i>Publie le</i>
                            </span>
                            <span>
                                {{ $article->created_at->format('d-m-y') }}
                            </span> 
                            <span>
                                <i>par</i>
                            </span>
                            <span>
                                <i>{{ $article->auteur->morphModel()->nom }}</i>
                            </span>    
                        </p>
                    </div>
                    <!-- fin content_bloc -->
                    <div id="media_images">
                        @if($article->images)
                        <div id="media_image_content">
                            @foreach($article->images as $image)
                            <div id="img_item">
                                @if(isVideo($image->path))
                                <video class="rounded-thumbnail cover" alt="Image media" style="width: 100%;height: 100%;" controls>
                                    <source src="{{ Storage::url($image->path) }}">
                                </video>
                                @else
                                <a href="{{ Storage::url($article->header_image) }}" title="Afficher image d'entete">
                                    <img src="{{ Storage::url($article->header_image) }}" class="rounded-thumbnail cover" alt="Image" style="width: 100%;height: 100%;">
                                </a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <!-- fin media_images -->
                    <div class="comments">
                        <div class="comments-header">
                            <h4 class="comments-title">
                                <span>
                                    Commentaires 
                                    <i class="badge badge-secondary">
                                        {{ count($article->commentaires) }} 
                                    </i>
                                </span>
                            </h4>
                        </div>
                        <!-- comments-body -->
                        <div class="comments-body">
                            <div class="add-comment">
                                <form id="comment_form" method="POST" action="{{ route('commentaire.save') }}" enctype="multipart/form-data">
                                    <div class="form-content">
                                        <div class="comment-csrf-token">
                                            @csrf
                                        </div>
                                        <div class="comment-article-id">
                                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                                        </div>
                                        <div class="inputs-content">
                                            <div class="form-group">
                                                <textarea name="texte" id="comment_texte" cols="30" rows="1" class="form-control" placeholder="Taper votre commentaire ici ..." required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="comment_file">
                                                    <i class="fas fa-paperclip"></i>
                                                </label>
                                                <input type="file" name="fichier" id="comment_file" class="form-control" style="display: none;">
                                            </div>                     
                                        </div>
                                        <div class="submit-bloc">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary btn-sm btn-block" id="comment_submit_button">
                                                    <span>
                                                        <i class="fa fa-spinner"></i>
                                                        <i class="fa fa-paper-plane"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin form-content -->
                                    <div id="comment_file_content">
                                        <span id="comment_file_content_text">

                                        </span>
                                    </div>
                                    <!-- fin comments-file-content --->
                                    <div id="comment_feedback_form">
                                        <span id="comment_feedback_form_text">

                                        </span>
                                    </div>
                                    <!-- fin comments-feedback-form -->
                                </form>
                            </div>
                            <!-- fin add-comments -->
                            <div class="all-comments">
                                @if($article->commentaires)
                                <div class="all-comments-title">
                                    <a href="#">
                                        Tous les commentaires <i class="fa fa-angle-down"></i>
                                    </a>
                                </div>
                                <div class="all-comments-content">
                                    @foreach($article->commentaires as $commentaire)
                                    <div class="comment-item">
                                        <div class="comment-item-header">
                                            <a href="{{ Storage::url($commentaire->auteur->morphModel()->photo) }}">
                                               <img src="{{ Storage::url($commentaire->auteur->morphModel()->photo) }}" alt="" class="rounded-circle"> 
                                               <span>
                                                   {{ $commentaire->auteur->morphModel()->nom }} {{ $commentaire->auteur->morphModel()->prenom }}
                                               </span>   
                                            </a>             
                                        </div>
                                        <div class="comment-item-content">
                                            <div class="comment-data-content">
                                                <p>
                                                    {{ $commentaire->texte }}
                                                </p>
                                                @if($commentaire->fichier)
                                                    <a href="{{ Storage::url($commentaire->fichier) }}" title="Cliquer pour acceder au fichier ou a l'image">
                                                        Joindre fichier/image
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="comment-item-objections">
                                                @foreach($commentaire->objections as $objection)
                                                <div class="objection-item">
                                                    <div class="objection-item-header">
                                                        <a href="{{ Storage::url($objection->auteur->morphModel()->photo) }}">
                                                            <img src="{{ Storage::url($objection->auteur->morphModel()->photo) }}" alt="{{ $objection->auteur->morphModel()->nom.' '.$objection->auteur->morphModel()->prenom }}" class="rounded-circle">
                                                        </a>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="add-comment-objection">
                                                    <form action="#" enctype="multipart/form-data"></form>
                                                </div>
                                            </div>
                                        </div>                                 
                                    </div>
                                    @endforeach
                                    </div>
                                @endif 
                            </div>
                            <!-- fin all-comments -->
                        </div>
                        <!-- comments-body -->
                    </div>
                    <!-- fin comments_bloc -->
                    
                    <!-- Toast Container -->
                    @if($errors->any() || session('success_message'))
                    <div id="toast_container" class="position-fixed p-3">
                        <div id="feedback_toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">
                                    Commentaire
                                </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                <!-- En cas de message su success -->
                                @if(session('success_message'))
                                <div class="success-message" style="text-align: center;">
                                    <span style="font-size: 18px;font-weight: bold;font-family: italic;color: green;opacity: 0.8;">
                                        {{ session('success_message') }} <i class="fa fa-check" style="padding: 4px;border-radius: 10px;background-color: green;color: white;opacity: 0.6;"></i> 
                                    </span>         
                                </div>
                                @endif
                                <!-- En cas d'erreur validation formulaire -->
                                @if($errors->any())
                                <div class="errors">
                                    @foreach($errors->all() as $error)
                                    <div class="error-item" style="text-align: center;">
                                        <span style="font-size: 18px;font-weight: bold;font-family: italic;color: red;">
                                            {{ $error }}          
                                        </span>   
                                    </div>
                                    @endforeach 
                                </div>
                                @endif                    
                            </div>
                        </div>  
                    </div> 
                    @endif
                    <!-- Fin Toast Container --> 
                    
                </div>
            </div>
        </div>


        <!-- Inclus script -->
        <script src="{{ asset('script/commentaire/register.js') }}"></script> 

    </div>
    @endsection

</body>
</html>