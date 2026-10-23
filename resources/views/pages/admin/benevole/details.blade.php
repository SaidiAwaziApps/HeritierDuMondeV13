
@extends('layouts.admin')

@section('content')
<div id="global_content">

    <!-- En-tête de la page -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <i class="fas fa-hands-helping"></i>
                Détails du bénévole
            </h5>
        </div>

        <div class="card-body">

            <!-- Identité et informations personnelles -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-user"></i>
                        Identité et informations personnelles
                    </h6>
                </div>

                <div class="card-body">
                    <div id="benevole_info">

                        <!-- Photo de profil -->
                        <div id="profil_bloc">
                            <div class="card">
                                <div class="card-body">
                                    @if(!empty($benevole->photo))
                                        <a href="{{ Storage::url($benevole->photo) }}"
                                           title="Profil de {{ $benevole->nom }}">
                                            <img
                                                src="{{ Storage::url($benevole->photo) }}"
                                                alt="Photo de profil de {{ $benevole->nom }}"
                                                class="rounded-thumbnail cover"
                                            >
                                        </a>
                                    @else
                                        <div id="profil_placeholder">
                                            <i class="fas fa-user-circle"></i>
                                            <span>Aucune photo disponible</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Informations personnelles -->
                        <div id="meta_bloc">
                            <ul class="list-group">

                                <li class="list-group-item">
                                    <span>Nom :</span>
                                    <span>{{ $benevole->nom }}</span>
                                </li>

                                <li class="list-group-item">
                                    <span>Prénom :</span>
                                    <span>{{ $benevole->prenom }}</span>
                                </li>

                                <li class="list-group-item">
                                    <span>Sexe :</span>
                                    <span>{{ $benevole->sexe }}</span>
                                </li>

                                <li class="list-group-item">
                                    <span>Email :</span>
                                    <span>{{ $benevole->email }}</span>
                                </li>

                                <li class="list-group-item">
                                    <span>Téléphone :</span>
                                    <span>{{ $benevole->tel }}</span>
                                </li>

                                <li class="list-group-item">
                                    <span>Pays :</span>
                                    <span>{{ $benevole->pays }}</span>
                                </li>

                                <li class="list-group-item">
                                    <span>Ville :</span>
                                    <span>{{ $benevole->ville }}</span>
                                </li>

                                <li class="list-group-item">
                                    <span>Profession :</span>
                                    <span>{{ $benevole->profession }}</span>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Profil humanitaire -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-hand-holding-heart"></i>
                        Profil humanitaire et compétences
                    </h6>
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-12">
                            <div class="benevole-detail-item">
                                <div class="benevole-detail-title">
                                    <i class="fas fa-tools"></i>
                                    Compétences
                                </div>
                                <div class="benevole-detail-content">
                                    {{ $benevole->competences ?: 'Aucune compétence renseignée.' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="benevole-detail-item">
                                <div class="benevole-detail-title">
                                    <i class="fas fa-briefcase"></i>
                                    Expérience
                                </div>
                                <div class="benevole-detail-content">
                                    {{ $benevole->experience ?: 'Aucune expérience renseignée.' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="benevole-detail-item">
                                <div class="benevole-detail-title">
                                    <i class="fas fa-language"></i>
                                    Langues parlées
                                </div>
                                <div class="benevole-detail-content">
                                    {{ $benevole->langues ?: 'Aucune langue renseignée.' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="benevole-detail-item">
                                <div class="benevole-detail-title">
                                    <i class="fas fa-hands-helping"></i>
                                    Domaines d’intervention
                                </div>
                                <div class="benevole-detail-content">
                                    {{ $benevole->domaines_intervention ?: 'Aucun domaine renseigné.' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="benevole-detail-item">
                                <div class="benevole-detail-title">
                                    <i class="fas fa-calendar-check"></i>
                                    Disponibilité
                                </div>
                                <div class="benevole-detail-content">
                                    {{ $benevole->disponibilite ?: 'Disponibilité non renseignée.' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="benevole-detail-item">
                                <div class="benevole-detail-title">
                                    <i class="fas fa-comment-dots"></i>
                                    Motivation
                                </div>
                                <div class="benevole-detail-content">
                                    {{ $benevole->motivation ?: 'Aucune motivation renseignée.' }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Réseaux sociaux -->
            <div class="card mb-4" id="sociaux_info">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-share-alt"></i>
                        Réseaux sociaux et contact
                    </h6>
                </div>

                <div class="card-body">
                    @if($benevole->sociaux)
                        <div id="sociaux_info_content">

                            <span class="sociaux-label">
                                Retrouver le bénévole sur :
                            </span>

                            <ul>
                                @if(!empty($benevole->sociaux->facebook))
                                    <li>
                                        <a href="{{ $benevole->sociaux->facebook }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           title="Facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                @endif

                                @if(!empty($benevole->sociaux->twitter))
                                    <li>
                                        <a href="{{ $benevole->sociaux->twitter }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           title="Twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                @endif

                                @if(!empty($benevole->sociaux->linkedIn))
                                    <li>
                                        <a href="{{ $benevole->sociaux->linkedIn }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           title="LinkedIn">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                @endif

                                @if(!empty($benevole->sociaux->instagram))
                                    <li>
                                        <a href="{{ $benevole->sociaux->instagram }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           title="Instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>

                            @if(
                                empty($benevole->sociaux->facebook) &&
                                empty($benevole->sociaux->twitter) &&
                                empty($benevole->sociaux->linkedIn) &&
                                empty($benevole->sociaux->instagram)
                            )
                                <p class="text-muted mb-0">
                                    Aucun réseau social renseigné.
                                </p>
                            @endif

                        </div>
                    @else
                        <p class="text-muted mb-0">
                            Aucun réseau social renseigné.
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
