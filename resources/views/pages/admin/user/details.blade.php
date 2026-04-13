<?php
    function getMention($ressource,$user,$action){
        $mention='';
        foreach($user->access_ressources as $item) {
            if($item->ressource->id==$ressource->id && $item->action==$action) {
                $mention=$item->mention;
            } 
        }
        return $mention;
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
</head>
<style>
    div.card .card-header span.card-title {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
    }

    div.card .card-header a {
        float: right;
    }

    div.card .card-header a span {
        font-weight: bold;
        font-family: italic;
    }


    div#user_access_bloc #user_bloc {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap; 
    }

    div#user_bloc #profil_bloc {
        width: 31%;
    }

    div#user_bloc #meta_bloc {
        width: 68%;
    }

    @media all and (max-width: 700px) {
        div#user_access_bloc #user_bloc {
            display: block;
        }
        div#user_bloc #profil_bloc {
            width: 100%;
        }
        div#user_bloc #meta_bloc {
            width: 100%;
        }
    }

    div#profil_bloc > .card > .card-body {
        width: 100%;
        height: 206px;
    } 

    ul.list-group li span {
        font-size: 17px;
        font-family: italic;
    }

    ul.list-group li span:nth-child(1) {
        font-weight: bold;
    }

    ul.list-group li:nth-child(5) span:nth-child(2) {
        text-transform: capitalize;
    }


    div#illustration {
        display: flex;
        justify-content: center;
        margin-top: 16px;
        margin-bottom: 10px;
        /* padding-bottom: 4px; */
        border-bottom: 2px solid #ccc;
    }

    div#illustration ul li {
        float: left;
        margin-left: 10px;
        list-style-type: none;
    }

    div#illustration ul li span {
        font-size: 18px;
        font-family: italic;
    }

    div#illustration ul li span:nth-child(2n+1) {
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 4px;
        opacity: 0.8;
    }

    div#illustration ul li:nth-child(1) span:nth-child(1) {
        background-color: green;
    }

    div#illustration ul li:nth-child(2) span:nth-child(1) {
        background-color: red;
    }

    div#illustration ul li:nth-child(3) span:nth-child(1) {
        background-color: pink;
    }



    table thead tr th,
    table tbody tr td {
        font-size: 17px;
        font-family: italic;
        text-transform: capitalize;
    }

    /* @media all and (min-width: 700px) {
        table tbody tr td:nth-child(2) span:nth-child(1) {
            display: inline-block;
            width: 86px;
        }
    }  */
</style>
<body>


    
@extends('layouts.admin')

