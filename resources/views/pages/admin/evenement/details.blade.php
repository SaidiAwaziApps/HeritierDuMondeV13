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
    <title>Evenement</title>
    <link rel="stylesheet" href="{{ asset('css/image/global/admin_template_items.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global/feedback_toast.css') }}">
    <link rel="stylesheet" href="{{ asset('css/share/register.css') }}">
    <style>

        div#global_content {
            margin-bottom: 20px;
        }

        div.card .card-header span.card-title {
            font-size: 22px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.6;
        }

        div.card .card-header span.card-title i {
            opacity: 0.4;
        }



        div.card-header a {
            font-size: 20px;
            font-weight: bold;
            color: black;
            float: right;
            padding-left: 4px;
            padding-right: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        div#meta ul li:nth-child(1) {
            text-align: center;
            background-color: #f8f8ff;
        }

        div#meta ul li:nth-child(1) i,
        div#meta ul li:nth-child(4) i {
            opacity: 0.6;
        }

        div#meta ul li span {
            font-size: 18px; 
            font-family: italic; 
        }

        div#meta ul li span:nth-child(1) {
            font-weight: bold;
        }


        div#meta ul li:nth-child(4) span {
           display: block;
        }

        div#meta ul li:nth-child(4) span:nth-child(1) {
            text-align: center;
        }

        div#meta ul li:nth-child(4) span:nth-child(1) {
            display: block;
            padding: 6px;
            margin-bottom: 4px;
            text-align: center;
            background-color: #f8f8ff;
            border-radius: 4px;
        }

        div#meta ul li:nth-child(4) span:nth-child(2) {
            text-align: justify;
        }


        div#meta ul li:nth-child(5) h5 {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
        }

        div#meta ul li:nth-child(5) > div#images {
            margin-bottom: 10px;
        }

        .shares {
            position: fixed;
            left: 40%;
            top: 84%;
            z-index: 1000;
            opacity: 0.8;
            padding: 20px;
            border-radius: 4px;
            background-color: #f8f8ff;
        }

         @media all and (max-width: 700px) {
            .shares { 
                left: 14%;
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
                <span class="card-title">
                   <i class="fa fa-calendar" style="opacity: 0.6;"></i> Gestion Evenements
                </span>
                <a href="{{ route('evenement.list') }}" class="active" title="Ajouter un evenement">
                    <i class="bi bi-list"></i>
                </a>
            </div>
            <div class="card-body">
                <!-- card -->
                <div id="meta">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <!-- <span>
                                Titre:
                            </span> -->
                            <span>
                               <i class="fa fa-header"></i>  {{ $evenement->titre }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span>
                                Date/Periode:
                            </span>
                            <span>
                                @if($evenement->type=='journalier')
                                    {{ $evenement->date_du_jour }}
                                @else 
                                    {{ $evenement->periode_date_debut }} au {{ $evenement->periode_date_fin }}
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span>
                                Localisation:
                            </span>
                            <span>
                                {{ $evenement->lieu }}
                            </span>
                         </li>    
                        <li class="list-group-item">
                            <span>
                                <i class="fa fa-text-height"></i> Description
                            </span>
                            <span>
                                {{ $evenement->contenu }}
                            </span>
                        </li>
                        @if(($evenement->images && count($evenement->images) > 0) || ($evenement->vignettes && count($evenement->vignettes) > 0))
                        <li class="list-group-item">
                            <div id="medias">
                                @include('components.image.global.admin_template_items')
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
                <!-- fin meta -->       
                
                <!-- Share --->
                <div class="shares">
                    @include('components.share.register')
                </div> 

                <!-- Inclus le FeedbackToast -->
                <div class="feedback-toast">
                    @include('components.global.FeedbackToast')
                </div> 
                
            </div>
        </div>

        <!-- Script pour evenement -->
        <script src="{{ asset('script/share/register.js') }}"></script>  
        <script src="{{ asset('script/evenement/details.js') }}"></script>
         
    </div>
    @endsection
</body>
</html>