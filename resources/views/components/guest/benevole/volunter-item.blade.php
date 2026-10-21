<div class="global-component">

    <div class="volunter-item-content">

        <!------------------------------------------
            Image profil 
        ------------------------------------------->
        <div class="volunter-item-content-img">
            <a href="{{ Storage::url($benevole->photo) }}" title="Cliquer pour afficher le profil">
                <img src="{{ asset(Storage::url($benevole->photo)) }}" alt="Profil {{ $benevole->nom }}" class="rounded-thumbnail" style="width: 100%; height: 100%;">
            </a>    
        </div>

        <!------------------------------------------
            Identite 
        ------------------------------------------->
        <div class="volunter-item-content-identity">
            <p> {{ $benevole->nom }} {{ $benevole->prenom }} </p>
        </div> 

        <!------------------------------------------
            Contact 
        ------------------------------------------->
        <div class="volunter-item-content-contact">
                
            <ul>
                <li>
                    <a href="{{ $benevole->sociaux['facebook'] }}" target="_blank" title="Aller sur facebook">
                        <i class="fa fa-facebook" style="color: #1877F2"></i>
                    </a>   
                </li>
                <li>
                    <a href="{{ $benevole->sociaux['linkedIn'] }}" target="_blank" title="Aller sur linkendin">
                        <i class="fab fa-linkedin" style="color: #0A66C2"></i>
                    </a>   
                </li>
                <li>
                    <a href="{{ $benevole->sociaux['instagram'] }}" target="_blank" title="Aller sur instagram">
                        <i class="fa fa-instagram" style="color: #E4405F"></i>
                    </a>   
                </li>
                <li>
                    <a href="{{ $benevole->sociaux['twitter'] }}" target="_blank" title="Aller sur twitter">
                        <i class="fa fa-twitter" style="color: #1DA1F2"></i>
                    </a>   
                </li>
            </ul>

        </div>    

    </div>

</div>