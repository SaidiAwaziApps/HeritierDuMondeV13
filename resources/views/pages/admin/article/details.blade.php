@php
    function isVideo($path) {
        $extension_array = ['mp4','MP4','mpeg','MPEG','mpeg-2','MPEG-2','avi','AVI','mov','MOV','wmv','WMV','avi','AVI','avchd','AVCHD','flv','FLV','f4v','F4V','swf','SWF','mkv','MKV','webm','WEBM'];
        if(in_array(pathinfo($path,PATHINFO_EXTENSION),$extension_array)) {
            return true;
        } else {
            return false;
        }
    } 
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bllog</title>
    <link rel="stylesheet" href="{{ asset('css/blog/admin/article/components/commentaire/add_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog/admin/article/components/objection/add_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog/admin/article/components/objection/new.css') }}">
    <style>
        div.card-header span {
            font-size: 20px;
            /* font-weight: bold; */
            font-family: italic;
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

        div.all-comments {
            margin-top: 14px;
        }

        div.all-comments-title  {
            padding-left: 16px;
        }

        div.all-comments-title a {
            font-size: 17px;
            font-weight: bold;
            font-family: italic;
            text-decoration: none;
            opacity: 0.8;
        }

        div.all-comments-title a:hover {
            opacity: 0.4;
        }

        div.all-comments-title a i {
            opacity: 0.5;
        }


        div.all-comments-content {
            margin: 10px 0px 0px 6px;
        }

        div.all-comments-content .comment-item {
            margin-bottom: 16px;
        } 

        div.all-comments-content .comment-item .comment-item-header a {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
            text-decoration: none;
            color: black;
            opacity: 0.8;
        }

        div.all-comments-content .comment-item .comment-item-header a img {
            width: 40px;
            height: 40px;
            color: black;
            text-decoration: none;
        }

        div.all-comments-content .comment-item .comment-item-content {
            margin-left: 5%;
            padding-top: 2px;
            border-top: 1px solid #ccc;
        }
       
        @media all and (max-width: 500px) {
            div.all-comments-content .comment-item .comment-item-content {
                margin: 2px 0px 0px 46px;
                padding-top: 6px;
            } 
        }

        /* div.all-comments-content .comment-item .comment-item-content > div {
            margin-top: 6px;
            margin-bottom: -6px;
        } */

        div.all-comments-content .comment-item .comment-item-content > div.text-content p {
            font-size: 18px;
            font-family: italic;
        }

        div.all-comments-content .comment-item .comment-item-content .imgs-content {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
          /* margin-bottom: 20px; */
        }

        /* @media all and (max-width: 500px) {
            div.all-comments-content .comment-item .comment-item-content .imgs-content {
                justify-content: space-between;
            }
        } */

        div.all-comments-content .comment-item .comment-item-content .imgs-content {
            margin-bottom: 16px;
        }

        div.all-comments-content .comment-item .comment-item-content .imgs-content .img-item {
            width: 12.1%;
            height: 100px;
            margin-right: 4px;
        }

        @media all and (max-width: 500px) {
            div.all-comments-content .comment-item .comment-item-content .imgs-content .img-item {
                width: 31.6%;
                /* height: 100px; */
            } 
        }
        






        div.reply {
            margin-top: -16px;
            padding: 3px 8px 2px 2px;
            /* background-color: pink; */
        }

        div.reply-header {
           display: flex; 
           flex-wrap: nowrap;
           opacity: 0.9;
        }

        div.reply-header a {
            font-size: 18px;
            /* font-weight: bold; */
            font-family: italic;
            margin-right: 7px;
        }

        div.reply-header a:hover {
            opacity: 0.5;
        }

        div.reply-header form label {
            font-size: 18px;
            /* font-weight: bold; */
            font-family: italic;
            color: red;
            cursor: pointer;
            text-decoration: underline;
            padding-bottom: 4px;
        }

        div.reply-header form label:hover {
            opacity: 0.5;
        }


        div.reply-content {
            margin-top: 4px;
            margin-left: 0px;
        }

        div.reply-item {
            margin-bottom: 6px;
            padding: 10px 10px 2px 10px;
            border-radius: 4px;
            background-color: #f8f8ff;
        }

        div.reply-item-header a {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
            color: black; 
            text-decoration: none;
            opacity: 0.8;
        }

        div.reply-item-header a img {
            width: 40px;
            height: 40px;
        }

        div.reply-item-header form {
            float: right;
        }

        div.reply-item-header form button span {
            font-weight: bold;
            color: red;
        }


        div.reply-item-content {
            margin-left: 44px;
            padding-top: 6px;
            border-top: 1px solid #ccc;
        }

        div.reply-item-content > div  p {
            font-size: 18px;
            font-family: italic;
        }
        
        div.reply-item-content > div.imgs-content {
            padding-bottom: 20px;
        }


        div.reply-footer {
            margin-top: 8px;
            /* margin-left: 43px; */
            padding-top: 4px;
            /* border-top: 1px solid #ccc; */
        }


        div.reply-footer a {
            display: block;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
            /* color: black; */
            /* text-decoration: none; */
            opacity: 0.9;
            padding: 8px;
            border-radius: 4px;
            background-color: #f8f8ff;
        }

        div.reply-footer a span i {
            opacity: 0.5;
        }
        

        div.reply-footer a:hover {
            opacity: 0.4;
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
                                @include('blog.admin.article.components.commentaire.add')
                            </div>
                            <!-- fin add-comments -->
                            <div class="all-comments">
                                @if($article->commentaires)
                                <div class="all-comments-title">
                                    <a href="#" title="Cliquer pour afficher les commentaires" class="all-comments-link">
                                        Tous les commentaires <i class="fa fa-angle-down"></i>
                                    </a>
                                </div> 
                                <div class="all-comments-content">
                                    <?php $index=0; ?>
                                    @foreach($article->commentaires as $commentaire)
                                    <?php $index++; ?>
                                    <div class="comment-item" style="display: {{ $index<4 ? 'block' : 'none' }}">
                                        <div class="comment-item-header">
                                            <a href="{{ Storage::url($commentaire->auteur->morphModel()->photo) }}">
                                               <img src="{{ Storage::url($commentaire->auteur->morphModel()->photo) }}" alt="" class="rounded-circle"> 
                                               <span>
                                                   {{ $commentaire->auteur->morphModel()->nom }} {{ $commentaire->auteur->morphModel()->prenom }}
                                               </span>   
                                            </a>
                                            <form method="POST" action="{{ route('commentaire.delete_one',['id'=>$commentaire->id]) }}" style="float: right;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="if(!confirm('Voulez vous supprimer ?')){ event.preventDefault(); }"  type="submit" title="Cliquer pour supprimer" class="btn btn-default btn-sm" style="opacity: 0.7;">
                                                    <span>
                                                        <i class="fa fa-x" style="color: red;"></i>
                                                    </span>
                                                </button>
                                            </form>             
                                        </div>
                                        <div class="comment-item-content">
                                            <div class="comment-data-content">
                                                <div class="text-content">
                                                    <p>
                                                        {{ $commentaire->texte }}
                                                    </p>  
                                                </div>
                                                <!-- En cas de presence d'images -->
                                                @if($commentaire->images)
                                                <div class="imgs-content">
                                                    @foreach($commentaire->images as $image)
                                                    <div class="img-item">
                                                        @if(!isVideo($image->path))
                                                        <a href="{{ Storage::url($image->path) }}" title="{{ $image->path }}">
                                                            <img src="{{ Storage::url($image->path) }}" alt="{{ $image->titre }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                                        </a>
                                                        @else
                                                        <video class="rounded-thumbnail cover" alt="Image media" style="width: 100%;height: 100%;" controls>
                                                            <source src="{{ Storage::url($image->path) }}">
                                                        </video>
                                                        @endif
                                                    </div>
                                                    @endforeach                      
                                                </div>
                                                @endif
                                            </div>
                                            <!-- Objections(reply) -->
                                            <div class="reply" id="reply">
                                                <div class="reply-header">
                                                    <a href="#" onclick="openReplyModal(event,{{ $commentaire->id }})" title="Cliquer pour repondre">
                                                        <span>
                                                            Repondre<i>({{ $commentaire->objections->count() }})</i>
                                                        </span>
                                                    </a>
                                                    <form method="post" action="{{ route('commentaire.delete_one',['id'=>$commentaire->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <label onclick="if(!confirm('Voulez-vous vraiment supprimer?')){ event.preventDefault() }" for="delete_comment_{{$commentaire->id}}" title="Cliquer pour supprimer">
                                                            Supprimer
                                                        </label>
                                                        <input type="submit" id="delete_comment_{{ $commentaire->id }}" style="display: none;">
                                                    </form>
                                                </div>
                                                <div class="reply-content">
                                                    <div class="existed-items">
                                                        <?php $index_2=0;?>
                                                        @foreach($commentaire->objections as $objection)
                                                        <?php $index_2++;?>
                                                        <div class="reply-item" id="for_comment_{{$commentaire->id}}"  style="display: {{ $index_2<2 ? 'block' : 'none' }}">
                                                            <div class="reply-item-header">
                                                                <a href="{{ Storage::url($objection->auteur->morphModel()->photo) }}">
                                                                    <img src="{{ Storage::url($objection->auteur->morphModel()->photo) }}" alt="Profil {{ $objection->auteur->morphModel()->nom.' '.$objection->auteur->morphModel()->prenom }}" class="rounded-circle"> 
                                                                    <span>
                                                                        {{ $objection->auteur->morphModel()->nom.' '.$objection->auteur->morphModel()->prenom }}
                                                                    </span>
                                                                </a>
                                                                <form method="POST" action="{{ route('objection.delete_one',['id'=>$objection->id]) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button onclick="if(!confirm('Voulez-vous vraiment supprimer ?')){ event.preventDefault() }" type="submit" class="btn btn-default btn-sm">
                                                                        <span>
                                                                            <i class="fa fa-x"></i>
                                                                        </span>
                                                                    </button>
                                                                </form>
                                                            </div> 
                                                            <div class="reply-item-content">
                                                                <div class="text-content">
                                                                    <p>
                                                                        {{ $objection->texte }}
                                                                    </p>
                                                                </div>
                                                                @if($objection->images)
                                                                <div class="imgs-content">
                                                                    @foreach($objection->images as $image)
                                                                    <div class="img-item">
                                                                        @if(!isVideo($image->path))
                                                                        <a href="{{ Storage::url($image->path) }}" title="{{ $image->path }}">
                                                                            <img src="{{ Storage::url($image->path) }}" alt="{{ $image->titre }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                                                        </a>
                                                                        @else
                                                                        <video class="rounded-thumbnail cover" alt="Image media" style="width: 100%;height: 100%;" controls>
                                                                            <source src="{{ Storage::url($image->path) }}">
                                                                        </video>
                                                                        @endif
                                                                    </div>
                                                                    @endforeach 
                                                                </div>
                                                                @endif  
                                                            </div>   
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!-- reply-footer -->
                                                <div class="reply-footer" style="display: {{ $index_2>2 ? 'block' : 'none' }}">
                                                    <a href="#" title="Cliquer pour toutes les notifications" class="all-reply-link" id="for_comment_{{ $commentaire->id }}">
                                                        <span>
                                                            Toutes les reponses <i class="fa fa-angle-down"></i>
                                                        </span>
                                                    </a>
                                                </div>
                                                <!-- fin reply-footer -->
                                            </div>
                                            <!-- fin reply(objectiobns) -->
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

                    <!-- New Objection -->
                    <div class="add-objection">
                        @include('blog.admin.article.components.objection.new')
                    </div> 
                    
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
        
        <script type="text/javascript">
            //Variable article & commentaires
            let article=<?php echo($article); ?>;
            let commentaires=article.commentaires;

            window.APP_URL=<?php echo(env('APP_URL'));?>

            window.STORAGE_PATH_URL='<?php echo(env('STORAGE_PATH_URL')) ?>';

            

            document.querySelectorAll('form').forEach(function(item){
                item.onsubmit=function(event){
                    event.preventDefault();
                    alert(this.getAttribute('action'));
                }
            });

        </script>

        <!-- Inclus script -->
        <script src="{{ asset('script/blog/admin/article/details.js') }}"></script> 
        <script src="{{ asset('script/blog/admin/commentaire/register.js') }}"></script> 
        <script src="{{ asset('script/blog/admin/objection/register.js') }}"></script> 

    </div>
    @endsection

</body>
</html>