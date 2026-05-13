@php
    $data = null;

    if(isset($besoin) && !empty($besoin)) {

        $data = collect();

        foreach($besoin->besoinDons as $item) {
            $data->push($item->don);
        }

    } 
    else if(isset($donateur) && !empty($donateur)) {

        $data = $donateur->dons;

    } 
    else {

        $data = $dons;
    }
@endphp

<!-- Que Disent nos donateurs -->
<div id="donors_talks_carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
    <!-- Indicateurs -->
    <div class="carousel-indicators custom-indicators">
        @foreach($data as $index => $item)
           <button type="button" data-bs-target="#donors_talks_carousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>

    <!-- Slides -->
    <div class="carousel-inner">
        @foreach($data as $index => $item)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="donor-profil">
                    <img src="{{ Storage::url(optional($item->donateur)->photo) }}" class="rounded-circle" style="width:40px; height:40px;">
                    <span> 
                        {{ optional($item->donateur)->nom }} {{ optional($item->donateur)->prenom }}
                    </span>
                </div>
                <div class="donor-talk">
                    <p> {{ $item->texte }}</p>
                </div>
            </div>
        @endforeach    
    </div>

    <!-- Contrôles -->
    @if($data->count() > 1) 
        <button class="carousel-control-prev" type="button" data-bs-target="#donors_talks_carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#donors_talks_carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    @endif
</div>