
    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                   <i class="fas fa-donate"></i> Liste Dons effectues
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped"id="dons_list_table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Montant
                                </th>
                                <th>
                                    Donateur
                                </th>
                                <th>
                                    mode payment
                                </th>
                                <th>
                                    Recu
                                </th>
                                <th>
                                    <i class="fa fa-plus"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index=0; ?>
                            @foreach($dons as $don)
                            <?php $index++;?>
                            <tr>
                                <td>
                                    {{ $index }}
                                </td>
                                <td>
                                    {{ $don->created_at->format('d-m-y') }}
                                </td>
                                <td>
                                    @if(strtolower($paymentSetting->currency_display_mode) != 'current' && $don->currency != $paymentSetting->currency && $currency_exchange_rate)
                                        @if($don->currency == 'USD')
                                            {{ $don->montant * $currency_exchange_rate }} <b>{!! $currency_icons[$paymentSetting->currency] ?? '' !!}</b>
                                        @else
                                            {{ $don->montant / $currency_exchange_rate }} <b>{!! $currency_icons[$paymentSetting->currency] ?? '' !!}</b>
                                        @endif
                                    @else
                                       {{ $don->montant }} <b>{!! $currency_icons[$don->currency] ?? '' !!}</b>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-grid">
                                        <a href="{{ route('admin.donateur.details',['id'=>$don->donateur->id]) }}" class="btn btn-default btn-sm btn-block" title="Cliquer pour plus de details sur le donateur">
                                            {{ $don->donateur->nom }}
                                        </a> 
                                    </div>
                                </td>
                                <td>
                                    {{ $don->mode_paiement }}
                                </td>
                                <td>
                                    {{ isset($don->reception) ? 'Oui' : 'Non' }}
                                </td>
                                <td>
                                    <div class="d-grid">
                                        <a href="{{ route('admin.don.details',['id'=>$don->id]) }}" class="btn btn-default btn-sm btn-block" title="Cliquer pour plus de details sur le don">
                                            <i class="fa fa-plus"></i> Plus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Que disent nos donateurs -->
        @if($dons && $dons->count() > 0)  
            <div class="donors-talks">
                <div class="card">
                    <div class="card-body">
                        <div class="donors-talks-heading">
                            <h4 class="donors-talks-heading-title">
                                @if($dons->count() > 1)
                                    Que disent nos donateurs ?
                                @else
                                    Que dit le donateur ?
                                @endif
                            </h4>
                        </div>
                        <div class="donors-talks-heading">
                            @include('components.admin.don.donors_talks')
                        </div>
                    </div>
                </div>
            </div> 
        @endif

         <!-- Scripts externes -->
        <script src="{{ asset('script/pages/admin/don/list.js') }}"></script> 
        
    </div>
    @endsection

