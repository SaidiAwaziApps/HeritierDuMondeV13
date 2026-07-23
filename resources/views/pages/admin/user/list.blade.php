
   @extends('layouts.admin')

   @section('content')
      @php $headTitle = 'Utilisateurs'; @endphp
   <div id="globalContent">
      <div class="card">
         <div class="card-header">
            <span class="card-title">
               <i class="fa fa-users"></i> Gestion utilisateurs
            </span>   
            <a href="{{ route('admin.user.register_page') }}" class="btn btn-default btn-sm active">
               <span>
                  <i class="fa fa-plus"></i>
               </span>
            </a>
         </div>
         <div class="card-body">
            <div class="card">
               <div class="card-body">  
                  <div class="table-responsive">
                     <table class="table table-bordered table-condensed table-striped" id="users_list_table">
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
                                       <a href="{{ route('admin.user.details',['id'=>$user->id]) }}" class="btn btn-default btn-block btn-sm">
                                          <i class="bi bi-plus"></i>
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                    <form action="{{ route('admin.user.delete_one',['id' => $user->id]) }}" method="post">
                                       @csrf
                                       @method('DELETE')
                                       <div class="d-grid">
                                          <button onclick="return confirm('Voulez vous supprimer ?')" type="submit" href="{{ route('admin.user.delete_one',['id'=>$user->id]) }}" class="btn btn-danger btn-block btn-sm" style="border: 1px solid #ccc;">
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
                                                   <a href="{{ route('admin.user.update_page',['id' => $user->id]) }}" title="Utilisateur" class="btn btn-default btn-block btn-sm">
                                                      <i class="fa fa-user"></i> User
                                                   </a>
                                                </div>
                                             </li>
                                             <li class="dropdown-divider"></li>
                                             <li class="dropdown-item">
                                                <div class="d-grid">
                                                   <a href="{{ route('admin.access_ressource.update_page',['user_id' => $user->id]) }}" title="Privileges" class="btn btn-default btn-block btn-sm">
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

      <!-- Scripts externes -->
      <script src="{{ asset('script/pages/admin/user/list.js') }}"></script> 

   </div>      
   @endsection

