<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test commentaire</title>
</head>
<body>

    @extends('layouts.admin')

    @section('content')
    <div class="global-content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('article.addComment',['id'=>6]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="texte">
                            Texte:
                        </label>
                        <textarea name="texte" id="texte" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fichiers">
                            Images:
                        </label>
                        <input type="file" name="fichiers[]" id="fichiers" multiple class="form-control">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block btn-sm">
                            <span>
                                <i class="fa fa-upload"></i> Enregistrer
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

</body>
</html>