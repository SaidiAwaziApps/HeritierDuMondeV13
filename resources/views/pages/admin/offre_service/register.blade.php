
    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fa fa-tasks"></i> Offre de Service               
                </span>
                <a href="{{ route('admin.offre_service.list') }}" title="Afficher la liste">
                    <i class="fa fa-list"></i>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.offre_service.save') }}">
                    <div id="form_content">
                        @csrf
                        <div class="form-group">
                            <label for="intitule">
                                Intitule:<i id="required-sign">*</i>
                            </label>
                            <input type="text" name="intitule" id="intitule" class="form-control" placeholder="Intitule du service" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="description">
                                Description:<i id="required-sign">*</i>
                            </label>
                            <textarea name="description" id="description" cols="30" rows="4" class="form-control" placeholder="Description du service" required></textarea>
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
    </div>
    @endsection
