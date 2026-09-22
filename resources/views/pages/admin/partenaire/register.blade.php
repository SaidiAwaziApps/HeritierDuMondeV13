
    @extends('layouts.admin')

    @section('content')
    <div class="global-content">
        <div class="card">

            <div class="card-header">
                <span class="card-title">
                    <i class="fas fa-handshake"></i> Partenaires              
                </span>
                <a href="{{ route('admin.offre_service.list') }}" title="Afficher la liste">
                    <i class="fa fa-list"></i>
                </a>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('admin.partenaire.save') }}" enctype="multipart/form-data" class="partner-form">
                    @csrf
                    
                    <div class="identite">
                        <input type="hidden" name="identite_id" id="identite_id" value="{{ $identite->id }}">
                    </div>

                    <div class="nom">

                        <div class="form-group">
                            <label for="nom">
                                Nom:<i id="required-sign">*</i>
                            </label>
                            <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrer le nom du partenaire" maxlength="100" required>
                        </div>                        
                    </div>

                    <div class="type">
                        <div class="form-group">
                            <label for="partner_type">
                                Type:<i id="required-sign">*</i>
                            </label>
                            <select name="partner_type" id="partner_type" class="form-control" required>
                                <option value="">Specifier le type de partenaire</option>
                                <option value="ONG internationale">ONG internationale</option>
                                <option value="ONG nationale">ONG nationale</option>
                                <option value="Organisation communautaire">Organisations communautaire</option>
                                <option value="Organisation de la société civile">Organisation de la société civile</option>
                                <option value="Organisation confessionnelle">Organisation confessionnelle</option>
                                <option value="Agence de Nations Unies">Agence des Nations Unies</option>
                                <option value="Institution gouvernementale">Institution gouvernementale</option>
                                <option value="Bailleur de fond">Bailleur de fonds</option>
                                <option value="Institution financière internationale">Institution financière internationale</option>
                                <option value="Fondation">Fondation</option>
                                <option value="Secteur privé">Secteur privé</option>
                                <option value="Institution académique et de recherche">Institution académique et de recherche</option>
                                <option value="Réseaux et consortiums">Réseaux et consortiums</option>
                                <option value="Média">Média</option>
                                <option value="Partenaires financiers">Partenaires financiers</option>
                                <option value="Partenaires techniques">Partenaires techniques</option>
                            </select>
                        </div>
                    </div>

                    <div class="site-web">
                        <div class="form-group">
                            <label for="site_web">
                                Site web:<i id="not-required-sign">*</i>
                            </label>
                            <input type="url" name="site_web" id="site_web" class="form-control" placeholder="Entrer Lien site web">
                        </div>
                    </div>     
                    
                    <div class="socials">

                        <h6> Inserer liens sociaux: <i class="fa fa-facebook" style="color: blue;"></i> <i class="fa fa-twitter" style="color: #00acee;"></i> <i class="fab fa-linkedin-in" style="color: #0A66C2;"></i> <i class="fa fa-instagram" style="color: #C32AA3;"></i> </h6>

                        <div class="socials-content">

                            <div class="form-group">
                                <label for="facebook">
                                    <i class="fa fa-facebook" style="color: blue;"></i> Facebook:<i id="not-required-sign">*</i>
                                </label>
                                <input type="url" name="facebook" id="facebook" class="form-control" placeholder="Lien facebook">
                            </div>

                            <div class="form-group">
                                <label for="twitter">
                                    <i class="fa fa-twitter" style="color: #00acee;"></i> Twitter:<i id="not-required-sign">*</i>
                                </label>
                                <input type="url" name="twitter" id="twitter" class="form-control" placeholder="Lien Twitter">
                            </div>

                            <div class="form-group">
                                <label for="linkedIn">
                                    <i class="fab fa-linkedin-in" style="color: #0A66C2;"></i> LinkedIn+:<i id="not-required-sign">*</i>
                                </label>
                                <input type="url" name="linkedIn" id="linkedIn" class="form-control" placeholder="Lien LinkedIn">
                            </div>

                            <div class="form-group">
                                <label for="instagram">
                                    <i class="fa fa-instagram" style="color: #C32AA3;"></i> Instagram:<i id="not-required-sign">*</i>
                                </label>
                                <input type="url" name="instagram" id="instagram" class="form-control" placeholder="Lien Instagram">
                            </div>

                        </div>

                    </div>

                    <div class="description">
                        <div class="form-group">
                            <label for="description">
                                Description:<i id="not-required-sign">*</i>
                            </label>
                            <textarea name="description" id="description" cols="30" rows="4" placeholder="Description du partenaire" class="form-control"></textarea>
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
                        <div id="validate_errors_bloc">
                            @foreach($errors->all() as $error)
                            <span>
                                {{ $error }} 
                            </span>
                            @endforeach
                        </div>
                    @endif

                </form>
            </div>  

        </div> 

        <!-- Scripts externes -->
        <script src="{{ asset('script/pages/admin/partenaire/register.js') }}"></script> 

    </div>
    @endsection