
@php
    $model = null;
    $cat_type  = null; 
    if(Route::currentRouteName() == 'admin.article.register_page' || Route::currentRouteName() == 'admin.article.update_page') {
        $model = $article;
        $cat_type = 'article';
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
                <option value="{{ $model->categorie->id }}">
                    <!-- Categorie par defaut  -->
                    {{ $model->categorie->cat_name }}
                </option>
                @foreach($categories as $categorie)
                    @if($categorie->id != $model->categorie->id)
                        <option value="{{$categorie->id}}">
                            {{ $categorie->cat_name }}
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
                <input type="hidden" name="cat_csrf_token" value="{{ csrf_token() }}">
                <input type="hidden" name="cat_type" value="{{ $cat_type }}">
                <input type="text" name="cat_name" id="cat_name" class="form-control" placeholder="Nom categorie" maxlength="30">
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