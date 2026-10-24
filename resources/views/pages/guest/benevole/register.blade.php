
@extends('layouts.guest')

@section('content')

<div class="page-content">
   
    <!-- =====================================================
        Bloc Titre de la page
    ====================================================== -->
    <div class="page-title">
        <h1>
            <i class="fa fa-users"></i> Benevoles
        </h1>
    </div>


    <!-- =====================================================
        Bloc Titre de la page
    ====================================================== -->
    <div class="volunters">

        <h2>
            Devenez bénévole et changez des vies !
        </h2>

        <!-- <p>

            <span> 
                Votre temps, vos compétences et votre engagement peuvent redonner espoir à ceux qui en ont le plus besoin.
            </span>

            Face aux nombreux défis humanitaires, chaque geste de solidarité compte. En rejoignant notre équipe de bénévoles, vous contribuez activement à améliorer les conditions de vie des personnes vulnérables, à soutenir les familles en difficulté et à bâtir un avenir plus humain et solidaire.

            Que vous soyez étudiant, professionnel ou simplement animé par le désir d'aider les autres, votre contribution est précieuse. Ensemble, nous pouvons transformer la compassion en actions concrètes, apporter du réconfort aux personnes en détresse et redonner le sourire à ceux qui ont perdu espoir.

            <span>
                N'attendez pas d'avoir beaucoup pour donner : votre volonté d'agir est déjà un grand pas vers le changement.
            </span>

            Rejoignez notre communauté de bénévoles et devenez un acteur du changement. Parce qu'ensemble, nous pouvons faire davantage, chaque bénévole compte et chaque action peut changer une vie.

            <span>
                Engagez-vous aujourd'hui. Partagez votre humanité. Construisons ensemble un monde meilleur !
            </span>

        </p> -->

        <div class="volunters-content">
        
            <form id="volunters-register-form" action="{{ route('guest.benevole.save') }}" method="post" enctype="multipart/form-data">

                @csrf

                <!-- <h3>
                    <i>Rejoignez nous</i><br>
                    Devenez bénévole
                </h3> -->

                <div class="volunters-form-content">

                    <!-- =====================================================
                        Bloc Photo de profil
                    ====================================================== -->

                    <div class="profil">

                        <div class="profile-photo">
                            <label for="photo" class="photo-label">
                                <div class="photo-circle">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                </div>

                                <span class="photo-add">+</span>
                            </label>

                            <input
                                type="file"
                                name="photo"
                                id="photo"
                                accept="image/jpeg,image/png"
                                hidden
                            >

                        </div>

                    </div> <!-- fin bloc .profil -->


                    <!-- =====================================================
                        Bloc Identité
                    ====================================================== -->

                    <div class="nom-prenom">

                        <div class="form-group">
                            <label for="nom">
                                Nom:<i id="required-sign">*</i>
                            </label>

                            <input
                                type="text"
                                name="nom"
                                id="nom"
                                class="form-control"
                                placeholder="Entrer le nom"
                                maxlength="40"
                                autocomplete="family-name"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="prenom">
                                Prénom:<i id="required-sign">*</i>
                            </label>

                            <input
                                type="text"
                                name="prenom"
                                id="prenom"
                                class="form-control"
                                placeholder="Entrer le prénom"
                                maxlength="40"
                                autocomplete="given-name"
                                required
                            >
                        </div>

                    </div> <!-- fin bloc .nom-prenom -->


                    <!-- =====================================================
                        Bloc sexe
                    ====================================================== -->

                    <div class="sexe">

                        <div class="sexe-content">
                            <label for="sexe">
                                Sexe:<i id="required-sign">*</i>
                            </label>

                            <input type="radio" name="sexe" id="sexe" value="M"> <span>M</span>
                            <input type="radio" name="sexe" id="sexe" value="F"> <span>F</span>
                        </div>    

                    </div> <!-- fin bloc .sexe -->


                    <!-- =====================================================
                        Bloc Telephone && Email
                    ====================================================== -->

                    <div class="tel-email">

                        <div class="form-group">

                            <label for="tel">
                                Numéro de téléphone avec indicatif international:
                                <i id="required-sign">*</i>
                            </label>

                            <input
                                type="tel"
                                name="tel"
                                id="tel"
                                class="form-control"
                                placeholder="Exemple : +257 00 00 00 00"
                                autocomplete="tel"
                                required
                            >
                        </div>
                       
                        <div class="form-group">
                            <label for="email">
                                Email:<i id="required-sign">*</i>
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control"
                                placeholder="Adresse email"
                                maxlength="150"
                                autocomplete="email"
                                required
                            >
                        </div>

                    </div> <!-- fin bloc .tel-email -->


                    <!-- =====================================================
                        Bloc Pays && ville
                    ====================================================== -->

                    <div class="pays-ville">

                        <div class="form-group">

                            <label for="pays">
                                Pays:<i id="required-sign">*</i>
                            </label>

                            @php
                                $pays = ['Afghanistan', 'Afrique du Sud', 'Albanie', 'Algérie', 'Allemagne', 'Andorre', 'Angola', 'Antigua-et-Barbuda', 'Arabie saoudite', 'Argentine', 'Arménie', 'Australie', 'Autriche', 'Azerbaïdjan', 'Bahamas', 'Bahreïn', 'Bangladesh', 'Barbade', 'Belgique', 'Belize', 'Bénin', 'Bhoutan', 'Biélorussie', 'Birmanie', 'Bolivie', 'Bosnie-Herzégovine', 'Botswana', 'Brésil', 'Brunei', 'Bulgarie', 'Burkina Faso', 'Burundi', 'Cambodge', 'Cameroun', 'Canada', 'Cap-Vert', 'Chili', 'Chine', 'Chypre', 'Colombie', 'Comores', 'Congo', 'Corée du Nord', 'Corée du Sud', 'Costa Rica', 'Côte d’Ivoire', 'Croatie', 'Cuba', 'Danemark', 'Djibouti', 'Dominique', 'Égypte', 'Émirats arabes unis', 'Équateur', 'Érythrée', 'Espagne', 'Estonie', 'Eswatini', 'États-Unis', 'Éthiopie', 'Fidji', 'Finlande', 'France', 'Gabon', 'Gambie', 'Géorgie', 'Ghana', 'Grèce', 'Grenade', 'Guatemala', 'Guinée', 'Guinée-Bissau', 'Guinée équatoriale', 'Guyana', 'Haïti', 'Honduras', 'Hongrie', 'Inde', 'Indonésie', 'Irak', 'Iran', 'Irlande', 'Islande', 'Israël', 'Italie', 'Jamaïque', 'Japon', 'Jordanie', 'Kazakhstan', 'Kenya', 'Kirghizistan', 'Kiribati', 'Koweït', 'Laos', 'Lesotho', 'Lettonie', 'Liban', 'Libéria', 'Libye', 'Liechtenstein', 'Lituanie', 'Luxembourg', 'Macédoine du Nord', 'Madagascar', 'Malaisie', 'Malawi', 'Maldives', 'Mali', 'Malte', 'Maroc', 'Îles Marshall', 'Maurice', 'Mauritanie', 'Mexique', 'Micronésie', 'Moldavie', 'Monaco', 'Mongolie', 'Monténégro', 'Mozambique', 'Namibie', 'Nauru', 'Népal', 'Nicaragua', 'Niger', 'Nigéria', 'Norvège', 'Nouvelle-Zélande', 'Oman', 'Ouganda', 'Ouzbékistan', 'Pakistan', 'Palaos', 'Palestine', 'Panama', 'Papouasie-Nouvelle-Guinée', 'Paraguay', 'Pays-Bas', 'Pérou', 'Philippines', 'Pologne', 'Portugal', 'Qatar', 'République centrafricaine', 'République démocratique du Congo', 'République dominicaine', 'République tchèque', 'Roumanie', 'Royaume-Uni', 'Russie', 'Rwanda', 'Saint-Christophe-et-Niévès', 'Saint-Marin', 'Saint-Vincent-et-les-Grenadines', 'Sainte-Lucie', 'Îles Salomon', 'Salvador', 'Samoa', 'Sao Tomé-et-Principe', 'Sénégal', 'Serbie', 'Seychelles', 'Sierra Leone', 'Singapour', 'Slovaquie', 'Slovénie', 'Somalie', 'Soudan', 'Soudan du Sud', 'Sri Lanka', 'Suède', 'Suisse', 'Suriname', 'Syrie', 'Tadjikistan', 'Tanzanie', 'Tchad', 'Thaïlande', 'Timor oriental', 'Togo', 'Tonga', 'Trinité-et-Tobago', 'Tunisie', 'Turkménistan', 'Turquie', 'Tuvalu', 'Ukraine', 'Uruguay', 'Vanuatu', 'Vatican', 'Venezuela', 'Viêt Nam', 'Yémen', 'Zambie', 'Zimbabwe'];
                            @endphp

                            <select name="pays" id="pays" class="form-control" autocomplete="country-name" required>

                                <option value="">Sélectionner un pays</option>

                                @foreach($pays as $nomPays)
                                    <option value="{{ $nomPays }}">
                                        {{ $nomPays }}
                                    </option>
                                @endforeach

                            </select>
                            
                        </div>

                        <div class="form-group">
                            <label for="ville">
                                Ville:<i id="required-sign">*</i>
                            </label>

                            <input
                                type="text"
                                name="ville"
                                id="ville"
                                class="form-control"
                                placeholder="Entrer la ville"
                                maxlength="100"
                                autocomplete="address-level2"
                                required
                            >
                        </div>

                    </div> <!-- fin bloc .pays-ville -->


                    

                    <!-- =====================================================
                        Bloc Réseaux sociaux
                    ====================================================== -->

                    <div class="socials">

                        <h5>
                            Insérer vos liens sociaux:
                            <i class="fa fa-facebook" style="color: blue;" aria-hidden="true"></i>
                            <i class="fa fa-twitter" style="color: #00acee;" aria-hidden="true"></i>
                            <i class="fab fa-linkedin-in" style="color: #0A66C2;" aria-hidden="true"></i>
                            <i class="fa fa-instagram" style="color: #C32AA3;" aria-hidden="true"></i>
                        </h5>

                        <div class="socials-content">

                            <div class="form-group">
                                <label for="facebook">
                                    <i class="fa fa-facebook" style="color: blue;" aria-hidden="true"></i>
                                    Facebook:
                                </label>

                                <input
                                    type="url"
                                    name="facebook"
                                    id="facebook"
                                    class="form-control"
                                    placeholder="Lien Facebook"
                                    maxlength="500"
                                >
                            </div>

                            <div class="form-group">
                                <label for="twitter">
                                    <i class="fa fa-twitter" style="color: #00acee;" aria-hidden="true"></i>
                                    Twitter:
                                </label>

                                <input
                                    type="url"
                                    name="twitter"
                                    id="twitter"
                                    class="form-control"
                                    placeholder="Lien Twitter"
                                    maxlength="500"
                                >
                            </div>

                            <div class="form-group">
                                <label for="linkedIn">
                                    <i class="fab fa-linkedin-in" style="color: #0A66C2;" aria-hidden="true"></i>
                                    LinkedIn:
                                </label>

                                <input
                                    type="url"
                                    name="linkedIn"
                                    id="linkedIn"
                                    class="form-control"
                                    placeholder="Lien LinkedIn"
                                    maxlength="500"
                                >
                            </div>

                            <div class="form-group">
                                <label for="instagram">
                                    <i class="fa fa-instagram" style="color: #C32AA3;" aria-hidden="true"></i>
                                    Instagram:
                                </label>

                                <input
                                    type="url"
                                    name="instagram"
                                    id="instagram"
                                    class="form-control"
                                    placeholder="Lien Instagram"
                                    maxlength="500"
                                >
                            </div>

                        </div>

                    </div> <!-- fin bloc .socials -->


                    <!-- =====================================================
                        Bloc Profil professionnel
                    ====================================================== -->

                    <div class="profession">

                        <div class="form-group">
                            <label for="profession">
                                Profession ou domaine d'activité:<i id="required-sign">*</i>
                            </label>

                            <input
                                type="text"
                                name="profession"
                                id="profession"
                                class="form-control"
                                placeholder="Exemple : enseignant, infirmier, étudiant..."
                                maxlength="150"
                            >
                        </div>

                    </div> <!-- fin bloc .profession -->


                    <!-- =====================================================
                        Bloc Compétences
                    ====================================================== -->

                    <div class="competences">

                        <div class="form-group">
                            <label for="competences">
                                Compétences et savoir-faire :
                                <i id="required-sign">*</i>
                            </label>

                            <textarea
                                name="competences"
                                id="competences"
                                class="form-control"
                                rows="4"
                                maxlength="2000"
                                placeholder="Décrivez vos compétences, par exemple en santé, éducation, informatique, logistique, traduction..."
                                required
                            ></textarea>
                        </div>

                    </div> <!-- fin bloc .competences -->


                    <!-- =====================================================
                        Bloc Langues parlées
                    ====================================================== -->

                    <div class="langues">

                        <div class="form-group">
                            <label for="langues">
                                Langues parlées :
                                <i id="required-sign">*</i>
                            </label>

                            <input
                                type="text"
                                name="langues"
                                id="langues"
                                class="form-control"
                                maxlength="500"
                                placeholder="Exemple : français, anglais, swahili, kirundi..."
                                required
                            >
                        </div>

                    </div> <!-- fin bloc .langues -->


                    <!-- =====================================================
                        Bloc Expérience
                    ====================================================== -->

                    <div class="experience">

                        <div class="form-group">
                            <label for="experience">
                                Expérience en bénévolat ou dans l'humanitaire :
                            </label>

                            <textarea
                                name="experience"
                                id="experience"
                                class="form-control"
                                rows="4"
                                maxlength="3000"
                                placeholder="Décrivez vos expériences précédentes, les organisations avec lesquelles vous avez travaillé ou les activités auxquelles vous avez participé."
                            ></textarea>
                        </div>

                    </div> <!-- fin bloc .experience -->


                    <!-- =====================================================
                        Bloc Domaines d'intervention
                    ====================================================== -->

                    <div class="domaines-intervention">

                        <div class="form-group">

                            <label for="domaines-intervention">
                                Domaines d'intervention souhaités:<i id="required-sign">*</i>
                            </label>

                            <select
                                name="domaines_intervention[]"
                                id="domaines-intervention"
                                class="form-control"
                                multiple
                                size="5"
                                required
                            >
                                <option value="Santé">Santé et soins médicaux</option>
                                <option value="Éducation">Éducation et formation</option>
                                <option value="Aide alimentaire">Aide alimentaire et nutrition</option>
                                <option value="Eau et assainissement">Eau potable, hygiène et assainissement</option>
                                <option value="Protection">Protection des personnes vulnérables</option>
                                <option value="Protection de l'enfance">Protection de l'enfance</option>
                                <option value="Logistique">Logistique et distribution de matériel</option>
                                <option value="Informatique et communication">Informatique et communication</option>
                                <option value="Environnement">Environnement et développement communautaire</option>
                                <option value="Autre">Autre domaine</option>
                            </select>
                        </div>

                    </div> <!-- fin bloc .domaines-intervention -->


                    <!-- =====================================================
                        Bloc Disponibilités
                    ====================================================== -->

                    <div class="disponibilite">

                        <div class="form-group">
                            <label for="disponibilite">
                                Vos disponibilités:<i id="required-sign">*</i>
                            </label>
                            <select name="disponibilite" id="disponibilite" class="form-control">
                                <option value="">
                                     Indiquez les périodes pendant lesquelles vous pouvez participer aux activités.
                                </option>

                                <option value="semaine">Semaine</option>
                                <option value="weekend">Weekend</option>
                                <option value="ponctuelle">Ponctuelle</option>
                                <option value="reguliere">Reguliere</option>
                                 <option value="urgence">Urgence</option>
                            </select>
                        </div>

                    </div> <!-- fin bloc .disponibilites -->


                    <!-- =====================================================
                        Bloc Motivation
                    ====================================================== -->

                    <div class="motivation">

                        <div class="form-group">
                            <label for="motivation">
                                Pourquoi souhaitez-vous devenir bénévole au sein de notre organisation ?
                                <i id="required-sign">*</i>
                            </label>

                            <textarea
                                name="motivation"
                                id="motivation"
                                class="form-control"
                                rows="5"
                                maxlength="3000"
                                placeholder="Expliquez vos motivations et la manière dont vous souhaitez contribuer à nos actions humanitaires."
                                required
                            ></textarea>
                        </div>

                    </div> <!-- fin bloc .motivation -->


                    <!-- =====================================================
                        Bloc Consentement
                    ====================================================== -->

                    <div class="confidentialite">

                        <!-- <div class="form-group">

                            <input
                                type="checkbox"
                                name="confidentialite"
                                id="confidentialite"
                                value="1"
                                required
                            >

                            <label for="consentement_donnees">
                                J'accepte que les informations fournies soient utilisées pour traiter ma candidature de bénévole, conformément à la politique de confidentialité de l'organisation.
                                <i class="required-sign">*</i>
                            </label>

                        </div> -->

                    </div> <!-- fin bloc .confidentialite -->


                    <!-- =====================================================
                        Bloc Soumission
                    ====================================================== -->

                    <div class="submit-bloc">

                        <button type="submit">
                            <i class="fa-solid fa-paper-plane"></i> Soumettre ma candidature
                        </button>

                    </div> <!-- fin bloc .submit-bloc -->


                    
                    <!-- Toast de feedback -->
                    <div class="toast-container position-fixed top-0 end-0 p-3">

                        <!-- Toast de succès -->
                        @if(session('success')) 
                        <div id="successToast" class="toast text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
                            </div>
                        </div>
                        @endif

                        <!-- Toast d'erreur -->
                        @if($errors->any()) 
                        <div id="errorToast" class="toast text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                   
                                    {{ implode(',', $errors->all()) }}

                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
                            </div>
                        </div>
                        @endif

                    </div> <!-- fin bloc toast .toast-container -->

                </div> <!-- fin bloc .volunters-form-content -->

            </form>

        </div>

    </div>

    <!-- Script externe -->
    <script src="{{ asset('script/pages/guest/benevole/register.js') }}"></script> 

</div>    

@endsection
