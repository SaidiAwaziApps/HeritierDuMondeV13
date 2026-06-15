
    @extends('layouts.admin')
    
    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-body">
                <div id="dashboard_content">
                    <div id="number_bloc">
                        <!-- <h6>
                            Benevole,Donateur,Don && Offre Emploie 
                        </h6> -->
                        <div id="number_bloc_item">
                            <div class="card">
                                <div class="card-body">
                                    <p>
                                        <span>
                                           <i class="fa fa-users"></i><br>
                                        </span>
                                        <span>
                                            Benevoles<br>
                                        </span>
                                        <span class="chart_total_br" id="benevole_total_nbr">
                                            <i class="fa fa-badge">
                                                {{ $benevoles->count() }}
                                            </i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <p>
                                        <span>
                                           <i class="fa fa-calendar"></i><br>
                                        </span>
                                        <span>
                                            Evenements<br>
                                        </span>
                                        <span class="chart_total_br" id="event_total_nbr">
                                            <i class="fa fa-badge">
                                                {{ $evenements->count() }}
                                            </i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <p>
                                        <span>
                                           <i class="fa fa-support"></i><br>
                                        </span>
                                        <span> 
                                            Donateurs<br> 
                                        </span>
                                        <span class="chart_total_br" id="donateur_total_nbr">
                                            <i class="fa fa-badge">
                                               {{ $donateurs->count() }}
                                            </i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <p>
                                        <span>
                                            <i class="fa fa-support"></i><br>
                                        </span>
                                        <span>
                                            Besoins-Dons<br>
                                        </span>
                                        <span class="chart_total_br" id="don_total_nbr">
                                            <i class="fa fa-badge">
                                               {{$besoins->count().' - '.$dons->count() }}
                                            </i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <p>
                                        <span>
                                            <i class="fa fa-tasks"></i><br>
                                        </span>
                                        <span>
                                            Emploies<br>
                                        </span>
                                        <span class="chart_total_br" id="offre_emploie_total_nbr">
                                            <i class="fa fa-badge">
                                                {{ $offre_emploies->count() }}
                                            </i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- fin number_bloc_item -->
                        <div id="charts_bloc">
                            <div id="evenement_bloc">
                                <h6 style="text-align: left;font-size: 18px;font-family: italic;opacity: 0.8;">
                                   <i class="fa fa-calendar"></i> Evenements
                                </h6>
                                <div id="evenement_bloc_content">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="events_moment_graph">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="events_modele_graph">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- fin evenements_bloc -->
                            <div id="donation_bloc">
                                <h6>
                                    Dons & Donateurs
                                </h6>
                                <div id="donation_bloc_content">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="donateurs_chart_graph">
                                                <!-- Graphique illustration -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="dons_chart_graph">
                                                <!-- Graphique illustration -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="besoins_chart_graph">
                                                <!-- Graphique illustration -->
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <!-- Fin donation_bloc -->
                            <div id="offre_emploie_bloc">
                                <h6>
                                    Offre emploie
                                </h6>
                                <div id="offre_emploie_bloc_content">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="offre_emploie_org_graph">
                                                <!-- Contenu Graphique -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="offre_emploie_domaine_graph">
                                                <!-- Contenu Graphique -->
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <!-- Fin offre_emploie_bloc -->  
                        </div>
                        <!-- fin charts_bloc -->
                        
                        <div id="specify_moment_bloc">
                            <div class="card">
                                <div class="card-body">
                                    <form method="GET" action="#" class="form-inline">
                                        <div class="form-group">
                                            <label for="annee">
                                               <i class="fa fa-calendar"></i> Annee:<i id="required-sign">*</i>
                                            </label>
                                            <input type="number" name="annee" id="annee" class="form-control input-sm" placeholder="Specifier l'annee"  required>
                                            <span id="feedback_chart_graph">
                                                
                                            </span>
                                        </div>
                                        <div class="dropdown">
                                            <div class="grid">
                                                <button type="button" class="btn btn-secondary active dropdown-toggle" data-bs-toggle="dropdown" style="width: 40px;">
                                                    <span>
                                                        <i class="sr-only"></i>
                                                    </span>    
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <span>
                                                            <i class="fa fa-list"></i> Options <i class="fa fa-angle-down"></i>     
                                                        </span>
                                                    </li>  
                                                    <li class="dropdown-divider"></li>
                                                    <li class="chart-option-item" id="benevole">
                                                        <span>
                                                            <i class="fa fa-users"></i> Benevoles
                                                        </span>    
                                                    </li> 
                                                    <li class="dropdown-divider"></li>
                                                    <li class="chart-option-item" id="evenement">
                                                        <span>
                                                            <i class="fa fa-calendar"></i> Evenements
                                                        </span>     
                                                    </li>     
                                                    <li class="dropdown-divider"></li>
                                                    <li class="chart-option-item" id="donation">
                                                        <span>
                                                            <i class="fa fa-support"></i> Donation
                                                        </span>
                                                    </li> 
                                                    <li class="dropdown-divider"></li>
                                                    <li class="chart-option-item" id="offre_emploie">
                                                        <span>
                                                            <i class="fa fa-tasks"></i> Emploies
                                                        </span>
                                                    </li> 
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- fin year_form_bloc -->
                    </div>
                </div>
            </div>
        </div> 

        <!-- <script type="text/javascript">
            import Highcharts from 'https://code.highcharts.com/es-modules/masters/highcharts.src.js';
            import 'https://code.highcharts.com/es-modules/masters/modules/exporting.src.js';
        </script> -->

        <script type="text/javascript">
            window.APP_URL = @json(env('APP_URL'));
        </script>
         
         <script type="text/javascript">
            let benevoles = @json($benevoles);
        </script>

        <script type="text/javascript">
            let besoins = @json($besoins);
        </script>

        <script type="text/javascript">
            let dons = @json($dons);
        </script>

        <script type="text/javascript">
            let offre_emploies = @json($offre_emploies);
        </script>

        <script type="text/javascript">
            let evenements = @json($evenements);
        </script>

        <script type="text/javascript">
            window.chartGraph = {
                annee: null,
                dataType: null
            }
        </script>
        
        <!-- Inclus script js -->
        <script src="{{ asset('script/pages/admin/dashboard/admin/index.js') }}"></script>
    </div>    
    @endsection
