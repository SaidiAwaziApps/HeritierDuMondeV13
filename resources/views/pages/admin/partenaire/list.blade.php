  
    @extends('layouts.admin')

    @section('content')
    <div class="global-content">
        <div class="card">

            <div class="card-header">
                <span class="card-title">
                    <i class="fas fa-handshake"></i> Partenaires              
                </span>
                <a href="{{ route('admin.partenaire.register_page') }}" title="Ajouter un partenaire">
                    <i class="fa fa-plus"></i>
                </a>
            </div>

            <div class="card-body">
                
                <div class="partners-list">
                    <div class="partners-list-content">

                        @forelse($partenaires as $partenaire)
                        
                        <div class="partner-item">

                            <ul class="list-group">

                                <li class="list-group-item">
                                    <div class="partner-item-logo">
                                        <a href="{{ Storage::url($partenaire->logo) }}" title="{{ $partenaire->description }}">
                                            <img src="{{ Storage::url($partenaire->logo) }}" alt="Logo {{ $partenaire->logo }}" class="rounded-thumbnail" style="width: 100%; height: 100%;" title="{{ $partenaire->description }}">
                                        </a>    
                                    </div>
                                </li>

                                @if($partenaire->sociaux)
                                <li class="list-group-item">
                                    <div class="partner-item-sociaux">
                                        <ul>

                                            @if($partenaire->sociaux->facebook)
                                            <li>
                                                <a href="{{ $partenaire->sociaux->facebook }}" title="Aller sur Facebook">
                                                    <i class="fa fa-facebook" style="color: blue;"></i>
                                                </a>
                                            </li>
                                            @endif

                                            @if($partenaire->sociaux->twitter)
                                            <li>
                                                <a href="{{ $partenaire->sociaux->twitter }}" title="Aller sur Twitter">
                                                    <i class="fa fa-twitter" style="color: #00acee;"></i>
                                                </a>
                                            </li>
                                            @endif

                                            @if($partenaire->sociaux->linkedIn)
                                            <li>
                                                <a href="{{ $partenaire->sociaux->linkedIn }}" title="Aller sur LinkedIn">
                                                    <i class="fab fa-linkedin-in" style="color: #0A66C2;"></i>
                                                </a>
                                            </li>
                                            @endif

                                            @if($partenaire->sociaux->instagram)
                                            <li>
                                                <a href="{{ $partenaire->sociaux-> instagram }}" title="Aller sur Instagram">
                                                    <i class="fa fa-instagram" style="color: #C32AA3;"></i>
                                                </a>
                                            </li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>
                                @endif

                                <li class="list-group-item">
                                    <div class="partner-item-actions">
                                        
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.partenaire.update_page', ['id' => $partenaire->id]) }}" class="btn btn-primary btn-sm active" title="Cliquer pour modifier">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.partenaire.delete_one', ['id' => $partenaire->id]) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button onclick="return confirm('Voulez vous supprimer ?')" type="submit" class="btn btn-danger btn-sm" title="Cliquer pour supprimer">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>

                                    </div>
                                </li>

                            </ul>

                        </div>

                        @empty

                        <div class="not-found-items">
                            <p>
                                Aucun partenaire trouve !!!
                            </p>
                        </div>

                        @endforelse

                    </div>
                </div>
               
            </div>

        </div>    
    </div>
    @endsection