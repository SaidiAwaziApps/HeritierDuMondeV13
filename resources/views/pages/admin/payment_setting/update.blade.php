
    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('paymentSetting.update_handler',['id' => $paymentSetting->id]) }}" class="payment-setting-form">
                    @csrf
                    @method('PUT')
                    <div class="payment-setting-form-content">
                        <h4 class="payment-setting-title">
                            <i class="fa fa-cog"></i> Payment Settings
                        </h4>
                        <!-- Inputs -->
                        <div class="payment-setting-inputs">
                            <input type="text" name="token" id="token" class="form-control" placeholder="Entrer le token paiement" value="{{ $paymentSetting->token }}" required>
                            <input type="hidden" name="currency" id="currency" value="{{ $paymentSetting->currency }}" required>
                            <div class="dropdown">
                                <button type="button" id="currency_button" required class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                    <span>
                                        {{ $paymentSetting->currency }}
                                    </span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item currency-item" data-value="EURO">
                                        {{ $paymentSetting->currency == 'EURO' ? 'USD' : 'EURO' }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="submit-content">
                            <button type="submit" class="btn btn-primary btn-sm btn-block" id="payment_setting_submit_button">
                                <span>
                                    <i class="fa fa-upload"></i> Enregistrer
                                </span>
                            </button>
                        </div>

                        <!-- Validation du formulaire -->
                        @if($errors->any()) 
                            <div class="errors-validation">
                                @foreach($errors->all() as $error)
                                <div class="error-item">
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

        <!-- script externe -->
        <script src="{{ asset('script/pages/admin/payment_setting/update.js') }}"></script>

    </div>  
    @endsection
    












