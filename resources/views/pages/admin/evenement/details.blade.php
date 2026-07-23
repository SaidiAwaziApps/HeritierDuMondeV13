    @php
       function isVideo($path) {
            $extension_array=['mp4','MP4','mpeg','MPEG','mpeg-2','MPEG-2','avi','AVI','mov','MOV','wmv','WMV','avi','AVI','avchd','AVCHD','flv','FLV','f4v','F4V','swf','SWF','mkv','MKV','webm','WEBM'];
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
                   <i class="fa fa-calendar" style="opacity: 0.6;"></i> Gestion Evenements
                </span>
                <a href="{{ route('admin.evenement.list') }}" class="active" title="Ajouter un evenement">
                    <i class="bi bi-list"></i>
                </a>
            </div>
            <div class="card-body">
                <!-- card -->
                <div id="meta">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <!-- <span>
                                Titre:
                            </span> -->
                            <span>
                               <i class="fa fa-header"></i>  {{ $evenement->titre }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span>
                                Date/Periode:
                            </span>
                            <span>
                                @if($evenement->type=='journalier')
                                    {{ $evenement->date_du_jour }}
                                @else 
                                    {{ $evenement->periode_date_debut }} au {{ $evenement->periode_date_fin }}
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span>
                                Localisation:
                            </span>
                            <span>
                                {{ $evenement->lieu }}
                            </span>
                         </li>    
                        <li class="list-group-item">
                            <span>
                                <i class="fa fa-text-height"></i> Description
                            </span>
                            <span>
                                {{ $evenement->contenu }}
                            </span>
                        </li>
                        @if(($evenement->images && count($evenement->images) > 0))
                        <li class="list-group-item">
                            <div id="medias">
                                @include('components.admin.image.global.items')
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
                <!-- fin meta -->       
                
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

        <!-- Script pour evenement -->
        <script src="{{ asset('script/components/admin/share/register.js') }}"></script>  
        <script src="{{ asset('script/pages/admin/evenement/details.js') }}"></script>
         
    </div>
    @endsection
</body>
</html>