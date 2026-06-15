
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
                <form method="POST" action="{{ route('admin.besoin.update_handler',['id'=>$besoin->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="intitule">
                            Intitule:<i id="required-sign">*</i>
                        </label>
                        <input type="text" name="intitule" id="intitule" class="form-control" placeholder="Entrer l'intitule du besoin" maxlength="60" value="{{ $besoin->intitule }}" required>
                    </div>
                    <div class="form-group">
                        @php
                            $defaultAmount = $besoin->montant;

                            if(strtolower($paymentSetting->currency_display_mode) != 'current' && $besoin->currency != $paymentSetting->currency) {
                                if($besoin->currency == 'USD') {
                                    $defaultAmount = $besoin->montant * $currency_exchange_rate;
                                }
                                else {
                                    $defaultAmount = $besoin->montant / $currency_exchange_rate;
                                }
                            }

                        @endphp
                          
                        <label for="montant">
                            Montant <span style="opacity: 0.7;"> ({!!$currency_icons[$paymentSetting->currency]!!})</span>:<i id="required-sign">*</i>
                        </label>

                        <input type="number" name="montant" id="montant" class="form-control" placeholder="Entrer le montant en {{ $paymentSetting->currency == 'USD' ? 'dollard US' : 'Euro' }}"  value="{{  $defaultAmount }}" required>
                    </div>
                    <div class="form-group">
                        <label for="contenu">
                            Contenu:<i id="required-sign">*</i>
                        </label>
                        <textarea name="contenu" id="contenu" class="form-control" placeholder="Taper le contenu du besoin" cols="30" rows="4"  value="{{ $besoin->contenu }}" required></textarea>
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

                    <!-- Contenu images -->
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

        <!-- Script interne -->
        <script type="text/javascript">
            // Variables (gloabals)
            window.STORAGE_PATH_URL = @json(env('STORAGE_PATH_URL'));
            let besoin = @json($besoin);
            let images = besoin.images;
        </script>

        <!-- Scripts externes (image) -->
        <script src="{{ asset('script/components/admin/image/upload/update.js') }}"></script>
        <script src="{{ asset('script/components/admin/image/vignette/update.js') }}"></script> 

        <!-- Scripts externes (besoin) --> 
        <script src="{{ asset('script/pages/admin/besoin/update.js') }}"></script>

    </div>
    @endsection

