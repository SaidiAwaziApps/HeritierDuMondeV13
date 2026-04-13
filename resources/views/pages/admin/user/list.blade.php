<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Utilisateurs</title>
   <style>
      div.card .card-header span.card-title {
         font-size: 20px;
         font-weight: bold;
         font-family: italic;
         opacity: 0.6;
      }

      div.card .card-header span.card-title i {
         opacity: 0.4;
      }

      div.card .card-header a {
         float: right;
      }

      div.card .card-header a span {
         font-weight: bold;
         font-family: italic;
      }

      table thead tr th {
         font-weight: bold;
         font-family: italic;
      }


      table tbody td {
         font-family: italic;
         font-size: 17px;
      }

      table tbody td div.d-grid a.btn-default {
         border: 1px solid #ccc;
      }

      table tbody tr td:nth-child(8) .dropdown .btn-group button:nth-child(1) {
         cursor: default;
      }

      table tbody tr td:nth-child(8) .dropdown .btn-group ul li:nth-child(1) {
         text-align: center;
         font-weight: bold;
         opacity: 0.7;
      }

      table tbody tr td:nth-child(8) .dropdown .btn-group ul li {
         font-family: italic;
      }

      table tbody tr td:nth-child(8) .dropdown .btn-group ul li a {
         font-family: italic;
         font-size: 16px;
      }

      table tbody tr td:nth-child(8) .dropdown .btn-group ul li a i {
         opacity: 0.6;
      }

   </style>
</head>
<body>
   @extends('layouts.admin')

   @section('content')
   <div id="globalContent">
      <div class="card">
         <div class="card-header">
            <span class="card-title">
               <i class="fa fa-users"></i> Gestion utilisateurs
            </span>   
            <a href="{{ route('user.register') }}" class="btn btn-default btn-sm active">
               <span>
                  <i class="fa fa-plus"></i>
               </span>
            </a>
            </h5>
         </div>
         <div class="card-body">
            <div class="card">
               <div class="card-body">  
                  <div class="table-responsive">
                     <table class="table table-condensed table-striped" id="example">
                        <thead>
                           <tr>
                              <th scope="col">#</th>
                              <th>Profil</th>
                              <th>Nom</th>
                              <th>Email</th>
                              <th>Username</th>
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
                           @foreach($users as $user)
                              @if($user->id!=1)
                              <?php $index++ ?>
                              <tr>
                                 <td>
                                    {{ $index }}
                                 </td>
                                 <td>
                                    <div class="d-grid">
                                       <a href="{{ Storage::url($user->photo) }}" title="Profil {{ $user->nom }}" class="btn btn-default btn-block btn-sm" style="border: 1px solid #ccc;">
                                          <img src="{{ Storage::url($user->photo) }}" alt="Profil {{ $user->nom }}" class="rounded-circle" style="width: 20px;height: 20px;">
                                       </a>
                                    </div>   
                                 </td>
                                 <td>
                                    {{ $user->nom }}
                                 </td>
                                 <td>
                                    {{ $user->email }}
                                 </td>
                                 <td>
                                    {{ $user->username }}
                                 </td>
                                 <td>
                                    <div class="d-grid">
                                       <a href="{{ route('user.details',['id'=>$user->id]) }}" class="btn btn-default btn-block btn-sm">
                                          <i class="bi bi-plus"></i>
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                    <form action="{{ route('user.delete_one',['id'=>$user->id]) }}" method="post">
                                       @csrf
                                       @method('DELETE')
                                       <div class="d-grid">
                                          <button onclick="confirm('Voulez-vous supprimer {{ $user->nom }} ?')" type="submit" href="{{ route('user.delete_one',['id'=>$user->id]) }}" class="btn btn-danger btn-block btn-sm" style="border: 1px solid #ccc;">
                                             <i class="bi bi-trash"></i>
                                          </button>
                                       </div>   
                                    </form>
                                 </td>
                                 <td>
                                    <div class="dropdown">
                                       <div class="btn-group">
                                          <button class="btn btn-primary btn-sm active">
                                             <i class="bi bi-pencil-square"></i>
                                          </button>
                                          <button class="btn btn-primary btn-sm dropdown-toggle" title="Option modification" data-bs-toggle="dropdown">

                                          </button>
                                          <ul class="dropdown-menu">
                                             <li class="dropdown-item">
                                                Option <i class="fa fa-angle-down"></i>
                                             </li>
                                             <li class="dropdown-divider"></li>
                                             <li class="dropdown-item">
                                                <div class="d-grid">
                                                   <a href="{{ route('user.update_page',['id'=>$user->id]) }}" title="Utilisateur" class="btn btn-default btn-block btn-sm">
                                                      <i class="fa fa-user"></i> User
                                                   </a>
                                                </div>
                                             </li>
                                             <li class="dropdown-divider"></li>
                                             <li class="dropdown-item">
                                                <div class="d-grid">
                                                   <a href="{{ route('access_ressource.update_page',['user_id'=>$user->id]) }}" title="Privileges" class="btn btn-default btn-block btn-sm">
                                                      <i class="fa fa-shield"></i> Privilegies
                                                   </a>
                                                </div>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              @endif
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <!-- fin table-responsive  -->
               </div>
               <!-- fin card-body -->   
            </div>
            <!-- fin card -->
         </div>
         <!-- fin card-body -->
      </div>
      <!-- fin card -->
      
      <script>
         new DataTable('#example', {
    layout: {
        topStart: {
            buttons: ['copy', 'excel', 'pdf', 'colvis']
        }
    }
});
      </script>

   </div>      
   @endsection
</body>
</html>
