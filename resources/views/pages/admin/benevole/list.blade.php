
    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                   <i class="fa fa-people-group"></i>  Nos Benevoles
                </h4>
            </div>
            <div class="card-body">
                <div id="item_data_content">
                    @foreach($benevoles as $benevole)
                    <div class="card">
                        <div class="card-body">
                            <div id="data_item">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div id="profil_bloc">
                                            <a href="{{ Storage::url($admin->photo) }}">
                                                <img src="{{ Storage::url($admin->photo) }}" alt="" title="Profil {{ $benevole->nom }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                            </a>    
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('admin.benevole.details',['id'=>$benevole->id]) }}" title="Plus infos sur {{ $benevole->nom }}">
                                            <span>
                                                {{ $benevole->nom.' '.$benevole->prenom }} <i class="fa fa-plus"></i>
                                            </span>
                                        <a>    
                                    </li>
                                    <li class="list-group-item" title="Aller sur Facebook">
                                        <a href="{{ $benevole->sociaux->facebook }}">
                                            <i class="bi bi-facebook" style="color: blue;"></i>
                                        </a>
                                        <a href="{{ $benevole->sociaux->twitter }}" title="Aller sur Twitter">
                                            <i class="bi bi-twitter" style="color: #00acee;"></i>
                                        </a>
                                        <a href="{{ $benevole->sociaux->google }}" title="Aller sur Google">
                                            <i class="bi bi-google" style="color: #db4a39;"></i>
                                        </a>
                                        <a href="{{ $benevole->sociaux->instagram }}" title="Aller sur Instagram">
                                            <i class="bi bi-instagram" style="color: #C32AA3;"></i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- More option -->
                            <div id="data_more_option">
                                <a href="#" title="Pour plus d' information sur {{ $benevole->nom }}">
                                    <div>
                                        <button type="button" class="btn btn-default active btn-sm">
                                            <div>
                                                <span class="fa fa-plus"></span>
                                            </div>
                                        </button>
                                    </div>
                                </a>
                            </div>
                            <!---->
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> 
        </div>

        <!-- Script interne -->
        <script src="{{ asset('script/pages/admin/benevole/list.js') }}"></script>

    </div>
    @endsection
