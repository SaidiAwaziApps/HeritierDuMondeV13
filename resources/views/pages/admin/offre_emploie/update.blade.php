
    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fa fa-tasks"></i> Offre d'emploie               
                </span>
                <a href="{{ route('admin.offre_emploie.list') }}" title="Afficher la liste">
                    <i class="fa fa-list"></i>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.offre_emploie.update_handler',['id' => $offre_emploie->id]) }}" enctype="multipart/form-data">
                    <div id="form_content">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="date_emission">
                                Date:<i id="required-sign">*</i>
                            </label>
                            <input type="date" name="date_emission" id="date_emission" class="form-control" value="{{ $offre_emploie->date_emission }}" required>
                        </div>
                        <div class="form-group">
                            <label for="domaine">
                                Domaine<i id="required-sign">*</i>
                            </label>
                            <select name="domaine" id="domaine" class="form-control" required>
                                @php
                                    $domaines = ['medecine','agronomie','economie','informatique','ingenierie','esthetique','marketing','media','securite','non definie']; 
                                @endphp

                                <!-- Domaine par defaut -->
                                <option value="{{ $offre_emploie->domaine }}">
                                    {{ ucfirst($offre_emploie->domaine) }}
                                </option>

                                @foreach($domaines as $domaine)
                                    <!-- On evite le doublon -->
                                    @if($domaine != $offre_emploie->domaine) 
                                        <option value="{{ $domaine }}"> 
                                            {{ ucfirst($domaine) }}
                                        </option>
                                    @endif    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="organisme">
                                Organisme:<i id="required-sign">*</i>
                            </label>
                            <input type="text" name="organisme" id="organisme" class="form-control" placeholder="Entrer le nom de l'organisme" value="{{ $offre_emploie->organisme }}" required>
                        </div>
                        <div class="form-group">
                            <label for="lieu">
                                Lieu:<i id="required-sign">*</i>
                            </label>
                            <input type="text" name="lieu" id="lieu" class="form-control" placeholder="Entrer le lieu" value="{{ $offre_emploie->lieu }}" required>
                        </div>
                        <div class="form-group">
                            <label for="object">
                                Object:<i id="required-sign">*</i>
                            </label>
                            <textarea name="object" id="object" class="form-control" placeholder="Entrer l'object d'offre emploie" cols="30" rows="2" value="{{ $offre_emploie->object }}" required></textarea>
                        </div>
                        <!-- Document -->
                        <div id="document_bloc">
                            <div id="document_bloc_content">
                                <div id="image_bloc">
                                    <img src="{{ Storage::url($identite->logo) }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                </div>
                                <div id="file_bloc" id="display: block;">
                                    <span id="document_file_name"></span>
                                </div>
                                <div id="input_bloc">
                                    <label for="document" title="Inserer un document">
                                        <i class="bi bi-download"></i> Inserer Document
                                    </label>
                                    <input type="file" name="document" id="document" style="display: none;">
                                </div>
                            </div>
                        </div>
                        <!-- fin document_bloc -->
                        <div id="submit_bloc">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block btn-sm active">
                                    <span>
                                        <i class="bi bi-upload"></i> Enregistrer
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

                    </div>    
                </form>
            </div>
        </div>

        <!-- Script interne -->
        <script type="text/javascript">
            let offre_emploie = @json($offre_emploie);
        </script> 

        <!-- Script externe -->
        <script src="{{ asset('script/pages/admin/offre_emploie/update.js') }}"></script>
    </div>
    @endsection
