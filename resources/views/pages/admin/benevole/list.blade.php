
@extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                   <i class="fas fa-hands-helping"></i>  Nos benevoles
                </h4>
            </div>
            <div class="card-body">
                <!-- Presence de instances benevoles -->
                @if($benevoles && count($benevoles) > 0)
                <div class="autocomplete" >
                    <input
                        type="text"
                        id="search"
                        placeholder="Rechercher un benevole"
                        autocomplete="off" class="form-control">

                    <div id="suggestions"></div>
                </div>

                <div id="item_data_content">
                    @foreach($benevoles as $benevole)
                    <div class="card">
                        <div class="card-body">
                            <div class="data_item">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="profil_bloc">
                                            <a href="{{ $benevole->photo ? Storage::url($benevole->photo) : asset('image/default_benevole.png') }}">
                                                <img src="{{ $benevole->photo ? Storage::url($benevole->photo) : asset('image/default_benevole.png') }}" alt="{{ $benevole->nom }}" title="Profil {{ $benevole->nom }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('admin.benevole.details',['id'=>$benevole->id]) }}"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover focus"
                                           data-bs-placement="top"
                                           data-bs-content="Consulter les détails de ce bénévole."
                                           aria-label="Détails de {{ $benevole->nom }} {{ $benevole->prenom }}">
                                            <span>
                                                {{ $benevole->nom.' '.$benevole->prenom }} <i class="fa fa-plus"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        @php
                                            $sociaux = $benevole->sociaux;
                                        @endphp

                                        @if($sociaux && ($sociaux->facebook || $sociaux->twitter || $sociaux->linkedIn || $sociaux->instagram))

                                            @if($sociaux->facebook)
                                                <a href="{{ $sociaux->facebook }}" target="_blank" rel="noopener noreferrer"
                                                   data-bs-toggle="popover"
                                                   data-bs-trigger="hover focus"
                                                   data-bs-placement="top"
                                                   data-bs-content="Visiter le profil Facebook de {{ $benevole->nom }}."
                                                   aria-label="Facebook de {{ $benevole->nom }}">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            @endif

                                            @if($sociaux->twitter)
                                                <a href="{{ $sociaux->twitter }}" target="_blank" rel="noopener noreferrer"
                                                   data-bs-toggle="popover"
                                                   data-bs-trigger="hover focus"
                                                   data-bs-placement="top"
                                                   data-bs-content="Visiter le profil Twitter de {{ $benevole->nom }}."
                                                   aria-label="Twitter de {{ $benevole->nom }}">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            @endif

                                            @if($sociaux->linkedIn)
                                                <a href="{{ $sociaux->linkedIn }}" target="_blank" rel="noopener noreferrer"
                                                   data-bs-toggle="popover"
                                                   data-bs-trigger="hover focus"
                                                   data-bs-placement="top"
                                                   data-bs-content="Visiter le profil LinkedIn de {{ $benevole->nom }}."
                                                   aria-label="LinkedIn de {{ $benevole->nom }}">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            @endif

                                            @if($sociaux->instagram)
                                                <a href="{{ $sociaux->instagram }}" target="_blank" rel="noopener noreferrer"
                                                   data-bs-toggle="popover"
                                                   data-bs-trigger="hover focus"
                                                   data-bs-placement="top"
                                                   data-bs-content="Visiter le profil Instagram de {{ $benevole->nom }}."
                                                   aria-label="Instagram de {{ $benevole->nom }}">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            @endif

                                        @else
                                            <span class="text-muted">Aucun réseau social disponible.</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <!-- More option -->
                            <div class="data_more_option">
                                <button type="button" class="btn btn-default active btn-sm" title="Pour plus d' information sur {{ $benevole->nom }}">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </div>
                            <!---->
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Aucune instance trouvee (liste vide) -->
                @else
                <div class="not-found-items">
                    <span>Aucun resultat trouve !!!</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Script interne -->
        <script src="{{ asset('script/pages/admin/benevole/list.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof bootstrap !== 'undefined' && bootstrap.Popover) {
                    document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (element) {
                        new bootstrap.Popover(element);
                    });
                }
            });
        </script>

    </div>
    @endsection
