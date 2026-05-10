<?php $headTitle = '';?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>{{ $headTitle }}</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('dependance/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/css/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/css/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/bootstrap-icons-1.11.3/font/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('dependance/font-awesome/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('style\layouts\admin.css') }}">

    <!-- Styles dashboard -->
    @include('layouts.template.admin.dashboard.admin.head.styles')

    <!-- Styles user -->
    @include('layouts.template.admin.user.head.styles')

    <!-- Styles access_ressource -->
    @include('layouts.template.admin.access_ressource.head.styles')

    <!-- Styles identite -->
    @include('layouts.template.admin.identite.head.styles')

    <!-- Styles questionnement -->
    @include('layouts.template.admin.questionnement.head.styles')

    <!-- Styles payment_setting -->
    @include('layouts.template.admin.payment_setting.head.styles')

    <!-- Styles && scripts pour article (blog) -->
    @include('layouts.template.admin.blog.article.head.styles')  <!-- // Ensemble de script styles destines a partie head -->
    @include('layouts.template.admin.blog.article.head.scripts') <!-- // Ensemble de script scripts destines a partie head -->

    <!-- Styles && scripts pour regulation -->
    @include('layouts.template.admin.regulation.head.styles')  <!-- // Ensemble de script styles destines a partie head -->
    @include('layouts.template.admin.regulation.head.scripts') <!-- // Ensemble de script scripts destines a partie head -->

    <!-- Styles benevole -->
    @include('layouts.template.admin.benevole.head.styles')

    <script src="{{ asset('dependance/font-awesome/font-awesome.js') }}"></script>

    <script src="{{ asset('dependance/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dependance/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('dependance/axios/axios.min.js') }}"></script>

    <!-- Script dashboard -->
    @include('layouts.template.admin.dashboard.admin.head.scripts')

    <style>
        body { padding: 0px; margin: 0px; }
        /* === TON CSS RESTE STRICTEMENT INCHANGÉ === */
    </style>
</head>

<body>

@php
    $user = auth()->user();
@endphp

