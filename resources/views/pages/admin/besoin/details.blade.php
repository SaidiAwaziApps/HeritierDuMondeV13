    @php
        function isVideo($path) {
            $extension_array = ['mp4','MP4','mpeg','MPEG','mpeg-2','MPEG-2','avi','AVI','mov','MOV','wmv','WMV','avi','AVI','avchd','AVCHD','flv','FLV','f4v','F4V','swf','SWF','mkv','MKV','webm','WEBM'];
            if(in_array(pathinfo($path,PATHINFO_EXTENSION),$extension_array)) {
                return true;
            } else {
                return false;
            }
        } 
    @endphp

    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    Gestion Besoins
                </span>
                <a href="{{ route('admin.besoin.list') }}" title="Tous les besoins" class="btn btn-default btn-sm active">
                    <span>
                        <i class="fa fa-list"></i>
                    </span>
                </a>
            </div>
            <div class="card-body">
                <h6 id="header_title">
                    <span>
                        <i class="fa fa-header" style="opacity: 0.6;"></i>  {{ $besoin->intitule }}
                    </span>
                </h6>
                <div id="data_content">
                    <div id="meta_bloc">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span>
                                    Montant:
                                </span>
                                <span>
                                    {{ $besoin->montant }} {{ $paymentSetting->currency }}
                                </span>
                            </li>
                            <li class="list-group-item">
                                <span>
                                    <i class="fa fa-text-height" style="opacity: 0.6;"></i> Contenu:
                                </span>
                                <span>
                                    {{ $besoin->contenu }}
                                </span>
                            </li>
                            @if($besoin->images && count($besoin->images) > 0)
                            <li class="list-group-item">
                                <div id="medias">
                                    @include('components.admin.image.global.items')
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div id="chart_bloc">
                        <div class="card">
                            <div class="card-body">
                                <div id="besoin_chart_graph">
                                                 
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
                
                <!-- Que disent nos donateurs -->
                @if($besoin->besoinDons && $besoin->besoinDons->count() > 0)  
                    <div class="donors-talks">
                        <div class="card">
                            <div class="card-body">
                                <div class="donors-talks-heading">
                                    <h4 class="donors-talks-heading-title">
                                        @if($besoin->besoinDons->count() > 1)
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

                <!-- Share --->
                <div class="shares">
                    @include('components.admin.share.register')
                </div> 

                <!-- Inclus le FeedbackToast -->
                <div class="feedback-toast">
                    @include('components.admin.global.FeedbackToast')
                </div> 

            </div>
        </div>

        <!-- Script interne -->
        <script type="text/javascript">
            let besoin = @json($besoin);
        </script>

       
 <script type="text/javascript">
            window.paymentSetting = @json($paymentSetting);
        </script>
        <!-- Inclus script (externe) --> 
        <script src="{{ asset('script/components/admin/share/register.js') }}"></script> 
        <script src="{{ asset('script/pages/admin/besoin/details.js') }}"></script>
    </div>
    @endsection