@section('content')
<div id="globalContent">
    <div class="card">
        <div class="card-header">
            <span class="card-title">
                <i class="fa fa-users"></i> Gestion utilisateurs
            </span>   
            <a href="{{ route('user.list') }}" class="btn btn-default btn-sm active">
               <span>
                  <i class="fa fa-list"></i>
               </span>
            </a>
        </div>
        <div class="card-body">
            <!-- card -->
            <div class="card">
                <div class="card-body">
                    <!-- user_access_bloc -->
                    <div id="user_access_bloc">
                        <div id="user_bloc">
                            <div id="profil_bloc">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{ Storage::url($user->photo) }}" title="Profil {{ $user->nom }}">
                                            <img src="{{ Storage::url($user->photo) }}" alt="Profil {{ $user->nom }}" class="rounded-thumbnail" style="width: 100%;height: 100%;">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div id="meta_bloc">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span> Nom: </span>
                                        <span> {{ $user->nom }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span> Email: </span>
                                        <span> {{ $user->email }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span> Username: </span>
                                        <span> {{ $user->username }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span> Password: </span>
                                        <span> {{ $user->password }} </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span> Roles: </span>
                                        <span> 
                                            @foreach($user->roles as $role)
                                            <i> {{ $role->rolename }} </i>,
                                            @endforeach
                                        </span>
                                    </li>
                                </ul>    
                            </div>
                        </div>
                        <div id="access_bloc">
                            <div id="illustration">
                                <ul>
                                    <li>
                                        <span>
                                            
                                        </span>
                                        <span>
                                            Allowed
                                        </span>    
                                    </li>
                                    <li>
                                        <span>

                                        </span>
                                        <span>
                                            Denied
                                        </span>    
                                    </li>
                                    <li>
                                        <span>

                                        </span>
                                        <span>
                                            Not define
                                        </span>    
                                   </li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Ressource
                                            </th>
                                            <th>
                                                <i class="bi bi-plus"></i>
                                            </th>
                                            <th>
                                                <i class="bi bi-trash"></i>
                                            </th>
                                            <th>
                                                <i class="bi bi-pencil-square"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index=0; ?>
                                        @foreach($ressources as $ressource)
                                        <?php $index=$index+1;?>
                                        <tr>
                                            <td>
                                                {{ $index }}
                                            </td>
                                            <td>
                                                <span>
                                                    {{ $ressource->nom }}
                                                </span> 
                                                @if($ressource->nom=='benevole' || $ressource->nom=='contact' || $ressource->nom=='don' || $ressource->nom=='donateur')
                                                <span>
                                                    @if(getMention($ressource,$user,'authorized')=='allowed')
                                                    <i style="display: inline-block;padding: 2px 8px 2px 8px;border-radius: 16px;background-color: pink;color: white;opacity: 0.9;">
                                                        Authorized
                                                    </i>
                                                    @else
                                                    <i style="display: inline-block;padding: 2px 8px 2px 8px;border-radius: 16px;background-color: pink;color: white;opacity: 0.9;">
                                                        Denied
                                                    </i>
                                                    @endif
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(strtolower(getMention($ressource,$user,'register'))=='allowed')
                                                <span style="color:white;display: block;border-radius: 4px;background-color: green;width: 20px;height: 20px;"> </span>
                                                @else 
                                                    @if($ressource->nom=='benevole' || $ressource->nom=='contact' || $ressource->nom=='don' || $ressource->nom=='donateur')
                                                    <span style="color:white;display: block;border-radius: 4px;background-color: pink;width: 20px;height: 20px;"> </span>
                                                    @else
                                                    <span style="color:white;display: block;border-radius: 4px;background-color: red;width: 20px;height: 20px;"> </span>                                                                                                                                         
                                                    @endif                                                                                                                                     
                                                @endif
                                            </td>
                                            <td>
                                                @if(strtolower(getMention($ressource,$user,'delete'))=='allowed')
                                                <span style="color:white;display: block;border-radius: 4px;background-color: green;width: 20px;height: 20px;"> </span>
                                                @else 
                                                    @if($ressource->nom=='benevole' || $ressource->nom=='contact' || $ressource->nom=='don' || $ressource->nom=='donateur')
                                                    <span style="color:white;display: block;border-radius: 4px;background-color: pink;width: 20px;height: 20px;"> </span>
                                                    @else
                                                    <span style="color:white;display: block;border-radius: 4px;background-color: red;width: 20px;height: 20px;"> </span>                                                                                                                                         
                                                    @endif                                                                                                                   
                                                @endif
                                            </td>
                                            <td>
                                                @if(strtolower(getMention($ressource,$user,'update'))=='allowed')
                                                <span style="color:white;display: block;border-radius: 4px;background-color: green;width: 20px;height: 20px;"> </span>
                                                @else 
                                                    @if($ressource->nom=='benevole' || $ressource->nom=='contact' || $ressource->nom=='don' || $ressource->nom=='donateur')
                                                    <span style="color:white;display: block;border-radius: 4px;background-color: pink;width: 20px;height: 20px;"> </span>
                                                    @else
                                                    <span style="color:white;display: block;border-radius: 4px;background-color: red;width: 20px;height: 20px;"> </span>                                                                                                                                         
                                                    @endif                                                                                                                    
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <!-- fin user_access_bloc --> 
                </div>
            </div>
            <!-- fin card --> 
        </div> 
    </div>
</div>
@endsection
</body>
</html>