
    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <span class="card-title" style="font-weight: bold;opacity: 0.5;">
                    <i class="fa fa-blog" style="opacity: 0.4"></i> Tous les articles
                </span>
                <a href="{{ route('admin.article.register_page') }}" title="Nouveau article" class="btn btn-default btn-sm">
                    <i class="fa fa-plus"></i>
                </a>  
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Titre
                                </th>
                                <th>
                                    Categorie
                                </th>
                                <th>
                                    Auteur
                                </th>
                                <th>
                                    <i class="fa fa-plus"></i>
                                </th>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('blog','delete','allowed'))
                                <th>
                                    <i class="fa fa-trash"></i>
                                </th>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('blog','update','allowed')) 
                                <th>
                                    <i class="fa fa-pencil-square"></i>
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index=0; ?>
                            @foreach($articles as $article)
                            <?php $index++;?>
                            <tr>
                                <td>
                                    {{ $index }}
                                </td>
                                <td>
                                    {{ $article->created_at->format('d-m-y') }}
                                </td>
                                <td>
                                    {{ $article->titre }}
                                </td>
                                <td>
                                    {{ $article->categorie->nom }}
                                </td>
                                <td>
                                    <a href="{{ Storage::url($article->auteur->morphModel()->photo) }}" title="Profil de l'auteur">
                                        <i> 
                                            {{ $article->auteur->morphModel()->nom }}
                                        </i>    
                                    </a>    
                                </td>
                                <td>
                                    <div class="d-grid">
                                        <a href="{{ route('admin.article.details',['id' => $article->id]) }}" title="Appuyer pour plus infos" class="btn btn-default btn-sm btn-block">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </td>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('blog','delete','allowed'))
                                <td>
                                    <form method="POST" action="{{ route('admin.article.delete_one',['id' => $article->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-grid">
                                            <button type="submit" onclick="confirm('Voulez vous supprimer ?')" title="Click pour supprimer" class="btn btn-danger btn-sm">
                                                <span>
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('blog','update','allowed'))
                                <td>
                                    <div class="grid">
                                        <a href="{{ route('admin.article.update_page',['id' => $article->id]) }}" title="Appuyer pour modifier" class="btn btn-primary btn-sm active">
                                            <i class="fa fa-pencil-square"></i>
                                        </a>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection

