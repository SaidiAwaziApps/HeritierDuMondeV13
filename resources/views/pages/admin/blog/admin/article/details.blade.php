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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog</title>

    <link rel="stylesheet" href="{{ asset('css/blog/admin/article/components/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image/global/admin_template_items.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global/feedback_toast.css') }}">
    <link rel="stylesheet" href="{{ asset('css/share/register.css') }}">
    
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


        div.shares {
            margin-top: 6px;
        } 

        
        div.comments {
            margin-top: 6px;
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
                        <i class="fa fa-blog"></i> Details sur l'article
                    </span>
                </div>    
                <!-- Menu deroulant -->
                <div class="dropdown">
                    @include('components.blog.admin.article.menu')
                </div>    
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
                            {!! $article->contenu !!}
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
                    

                    <div class="medias">
                        @include('components.image.global.admin_template_items')
                    </div>
                
                    
                    <div class="shares">
                        @include('components.share.register')
                    </div>
                    <!-- fin shares -->
                    
                    <div class="comments">
                        <div id="comment_hub">

                        </div>
                    </div>
                    <!-- fin comments_bloc -->

                </div>
            </div>
        </div>


        <!-- Inclus le FeedbackToast -->
        @include('components.global.FeedbackToast')
        
        <script type="text/javascript">
            // Variable article & commentaires
            window.article = <?php echo(json_encode($article));?>;
            window.APP_URL = <?php echo(json_encode($app_url));?>;
            window.STORAGE_PATH_URL = '<?php echo($storage_path_url);?>';
            window.user = <?php echo(session('user')??session('user')); ?>
        </script>

        <!-- Inclus script -->
        <!-- <script src="{{ asset('script/blog/admin/article/details.js') }}"></script> -->
        <script src="{{ asset('script/share/register.js') }}"></script> 
        <script src="{{ mix('js/mains/blog/admin/index.js') }}"></script>


    </div>
    @endsection

</body>
</html>