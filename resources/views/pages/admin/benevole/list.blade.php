<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benevolde</title>
    <style>
        h4.card-title {
            font-family: italic;
            /* text-align: center; */
            opacity: 0.7;
        }

        h4.card-title i{
            opacity: 0.4;
        }


        div#item_data_content {
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        @media all and (max-width: 500px) {
            div#item_data_content {
                display: block;
            }  
        }

        div#item_data_content .card {
            width: 24%;
            margin-bottom: 10px;
        } 

        @media all and (max-width: 96t 0px) {
            div#item_data_content .card { 
               width: 32%; 
            }
        }

        @media all and (max-width: 800px) {
            div#item_data_content .card { 
               width: 49%; 
            }
        }

        @media all and (max-width: 600px) {
            div#item_data_content .card { 
               width: 100%; 
            }
        }


        div#data_item ul li {
            text-align: center;
        }

        div#data_item ul li a {
            text-decoration: none;
            color: black;
            font-family: italic;
        }


        div#data_item ul li:nth-child(1) div {
            width: 100%;
            height: 140px;
        }

        div#data_item ul li:nth-child(2) a:hover {
            text-decoration: underline;
            color: cadetblue; 
        }


        div#data_item ul li:nth-child(n+3) a {
            margin-right: 3px;
        }

        div#data_item ul li:nth-child(n+3) a:hover {
            opacity: 0.5;
        }

        div#data_item ul li:nth-child(3) a {
            margin-left: 5px;
            display: none;
        }

        
        div#data_more_option {
            width: 100%;
            height: 100%;
            background-color: #fff;
            opacity: 0.8;
            position: relative;
            display: none;
    
        }

        div#data_more_option a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }



    </style>
</head>
<body>
    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                   <i class="fa fa-people-group"></i>  Nos Benevoles
                </h4>
            </div>
            <div class="card-body">
                <div id="item_data_content">
                    @foreach($benevoles as $benevole)
                    <div class="card">
                        <div class="card-body">
                            <div id="data_item">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div id="profil_bloc">
                                            <a href="{{ Storage::url($admin->photo) }}">
                                                <img src="{{ Storage::url($admin->photo) }}" alt="" title="Profil {{ $benevole->nom }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                            </a>    
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('benevole.details',['id'=>$benevole->id]) }}" title="Plus infos sur {{ $benevole->nom }}">
                                            <span>
                                                {{ $benevole->nom.' '.$benevole->prenom }} <i class="fa fa-plus"></i>
                                            </span>
                                        <a>    
                                    </li>
                                    <li class="list-group-item" title="Aller sur Facebook">
                                        <a href="{{ $benevole->sociaux->facebook }}">
                                            <i class="bi bi-facebook" style="color: blue;"></i>
                                        </a>
                                        <a href="{{ $benevole->sociaux->twitter }}" title="Aller sur Twitter">
                                            <i class="bi bi-twitter" style="color: #00acee;"></i>
                                        </a>
                                        <a href="{{ $benevole->sociaux->google }}" title="Aller sur Google">
                                            <i class="bi bi-google" style="color: #db4a39;"></i>
                                        </a>
                                        <a href="{{ $benevole->sociaux->instagram }}" title="Aller sur Instagram">
                                            <i class="bi bi-instagram" style="color: #C32AA3;"></i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- More option -->
                            <div id="data_more_option">
                                <a href="#" title="Pour plus d' information sur {{ $benevole->nom }}">
                                    <div>
                                        <button type="button" class="btn btn-default active btn-sm">
                                            <div>
                                                <span class="fa fa-plus"></span>
                                            </div>
                                        </button>
                                    </div>
                                </a>
                            </div>
                            <!---->
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> 
        </div>

        <script src="{{ asset('script/benevole/list.js') }}"></script>

    </div>
    @endsection

</body>
</html>