<div id="navigation">
    <div id="navbar">

        <div id="navbar_logo_collapse_button">
            <div id="navbar_logo">
                <img src="{{ $identite->logo ? Storage::url($identite->logo) : '' }}" style="width: 100%;height: 100%;">
            </div>
            <div id="navbar_text">
                <span>Heritiers du Monde</span>
            </div>
            <div id="navbar_collapse">
                <button type="button" class="btn btn-default btn-sm" id="collapse_button">
                    <span class="bi bi-list"></span>
                </button>
            </div>    
        </div> 

        <div id="navbar_social_menu">
            <ul>
                <li><a href="{{ $identite->sociaux?->facebook }}"><i class="bi bi-facebook" style="color: blue;"></i></a></li>
                <li><a href="{{ $identite->sociaux?->twitter }}"><i class="bi bi-twitter" style="color: #00acee;"></i></a></li>
                <li><a href="{{ $identite->sociaux?->google }}"><i class="bi bi-google" style="color: #db4a39;"></i></a></li>
                <li><a href="{{ $identite->sociaux?->instagram }}"><i class="bi bi-instagram" style="color: #C32AA3;"></i></a></li>
            </ul>
        </div> 

        <div id="navbar_user_menu">
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="{{ $admin->photo ? Storage::url($admin->photo) : '' }}" class="rounded-circle" style="width: 40px;height: 40px;">
                        <span> {{ $admin->nom }} </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <img src="{{ $admin->photo ? Storage::url($admin->photo) : '' }}" class="rounded-circle" style="width: 24px;height: 24px;">
                            Options <i class="bi bi-chevron-down"></i>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <a href="#"><i class="bi bi-person-fill-gear"></i> My Profil</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <a href="#"><i class="bi bi-lock-fill"></i> Password</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <div class="d-grid">
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="btn btn-default active btn-sm">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>

    <div id="sidebar">

        <div id="sidebar_logo_dismiss">
            <div id="sidebar_logo_title">
                <img src="{{ $identite->logo ? Storage::url($identite->logo) : '' }}">
                <span><i>Heritiers du Monde</i></span>
            </div>
            <div id="sidebar_dismiss">
                <button type="button" class="btn btn-default btn-sm active" id="dismiss_button">
                    <span class="bi bi-x-lg"></span>
                </button>
            </div>
        </div>

        <div id="sidebar_admin">
            <div class="card">
                <div class="card-body">
                    <div id="profil_img">
                        <img src="{{ $admin->photo ? Storage::url($admin->photo) : '' }}" class="rounded-circle">
                    </div>
                    <div id="profil_nom">
                        <span>{{ $admin->nom }}</span>
                    </div>
                </div>
            </div>               
            <div id="profil_qualification">
                <span><i class="bi bi-person-fill-gear"></i> Admin</span>
            </div>
        </div>

        <div id="sidebar_menu">

            @if($user?->hasRole('admin')) 
            <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-signal"></i> Dashboard</a></li>

            <li class="parameter-menu">
                <a href="#" id="parameter_menu_link">
                    <i class="fa fa-cog"></i> Parametre <i class="fa fa-angle-down" style="float: right;"></i>
                </a>
                <ul class="sous-menu" id="parameter_sous_menu">
                    <li>
                        <a href="{{ route('identite.update_page',['id'=>$identite->id]) }}"><i class="fa fa-blog"></i> Identite</a>
                        <a href="{{ route('questionnement.list') }}"><i class="fas fa-question-circle"></i> Questionnement</a>

                        @if(auth()->id() === 1)
                        <a href="{{ $paymentSetting ? route('paymentSetting.update_page',['id'=>$paymentSetting->id]) : route('paymentSetting.register_page') }}">
                            <i class="fa fa-credit-card"></i> Payment
                        </a>
                        @endif
                    </li>
                </ul>
            </li>

            <li><a href="{{ route('user.list') }}"><i class="fa fa-users"></i> Utilisateurs</a></li>
            @endif

            <li>
                @if($user?->hasAccessToRessource('blog','register','allowed') || $user?->hasAccessToRessource('blog','update','allowed') || $user?->hasAccessToRessource('blog','delete','allowed'))
                <a href="{{ route('admin.article.list') }}"><i class="fa fa-blog"></i> Blog</a>
                @else
                <a href="#"><i class="fa fa-blog"></i> Blog</a>
                @endif
            </li>

            <li>
                @if($user?->hasAccessToRessource('benevole','register','allowed') || $user?->hasAccessToRessource('benevole','update','allowed') || $user?->hasAccessToRessource('benevole','delete','allowed'))
                <a href="{{ route('admin.benevole.list') }}"><i class="fa fa-user"></i> Benevole</a>
                @else
                <a href="#"><i class="fa fa-user"></i> Benevole</a>
                @endif
            </li>

            <li>
                @if($user?->hasAccessToRessource('besoin','register','allowed') || $user?->hasAccessToRessource('besoin','update','allowed') || $user?->hasAccessToRessource('besoin','delete','allowed'))
                <a href="{{ route('besoin.list') }}"><i class="fa fa-blog"></i> Besoins</a>
                @else
                <a href="#"><i class="fa fa-blog"></i> Besoins</a>
                @endif
            </li>

            <li>
                @if($user?->hasAccessToRessource('contact','register','allowed') || $user?->hasAccessToRessource('contact','update','allowed') || $user?->hasAccessToRessource('contact','delete','allowed'))
                <a href="{{ route('contact.index') }}"><i class="fa fa-envelope"></i> Contact</a>
                @else
                <a href="#"><i class="fa fa-envelope"></i> Contact</a>
                @endif
            </li>

            <li>
                @if($user?->hasAccessToRessource('donateur','register','allowed') || $user?->hasAccessToRessource('donateur','update','allowed') || $user?->hasAccessToRessource('donateur','delete','allowed'))
                <a href="{{ route('donateur.list') }}"><i class="fa fa-support"></i> Donateurs</a>
                @else 
                <a href="#"><i class="fa fa-support"></i> Donateurs</a>
                @endif
            </li>

            <li>
                @if($user?->hasAccessToRessource('offre_emploie','register','allowed') || $user?->hasAccessToRessource('offre_emploie','update','allowed') || $user?->hasAccessToRessource('offre_emploie','delete','allowed'))
                <a href="{{ route('offre_emploie.list') }}"><i class="fa fa-tasks"></i> Offres Travails</a>
                @else
                <a href="#"><i class="fa fa-tasks"></i> Offres Travails</a>
                @endif
            </li>

            <li>
                @if($user?->hasAccessToRessource('don','register','allowed') || $user?->hasAccessToRessource('don','update','allowed') || $user?->hasAccessToRessource('don','delete','allowed'))
                <a href="{{ route('don.list') }}"><i class="fa fa-support"></i> Dons</a>
                @else
                <a href="#"><i class="fa fa-support"></i> Dons</a>
                @endif
            </li>

            <li>
                @if($user?->hasAccessToRessource('evenement','register','allowed') || $user?->hasAccessToRessource('evenement','update','allowed') || $user?->hasAccessToRessource('evenement','delete','allowed'))
                <a href="{{ route('evenement.list') }}"><i class="fa fa-calendar"></i> Evenement</a>
                @else
                <a href="#"><i class="fa fa-calendar"></i> Evenement</a>
                @endif
            </li>

        </div>
    </div>
</div>

<div id="content_wrapper">
    @yield('content') 
</div>

<!-- Scripts externes -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('script/layouts/admin.js') }}"></script>
</body>
</html>