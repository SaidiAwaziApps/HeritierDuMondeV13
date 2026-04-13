<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulation</title>

    <!-- Select2 CSS -->
    <link href="{{ asset('dependance/select2/select2.min.css') }}" rel="stylesheet" />

    <!-- jQuery (obligatoire pour Select2) -->
    <script src="{{ asset('dependance/jquery/jquery.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('dependance/select2/select2.min.js') }}"></script>


    <style>
        .card-header span.card-title {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.6;
        }

        .card-header span.card-title i {
            opacity: 0.3;
        }


        form ul li {
            margin-bottom: 6px;
        }

        form ul li div label {
            font-size: 20px;
            /* font-weight: bold; */
            font-family: italic;
        }

        form ul li div input {
            margin: 0px 6px 0px 6px;
            width: 20px;  
        }

        form ul li:nth-child(2) div {
            display: flex;
        }

        form ul li:nth-child(2) div input[type="number"] {
            width: 80px;
            height: 32px;
        }

        form ul li div textarea[name="denied_words"],
        form ul li div select[id="denied_images"] {
            border-bottom: 2px solid #ccc;
        }


        form .submit_bloc {
            margin-top: 2px;
        }

        form .submit-bloc .d-grid button span {
            font-size: 17px;
            font-weight: bold;
            font-family: italic;
        }



        form .errors-bloc {
            margin-top: 16px;
        }

        form .errors-bloc > div > div.error-item {
            text-align: center;
        }

        form .errors-bloc > div > div.error-item span {
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
    <div class="globalContent">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fas fa-cog" style="opacity: 0.6;"></i>  Regulation Commentaire
                </span>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('regulation.update',['id'=>$regulation->id]) }}">
                    @csrf
                    @method('PUT')
                    <ul>
                        <li>
                            <div class="d-flex align-items-center">
                                <label>
                                    Tout commentaire est en attente de moderation
                                </label>
                                <input type="checkbox" name="attempt_all_to_moderated" id="attempt_all_to_moderated" value="oui">
                            </div>
                        </li>
                        <li>
                            <div class="d-fex align-items-center">
                                <label for="nbr_already_moderated">
                                    L' auteur d' un commentaire doit avoir au moins
                                </label>
                                <input type="number" name="nbr_already_moderated" id="nbr_already_moderated" class="form-control" min="1" value="1" placeholder="1">
                                <label for="nbr_already_moderated">
                                    commentaire approuve
                                </label>
                                <input type="checkbox" name="must_already_moderated" id="must_already_moderated" value="oui">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="denied_images">
                                    Catégories interdites :
                                </label>
                                <select name="denied_images[]" id="denied_images" class="form-control" multiple>
                                    <!-- <option value="nudity.raw">Nudite Explicite</option> -->
                                    <option value="nudity.sexual_suggestive">Nudite Partielle</option>
                                    <option value="nudity.sexual_activity">Activite Sexuelle</option>
                                    <!-- <option value="weapon">Arme</option> -->
                                    <option value="weapon.classes.knife">Arme A Feu</option>
                                    <option value="weapon.classes.firearm">Arme Blabche</option>
                                    <option value="alcohol.prob">Alcool</option>
                                    <!-- <option value="drugs">Drogue</option>
                                    <option value="medical_drugs">Drogue Medicale(plillule,...)</option>
                                    <option value="recreational_drugs">Drogue Recreative()</option> -->
                                    <option value="offensive.prob">Contenu Offensant</option>
                                    <option value="offensive.nazi">Symbole Nazi</option>
                                    <option value="offensive.confederate">Drapeau Confedere ou Symbole</option>
                                    <option value="offensive.supremacist">Contenu Suprémaciste</option>
                                    <option value="offensive.terrorist">Terrorisme</option>
                                    <option value="offensive.middle_finger">Geste du doigt d' honneur</option>
                                    <option value="gore.prob">Sang, Blessure(grave)</option>
                                    <option value="skull.prob">Presence de crane</option>
                                    <!-- <option value="ai-generated.prob">Generee par IA</option> -->
                                </select>
                            </div>    
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="denied_words">
                                    Mots interdits au sein du commentaire:
                                </label>
                                <textarea name="denied_words" id="denied_words" cols="30" rows="2" class="form-control" placeholder="Entrer les mots interdits (Tout commentaire contenant au moins une de ces mots sera place immediatement a la corbeille , d' ou rejete). Espacer par les virgules !!!" value="{{ $regulation->denied_words }}"></textarea>
                            </div>
                        </li>
                    </ul>
                    <div class="submit-bloc">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block active">
                                <span>
                                    <i class="fa fa-upload"></i> Enregistrer
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="success-bloc">
                        
                    </div>

                    <div class="errors-bloc">
                        @if($errors->any())
                        <div class="errors-content">
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

    <!-- Script js (javascript) -->
    <script type="text/javascript">
        let regulation = <?php echo($regulation);?>
    </script> 

    <script src="{{ asset('script/regulation/update.js') }}"></script>

    @endsection

</body>
</html>