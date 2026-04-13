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
    <title>Besoin</title>
    <link rel="stylesheet" href="{{ asset('css/image/global/admin_template_items.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global/feedback_toast.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/don/donors_talks.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/share/register.css') }}">
    <style> 
        div.card-header span.card-title {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.7;
        }

        div.card-header span.card-title i {
            opacity: 0.4
        }


        div.card-header a {
            float: right;
        }

        h6#header_title {
            text-align: center;
            padding: 10px 0px 10px 0px;
            border-radius: 4px;
            background-color: #f8f8ff;
        }

        h6#header_title span {
            font-size: 20px;
            /* font-weight: bold; */
            font-family: italic;
        }

        div#data_content {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
            margin-top: 0.5px;
        }

        div#data_content > div:nth-child(1) {
            width: 69.6%;
        }

        div#data_content > div:nth-child(2) {
            width: 30%;
            /* height: 200px; */
        }

        @media all and (max-width: 500px) {
            div#data_content {
                display: block;
            }
            div#data_content > div:nth-child(1) {
                width: 100%;
            }
            div#data_content > div:nth-child(2) {
                width: 100%;
            }  
        }

        div#meta_bloc ul li span {
            font-size: 18px;
            font-family: italic;
        }

        div#meta_bloc ul li:nth-child(1) span:nth-child(1) {
            font-weight: bold;
        }

        div#meta_bloc ul li:nth-child(2) span:nth-child(1) {
            display: block;
            text-align: center;
            padding: 6px;
            border-radius: 4px;
            background-color: #f8f8ff;
        }

        div#meta_bloc ul li:nth-child(3) h5 {
            font-family: italic;
        } 
        
        
        .donors-talks {
            margin-top: 10px;
        }

        .donors-talks-heading h4 {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.8;
        }

        @media all and (max-width: 800px) {
            .donors-talks-heading h4 {
                font-weight: normal; 
                padding: 6px;
                border-radius: 4px;
                background-color: #f8f8ff;
                /* color: white; */
                opacity: 0.9;
            } 
        }


        .shares {
            position: fixed;
            left: 40%;
            top: 86%;
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
                    Gestion Besoins
                </span>
                <a href="{{ route('besoin.list') }}" title="Tous les besoins" class="btn btn-default btn-sm active">
                    <span>
                        <i class="fa fa-list"></i>
                    </span>
                </a>
            </div>
            <div class="card-body">
                <h6 id="header_title">
                    <span>
                        <i class="fa fa-header" style="opacity: 0.6;"></i>  {{ $besoin->intitule }}
                    </span>
                </h6>
                <div id="data_content">
                    <div id="meta_bloc">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span>
                                    Montant:
                                </span>
                                <span>
                                    {{ $besoin->montant }} {{ $paymentSetting->currency }}
                                </span>
                            </li>
                            <li class="list-group-item">
                                <span>
                                    <i class="fa fa-text-height" style="opacity: 0.6;"></i> Contenu:
                                </span>
                                <span>
                                    {{ $besoin->contenu }}
                                </span>
                            </li>
                             @if(($besoin->images && count($besoin->images) > 0) || ($besoin->vignettes && count($besoin->vignettes) > 0))
                            <li class="list-group-item">
                                <div id="medias">
                                    @include('components.image.global.admin_template_items')
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div id="chart_bloc">
                        <div class="card">
                            <div class="card-body">
                                <div id="besoin_chart_graph">
                                                 
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
                
                <!-- Que disent nos donateurs -->
                @if($besoin->dons && $besoin->dons->count() > 0)  
                    <div class="donors-talks">
                        <div class="card">
                            <div class="card-body">
                                <div class="donors-talks-heading">
                                    <h4 class="donors-talks-heading-title">
                                        @if($besoin->dons->count() > 1)
                                           Que disent nos donateurs ?
                                        @else
                                           Que dit le donateur ?
                                        @endif
                                    </h4>
                                </div>
                                <div class="donors-talks-heading">
                                    @include('components.don.donors_talks')
                                </div>
                            </div>
                        </div>
                    </div> 
                @endif

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

        <script type="text/javascript">
            let besoin = <?php echo($besoin);?>
        </script>

        <script type="text/javascript">
            window.paymentSetting = <?php echo($paymentSetting);?>
        </script>

        <!-- Inclus script (externe) --> 
        <script src="{{ asset('script/besoin/details.js') }}"></script>
        <script src="{{ asset('script/share/register.js') }}"></script>

    </div>
    @endsection

</body>
</html>