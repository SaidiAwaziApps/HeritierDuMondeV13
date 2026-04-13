<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Setting</title>

    <style>
        div.card .card-header span.card-title {
            font-size: 20px;
            /* font-weight: bold; */
            font-family: italic;
        }

        /* .payment-setting-form {
            width: 60px;
        } */

        .payment-setting-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 520px;
        }

        .payment-setting-form-content {
            width: 60%;
        }

        @media all and (max-width: 800px) {
            .payment-setting-form-content {
                width: 100%;
            } 
        }

        .payment-setting-title {
            text-align: center;
            font-weight: bold;
            font-family: italic;
            opacity: 0.7;
        }

        @media all and (min-width: 800px) {
            .payment-setting-title {
                padding: 10px;
                border-radius: 4px;
                background-color: #f8f8f8;
            }
        }

        .payment-setting-title i {
            opacity: 0.5;
        }

        .payment-setting-inputs {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
            margin-top: 36px;
        }

        .payment-setting-inputs input:nth-child(1) {
           width: 88%;
        }

        .payment-setting-inputs .dropdown {
            width: 11%;
        }

        @media all and (max-width: 800px) {
            .payment-setting-inputs input:nth-child(1) {
                width: 76%;
            } 
            .payment-setting-inputs .dropdown {
                width: 22%;
            }
        }

        .payment-setting-inputs .dropdown button span {
           /* font-weight: bold; */
           font-family: italic;
        }

        .payment-setting-inputs .dropdown ul {
            padding: 4px 4px 4px 10px;
        }

        .payment-setting-inputs .dropdown ul li {
            /* font-weight: bold; */
            font-family: italic;
        }

        .payment-setting-inputs .dropdown ul li:hover {
            background-color: #f8f8ff;
            cursor: pointer;
        } 



        .submit-content {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .submit-content button {
            padding-left: 20px;
            padding-right: 20px;
        }

        .submit-content button span {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
        }


        .errors-validation {
            margin-top: 20px;
        }

        .errors-validation .error-item {
            text-align: center;
        }

        .errors-validation .error-item span {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
            color: red;
            opacity: 0.8;
        }

    </style>

</head>
<body>

    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('paymentSetting.update',['id' => $paymentSetting->id]) }}" class="payment-setting-form">
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
    </div>

    <!-- script -->
    <script src="{{ asset('script/payment_setting/update.js') }}"></script>
    @endsection
    
</body>
</html>












