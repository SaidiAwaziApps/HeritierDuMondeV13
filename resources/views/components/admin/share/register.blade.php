@php
    $model = null;
    if(isset($article) && !empty($article)) {
        $model = $article;  
    } 
    else if(isset($besoin) && !empty($besoin)) {
        $model = $besoin;   
    }
    else if(isset($evenement) && !empty($evenement)) {
        $model = $evenement;
    } else {
        $model = null;
    }
@endphp

<div class="shares-component">
    <div class="shares-content">
        <form method="POST" action="{{ route('admin.share.save') }}" class="dropdown" id="share_form">
            @csrf
            <label>
                <i class="fa fa-share"></i> Partager(<i class="share-length">{{ $model->shares ? $model->shares->count() : 0 }}</i>):
            </label>
            <input type="hidden" name="shareable_type" id="shareable_type" value="{{ get_class($model) }}">
            <input type="hidden" name="shareable_id" id="shareable_id" value="{{ $model->id }}">
            <button type="submit" name="media" id="media" class="btn btn-default btn-sm" data-bs-toggle="popover" data-bs-content="Partager sur facebook" data-bs-trigger="hover focus" value="facebook">
                <i class="fa fa-facebook"></i>
                <i class="fa fa-spinner fa-spin"></i>
            </button>
            <button type="submit" name="media" id="media" class="btn btn-default btn-sm" data-bs-toggle="popover" data-bs-content="Partager sur instagram" data-bs-trigger="hover focus" value="instagram">
                <i class="fa fa-instagram"></i>
                <i class="fa fa-spinner fa-spin"></i>
            </button>
            <button type="submit" name="media" id="media" class="btn btn-default btn-sm" data-bs-toggle="popover" data-bs-content="Partager sur twitter" data-bs-trigger="hover focus" value="twitter">
                <i class="fa fa-twitter"></i>
                <i class="fa fa-spinner fa-spin"></i>
            </button>
            <!-- Others medias -->
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" title="Cliquer pour plus media" data-bs-toggle="dropdown">

            </button>
            <!-- Dropdown menu(options) -->
            <ul class="dropdown-menu">
                <li class="dropdown-item">
                    Options <i class="fa fa-angle-down"></i>
                </li>
                <li class="dropdown-divider"></li>
                <li class="dropdown-item">
                    <div class="d-grid">
                        <button type="submit" name="media" id="media" class="btn btn-default btn-sm" data-bs-toggle="popover" data-bs-content="Partager sur whatsapp" data-bs-trigger="hover focus" value="whatsapp">
                            <i class="fa fa-whatsapp"></i> <i class="fa fa-spinner fa-spin"></i> Whatsapp
                        </button>
                    </div>
                </li>
                <li class="dropdown-divider"></li>
                <li class="dropdown-item">
                    <div class="d-grid">
                        <button type="submit" name="media" id="media" class="btn btn-default btn-sm" data-bs-toggle="popover" data-bs-content="Partager sur likendin" data-bs-trigger="hover focus" value="linkedin">
                            <i class="fa fa-linkedin"></i> <i class="fa fa-spinner fa-spin"></i> Linkedin
                        </button>
                    </div>
                </li>
                <li class="dropdown-divider"></li>
                <li class="dropdown-item">
                    <div class="d-grid">
                        <button type="submit" name="media" id="media" class="btn btn-default btn-sm" data-bs-toggle="popover" data-bs-content="Partager sur mail" data-bs-trigger="hover focus" value="mail">
                            <i class="fa fa-envelope"></i> <i class="fa fa-spinner fa-spin"></i> Email
                        </button>
                    </div>
                </li>
            </ul>
            <!-- validator errors -->
            @if($errors->any()) 
                <div class="validator-errors">
                    @foreach($errors->all() as $error)
                        <div class="error-item">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif 
            <!-- fin validator errors --> 
        </form>
    </div>
</div>    