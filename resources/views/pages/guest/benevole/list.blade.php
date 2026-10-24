
@extends('layouts.guest')

@section('content')

<div class="page-content">
   
    <!-- =====================================================
        Bloc Titre de la page
    ====================================================== -->
    <div class="page-title">
        <h1>
            <i class="fa fa-users"></i> Benevoles
        </h1>
    </div>


    <!-- =====================================================
        Bloc benevoles
    ====================================================== -->
    <div class="volunters">


        <div class="volunters-content">

            @forelse($benevoles as $benevole)

            <div class="volunter-item">
            
                <x-guest.benevole.volunter-item
                   :benevole="$benevole"
                />

            </div>

            @empty

            <div class="empty-content">

                <p>
                    Aucun element trouve !!!
                </p>

            </div>

            @endforelse

        </div>

    </div>

    <!-- Script externe -->
    <script src="{{ asset('script/pages/guest/about/about_us.js') }}"></script> 

</div>    

@endsection    