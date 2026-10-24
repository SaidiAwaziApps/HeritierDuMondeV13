
<div class="global-component">

    <div class="volunter-item-content">

        <!------------------------------------------
            Image profil 
        ------------------------------------------->
        <div class="volunter-item-content-img">
            <a href="{{ $benevole->photo ? Storage::url($benevole->photo) : asset('image/default_benevole.png') }}"
               data-bs-toggle="popover"
               data-bs-trigger="hover focus"
               data-bs-placement="top"
               data-bs-content="Cliquer pour afficher le profil">
                <img src="{{ $benevole->photo ? Storage::url($benevole->photo) : asset('image/default_benevole.png')  }}" alt="Profil {{ $benevole->nom }}" class="rounded-thumbnail" style="width: 100%; height: 100%;">
            </a>
        </div>

        <!------------------------------------------
            Identite 
        ------------------------------------------->
        <div class="volunter-item-content-identity">
            <p> 
                {{ $benevole->nom }} {{ $benevole->prenom }} 
                <br>
                @if($benevole->profession)
                   <span> {{ $benevole->profession }} </span>
                @endif 
            </p>
        </div>

        <!------------------------------------------
            Contact 
        ------------------------------------------->
        <div class="volunter-item-content-contact">

             @php
                $sociaux = $benevole->sociaux;
            @endphp

            @if($sociaux && ($sociaux->facebook || $sociaux->twitter || $sociaux->linkedIn || $sociaux->instagram))
            <ul>

                @if($sociaux->facebook)
                <li>
                    <a href="{{ $benevole->sociaux['facebook'] }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       data-bs-toggle="popover"
                       data-bs-trigger="hover focus"
                       data-bs-placement="top"
                       data-bs-content="Visiter le profil Facebook de {{ $benevole->nom }}.">
                        <i class="fa fa-facebook" style="color: #1877F2"></i>
                    </a>
                </li>
                @endif

                @if($sociaux->twitter)
                <li>
                    <a href="{{ $benevole->sociaux['twitter'] }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       data-bs-toggle="popover"
                       data-bs-trigger="hover focus"
                       data-bs-placement="top"
                       data-bs-content="Visiter le profil Twitter de {{ $benevole->nom }}.">
                        <i class="fa fa-twitter" style="color: #1DA1F2"></i>
                    </a>
                </li>
                @endif

                @if($sociaux->instagram)
                <li>
                    <a href="{{ $benevole->sociaux['instagram'] }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       data-bs-toggle="popover"
                       data-bs-trigger="hover focus"
                       data-bs-placement="top"
                       data-bs-content="Visiter le profil Instagram de {{ $benevole->nom }}.">
                        <i class="fa fa-instagram" style="color: #E4405F"></i>
                    </a>
                </li>
                @endif

                @if($sociaux->linkedIn)
                <li>
                    <a href="{{ $benevole->sociaux['linkedIn'] }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       data-bs-toggle="popover"
                       data-bs-trigger="hover focus"
                       data-bs-placement="top"
                       data-bs-content="Visiter le profil LinkedIn de {{ $benevole->nom }}.">
                        <i class="fab fa-linkedin" style="color: #0A66C2"></i>
                    </a>
                </li>
                @endif

            </ul>
            @endif

        </div>

    </div>

</div>


