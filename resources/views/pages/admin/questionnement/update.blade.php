
    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fas fa-question-circle" style="opacity: 0.4;"></i> Questionnement
                </span>
                <a href="{{ route('admin.questionnement.list') }}" class="btn btn-default btn-sm" title="Ajouter un questionnement">
                    <i class="fa fa-list"></i>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.questionnement.update_handler',['id'=>$questionnement->id]) }}">
                    <div id="form_title">
                        <h4>
                            Apportez vos modifications
                        </h4>
                    </div>
                    <div id="form_content">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="question">
                                Question:<i id="required-sign">*</i>
                            </label>
                            <input type="text" name="question" id="question" class="form-control" placeholder="Entrer la question" mexlength="100" value="{{ $questionnement->question }}" required>
                        </div>
                        <div class="form-group">
                            <label for="reponse">
                                Reponse:<i id="required-sign">*</i>
                            </label>
                            <textarea name="reponse" id="reponse" cols="30" rows="6" class="form-control" placeholder="Entrer reponse a la question" value="{{ $questionnement->reponse }}" required></textarea>
                        </div>
                        <div id="submit_bloc">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-sm btn-block active">
                                    <span>
                                        <i class="fa fa-upload"></i> Enregistrer
                                    </span>
                                </button>
                            </div>
                        </div>

                        @if($errors->any())
                        <div id="errors_bloc">
                            @foreach($errors->all() as $error)
                            <div id="error_item">
                                <span>
                                    {{ $error }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @endif

                    </div>
                </form>
            </div>
        </div>

        <!-- Inclus script -->
        <script type="text/javascript">
            let questionnement = @json($questionnement);
        </script> 

        <script src="{{ asset('script/pages/admin/questionnement/update.js') }}"></script>

    </div>
    @endsection

