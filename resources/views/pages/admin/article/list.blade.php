<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>

    <style>
        div.card-header span {
            font-size: 20px;
            /* font-weight: bold; */
            font-family: italic;
        }

        div.card-header span i {
            opacity: 0.6;
        }

        div.card-header a {
            float: right;
        }

        table thead tr th,
        table tbody tr td {
            font-size: 17px;
            font-family: italic;
        }

        table thead tr th:nth-child(n+6) {
            text-align: center;
        }

        table tbody tr td:nth-child(5) {
            padding-top: 16px;
        }

        table tbody tr td:nth-child(5) a {
            color: black;
            text-decoration: none;
            padding: 8px;
            background-color: #f8f8ff;
            border-radius: 12px;
        }

        table tbody tr td:nth-child(6) div.d-grid a {
            border: 1px solid #ccc;
        }

        
        table tbody tr td:nth-child(5) a:hover{
            opacity: 0.5;
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
                   <i class="fa fa-list"></i> Liste articles
                </span>
                @if(session('user')->hasAccessToRessource('blog','register','allowed'))
                <a href="{{ route('article.register') }}" class="btn btn-default btn-sm active">
                    <i class="fa fa-plus"></i>
                </a>
                @endif
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
                                @if(session('user')->hasAccessToRessource('blog','delete','allowed'))
                                <th>
                                    <i class="fa fa-trash"></i>
                                </th>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(session('user')->hasAccessToRessource('blog','update','allowed')) 
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
                                        <a href="{{ route('article.details',['id'=>$article->id]) }}" title="Appuyer pour plus infos" class="btn btn-default btn-sm btn-block">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </td>
                                <!-- Autorisation acquise -->
                                @if(session('user')->hasAccessToRessource('blog','delete','allowed'))
                                <td>
                                    <form method="POST" action="{{ route('article.delete_one',['id'=>$article->id]) }}">
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
                                @if(session('user')->hasAccessToRessource('blog','update','allowed'))
                                <td>
                                    <div class="grid">
                                        <a href="{{ route('article.update_page',['id'=>$article->id]) }}" title="Appuyer pour modifier" class="btn btn-primary btn-sm active">
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

</body>
</html>