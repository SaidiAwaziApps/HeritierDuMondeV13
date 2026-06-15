
    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    Gestion besoin
                </span>
                <a href="{{ route('admin.besoin.list') }}" title="Tous les besoins" class="btn btn-default btn-sm active">
                    <i class="fa fa-list"></i>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.besoin.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="intitule">
                            Intitule:<i id="required-sign">*</i>
                        </label>
                        <input type="text" name="intitule" id="intitule" class="form-control" placeholder="Entrer l'intitule du besoin" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label for="montant">
                            Montant<span style="opacity: 0.7;"> ({!!$currency_icons[$paymentSetting->currency]!!})</span>:<i id="required-sign">*</i>
                        </label>
                        <input type="number" name="montant" id="montant" class="form-control" placeholder="Entrer le montant en {{ $paymentSetting->currency == 'USD' ? 'dollard US' : 'Euro' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="contenu">
                            Contenu:<i id="required-sign">*</i>
                        </label>
                        <textarea name="contenu" id="contenu" class="form-control" placeholder="Taper le contenu du besoin" cols="30" rows="4" required></textarea>
                    </div>


                    <div id="submit_bloc">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-sm active">
                                <span>
                                    <i class="fa fa-upload"></i> Enregistrer
                                </span>
                            </button>
                        </div>
                    </div>


                    <!-- Contenu imaga -->
                    <div class="imgs-bloc">
                        <div class="imgs-bloc-context">
                            @include('components.admin.image.global.context')
                        </div>
                        <div class="imgs-bloc-content">
                            @include('components.admin.image.global.content')
                        </div>
                    </div>

                    @if($errors->any()) 
                       @foreach($errors->all() as $error)
                       <div class="validator-error">
                            <span>
                               {{ $error }}
                            </span>
                       </div>
                       @endforeach
                    @endif

                </form>
            </div>
        </div>

        <!-- Scripts externes -->
        <script src="{{ asset('script/components/admin/image/upload/register.js') }}"></script>
        <script src="{{ asset('script/components/admin/image/vignette/register.js') }}"></script> 

    </div>
    @endsection
