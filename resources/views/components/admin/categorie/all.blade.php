
@php
    $model = null;
    $ctg_type  = null; 
    if(Route::currentRouteName() == 'admin.article.register_page') {
        $ctg_type = 'article';
    } 

    if(Route::currentRouteName() == 'admin.article.update_page') {
        $model = $article;
        $ctg_type = 'article';
    } 
@endphp

<div class="categorie-content">
    <div id="add_categorie_select_form">
        <div class="form-group">
            <label for="categorie_id">
                <i>Categorie:</i>
                <i id="required-sign">*</i>
            </label>
            <select name="categorie_id" id="categorie_id" class="form-control" required>
                @if($model)
                    <!-- Categorie par defaut  -->
                    <option value="{{ $model->categorie->id }}">
                        {{ $model->categorie->ctg_name }}
                    </option>
                @endif
                <!-- Ensemble categories -->
                @foreach($categories as $categorie)
                    @if($model)
                        @if($categorie->id != $model->categorie->id)
                            <option value="{{$categorie->id}}">
                                {{ $categorie->ctg_name }}
                             </option>
                        @endif
                    @else
                        <option value="{{$categorie->id}}">
                            {{ $categorie->ctg_name }}
                        </option>
                    @endif                
                @endforeach
            </select>
        </div>
    </div>
    <div style="text-align: center;">
        <a href="#" title="Cliquer pour ajouter une categorie" id="add_categorie_link">
            <span>
                <i class="fa fa-plus"></i> Add categorie
            </span>
        </a>
        <div id="add_categorie_form_content" class=".toggle-add-categorie-form_content">
            <div class="form-group">
                <input type="hidden" name="ctg_csrf_token" value="{{ csrf_token() }}">
                <input type="hidden" name="ctg_type" value="{{ $ctg_type }}">
                <input type="text" name="ctg_name" id="ctg_name" class="form-control" placeholder="Nom categorie" maxlength="30">
            </div>
            <div class="d-grid">
                <button type="button" id="add_categorie_submit_button" class="btn btn-primary btn-sm">
                    <span>
                        <i class="fa fa-spinner fa-spinner-bordered" id="add_categorie_spinner_icon"></i> <i class="fa fa-upload" id="add_categorie_submit_icon"></i>
                    </span>
                </button>
            </div>
        </div>
        <div id="add_categorie_feedback" style="display: block;">
                                                   
        </div>
    </div>
</div>