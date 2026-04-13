
@extends('layouts.admin')

@section('content')
    @php
        // Definit la mention
        function getMention($ressource,$user,$action){
            $mention='';
            foreach($user->access_ressources as $item) {
                if($item->ressource->id==$ressource->id && $item->action==$action) {
                    $mention=$item->mention;
                } 
            }
            return $mention;
        }  
        // Definit la valeur du titre dans le layout
        $headTitle = 'Utilisateurs';
    @endphp
<!-- Contenu du layouts (HTML) -->    
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
                                        <span>
                                            <i class="password-dots">........</i> 
                                        </span>
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
                                                @if($ressource->nom == 'benevole' || $ressource->nom == 'contact' || $ressource->nom == 'don' || $ressource->nom == 'donateur')
                                                <span>
                                                    @if(getMention($ressource,$user,'authorized') == 'allowed')
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
                                                @if(strtolower(getMention($ressource,$user,'register')) == 'allowed')
                                                <span style="color:white;display: block;border-radius: 4px;background-color: green;width: 20px;height: 20px;"> </span>
                                                @else 
                                                    @if($ressource->nom == 'benevole' || $ressource->nom == 'contact' || $ressource->nom == 'don' || $ressource->nom == 'donateur')
                                                    <span style="color:white;display: block;border-radius: 4px;background-color: pink;width: 20px;height: 20px;"> </span>
                                                    @else
                                                    <span style="color:white;display: block;border-radius: 4px;background-color: red;width: 20px;height: 20px;"> </span>                                                                                                                                         
                                                    @endif                                                                                                                                     
                                                @endif
                                            </td>
                                            <td>
                                                @if(strtolower(getMention($ressource,$user,'delete')) == 'allowed')
                                                <span style="color:white;display: block;border-radius: 4px;background-color: green;width: 20px;height: 20px;"> </span>
                                                @else 
                                                    @if($ressource->nom=='benevole' || $ressource->nom == 'contact' || $ressource->nom=='don' || $ressource->nom=='donateur')
                                                    <span style="color:white;display: block;border-radius: 4px;background-color: pink;width: 20px;height: 20px;"> </span>
                                                    @else
                                                    <span style="color:white;display: block;border-radius: 4px;background-color: red;width: 20px;height: 20px;"> </span>                                                                                                                                         
                                                    @endif                                                                                                                   
                                                @endif
                                            </td>
                                            <td>
                                                @if(strtolower(getMention($ressource,$user,'update')) == 'allowed')
                                                <span style="color:white;display: block;border-radius: 4px;background-color: green;width: 20px;height: 20px;"> </span>
                                                @else 
                                                    @if($ressource->nom=='benevole' || $ressource->nom == 'contact' || $ressource->nom=='don' || $ressource->nom=='donateur')
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
