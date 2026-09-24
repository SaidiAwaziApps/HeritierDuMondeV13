
    @extends('layouts.admin')

    @section('content')
    <div class="global-content">
        <div class="card">

            <div class="card-header">
                <span class="card-title">
                    <i class="fas fa-handshake"></i> Partenaires              
                </span>
                <a href="{{ route('admin.partenaire.list') }}" title="Afficher la liste">
                    <i class="fa fa-list"></i>
                </a>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('admin.partenaire.update_handler', ['id' => $partenaire->id]) }}" enctype="multipart/form-data" class="partner-form">

                    @csrf
                    @method("PUT")

                    <div class="nom">

                        <div class="form-group">
                            <label for="nom">
                                Nom:<i id="required-sign">*</i>
                            </label>
                            <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrer le nom du partenaire" maxlength="100" value="{{ $partenaire->nom }}"  required>
                        </div>                        
                    </div>

                    <div class="type">
                        <div class="form-group">
                            <label for="partner_type">
                                Type:<i id="required-sign">*</i>
                            </label>
                            <select name="partner_type" id="partner_type" class="form-control" required>

                                <option value="{{ $partenaire->partner_type }}"> {{ $partenaire->partner_type }} </option>
                                
                                @php
                                    // Types predefinis
                                    $parteners_types = [
                                        'ONG internationale', 'ONG nationale', 'Organisation communautaire', 'Organisation de la société civile',
                                        'Organisation confessionnelle', 'Agence de Nations Unies', 'Institution gouvernementale',
                                        'Bailleur de fonds', 'Institution financière internationale', 'Fondation',
                                        'Secteur privé', 'Institution académique et de recherche', 'Réseaux et consortiums',
                                        'Média', 'Partenaires financiers', 'Partenaires techniques'
                                    ];
                                @endphp

                                @foreach($parteners_types as $partner_type)
                                    @if($partner_type != $partenaire->partner_type)
                                        <option value="{{ $partner_type }}"> {{ $partner_type }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="site-web">
                        <div class="form-group">
                            <label for="site_web">
                                Site web:<i id="not-required-sign">*</i>
                            </label>
                            <input type="url" name="site_web" id="site_web" class="form-control" placeholder="Entrer Lien site web" value="{{ $partenaire->site_web }}">
                        </div>
                    </div>     
                    
                    <div class="socials">

                        <h6> Inserer liens sociaux: <i class="fa fa-facebook" style="color: blue;"></i> <i class="fa fa-twitter" style="color: #00acee;"></i> <i class="fab fa-linkedin-in" style="color: #0A66C2;"></i> <i class="fa fa-instagram" style="color: #C32AA3;"></i> </h6>

                        <div class="socials-content">

                            <div class="form-group">
                                <label for="facebook">
                                    <i class="fa fa-facebook" style="color: blue;"></i> Facebook:<i id="not-required-sign">*</i>
                                </label>
                                <input type="url" name="facebook" id="facebook" class="form-control" placeholder="Lien facebook" value="{{ $partenaire->sociaux->facebook }}">
                            </div>

                            <div class="form-group">
                                <label for="twitter">
                                    <i class="fa fa-twitter" style="color: #00acee;"></i> Twitter:<i id="not-required-sign">*</i>
                                </label>
                                <input type="url" name="twitter" id="twitter" class="form-control" placeholder="Lien Twitter" value="{{ $partenaire->sociaux->twitter }}">
                            </div>

                            <div class="form-group">
                                <label for="linkedIn">
                                    <i class="fab fa-linkedin-in" style="color: #0A66C2;"></i> LinkedIn+:<i id="not-required-sign">*</i>
                                </label>
                                <input type="url" name="linkedIn" id="linkedIn" class="form-control" placeholder="Lien LinkedIn" value="{{ $partenaire->sociaux->linkedIn }}">
                            </div>

                            <div class="form-group">
                                <label for="instagram">
                                    <i class="fa fa-instagram" style="color: #C32AA3;"></i> Instagram:<i id="not-required-sign">*</i>
                                </label>
                                <input type="url" name="instagram" id="instagram" class="form-control" placeholder="Lien Instagram" value="{{ $partenaire->sociaux->instagram }}">
                            </div>

                        </div>

                    </div>

                    <div class="description">
                        <div class="form-group">
                            <label for="description">
                                Description:<i id="not-required-sign">*</i>
                            </label>
                            <textarea name="description" id="description" cols="30" rows="4" placeholder="Description du partenaire" class="form-control" value="{{ $partenaire->description }}"></textarea>
                        </div>
                    </div>

                    <div class="logo">
                        <div class="form-group">
                            <label for="logo">
                               <i class="fa fa-image"></i> Inserer logo 
                            </label>
                            <span id="logo-img-name"></span>
                            <input type="file" accept="image/*" name="logo" id="logo" class="form-control">
                        </div>
                    </div>

                    <div class="submit-button">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-sm btn-block active">
                                <span>
                                    <i class="fa fa-upload"></i> Enregistrer
                                </span>
                            </button>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="validator-errors">
                            @foreach($errors->all() as $error)
                            <div class="validator-error-item">
                                <span>
                                    {{ $error }} 
                                </span>
                            </div>
                            @endforeach
                        </div>
                    @endif

                </form>
            </div>  

        </div> 

        <!-- Scripts internes -->
        <script type="text/javascript">
            let partenaire = @json($partenaire);
        </script> 

        <!-- Scripts externes -->
        <script src="{{ asset('script/pages/admin/partenaire/update.js') }}"></script> 

    </div>
    @endsection