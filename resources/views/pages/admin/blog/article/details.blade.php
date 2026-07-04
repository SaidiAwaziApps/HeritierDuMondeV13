@php
    function isVideo($path) {
        $extension_array=['mp4','MP4','mpeg','MPEG','mpeg-2','MPEG-2','avi','AVI','mov','MOV','wmv','WMV','avi','AVI','avchd','AVCHD','flv','FLV','f4v','F4V','swf','SWF','mkv','MKV','webm','WEBM'];
        if(in_array(pathinfo($path,PATHINFO_EXTENSION),$extension_array)) {
            return true;
        } else {
            return false;
        }
    } 
@endphp

@extends('layouts.admin')

@section('content')
<div id="global_content">
    <div class="card">
        <div class="card-header">
            <span class="card-title">
                <i class="fa fa-blog"></i> Details sur l'article
            </span>
            <a href="{{ route('admin.article.register_page') }}" title="Nouveau article" class="btn btn-default btn-sm">
                <i class="fa fa-plus"></i>
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
                            <i><b>{{ $article->auteur->auteable->nom }}</b></i>
                        </span>    
                    </p>
                </div>
                

                <div class="medias">
                    @include('components.admin.image.global.items')
                </div>
            
                
                <div class="shares">
                    @include('components.admin.share.register')
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
    @include('components.admin.global.FeedbackToast')
    
    <script type="text/javascript">
        // Variable article & commentaires
        window.article = @json($article);
        window.APP_URL = @json($app_url);
        window.STORAGE_PATH_URL = @json($storage_path_url);
    </script>

    <!-- Script externe -->
    <!-- <script src="{{ asset('script/blog/admin/article/details.js') }}"></script> -->
    <script src="{{ asset('script/components/global/share/register.js') }}"></script>

    @vite('resources/js/mains/admin/blog/index.js')

</div>
@endsection