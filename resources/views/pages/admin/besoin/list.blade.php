
    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fas fa-clipboard-list"></i> Gestion besoins
                </span>
                <!-- Autorisation acquise -->
                @if(Auth::user()->hasAccessToRessource('blog','register','allowed'))
                <a href="{{ route('admin.besoin.register_page') }}" title="Ajouter un besoin" class="btn btn-default btn-sm active">
                   <i class="fa fa-plus"></i>
                </a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsvive">
                    <table class="table table-bordered table condensed table-striped" id="besoins_list_table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Intitule
                                </th>
                                <th>
                                    Montant 
                                </th>
                                <th>
                                    Contenu
                                </th>
                                <th>
                                    <i class="fa fa-plus"></i>
                                </th>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('besoin','delete','allowed'))
                                <th>
                                    <i class="fa fa-trash"></i>
                                </th>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('besoin','update','allowed'))
                                <th>
                                    <i class="fa fa-edit"></i>
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $index = 0;
                            ?>
                            @foreach($besoins as $besoin)
                            <?php $index++; ?>
                            <tr>
                                <td>
                                    {{ $index }}
                                </td>
                                <td>
                                    {{ $besoin->intitule }}
                                </td>
                                <td>
                                    @if(strtolower($paymentSetting->currency_display_mode) != 'current' && $besoin->currency != $paymentSetting->currency && $currency_exchange_rate)
                                        @if($besoin->currency == 'USD')
                                            {{ $besoin->montant * $currency_exchange_rate }} <b style="opacity: 0.7;">{!! $currency_icons[$paymentSetting->currency] ?? '' !!}</b>
                                        @else
                                            {{ $besoin->montant / $currency_exchange_rate }} <b style="opacity: 0.7;">{!! $currency_icons[$paymentSetting->currency] ?? '' !!}</b>
                                        @endif
                                    @else
                                       {{ $besoin->montant }} <b style="opacity: 0.7;">{!! $currency_icons[$besoin->currency] ?? '' !!}</b>
                                    @endif
                                </td>
                                <td>
                                    {{ $besoin->contenu }} 
                                </td>
                                <td>
                                    <a href="{{ route('admin.besoin.details',['id'=>$besoin->id]) }}" title="Plus de details sur le besoin" class="btn btn-default btn-sm">
                                        <span>
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                </td>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('besoin','delete','allowed'))
                                <td>
                                    <form action="{{ route('admin.besoin.delete_one',['id'=>$besoin->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Voulez vous vraiment supprimer ?')" class="btn btn-danger btn-sm active">
                                            <span>
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('besoin','update','allowed'))
                                <td>
                                    <a href="{{ route('admin.besoin.update_page',['id'=>$besoin->id]) }}" title="Modifier le besoin" class="btn btn-primary btn-sm active">
                                        <span>
                                            <i class="fa fa-edit"></i>
                                        </span>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Scripts externes -->
        <script src="{{ asset('script/pages/admin/besoin/list.js') }}"></script> 

    </div>
    @endsection
