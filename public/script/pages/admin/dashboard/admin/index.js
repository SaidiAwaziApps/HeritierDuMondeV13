/* ***********************************************************************
 * EMNSEMBLE DES EVENEMENTS SE PRODUISANT AU MONENT DE LA RECHERCHE
 * **********************************************************************/
function feedback_display(action){
    /* ---- Variable input#annee ---- */
    const annee = document.querySelector('input[id="annee"]').value;
    /* --- Variable feedback ---- */
    const feedback_chart_graph = document.querySelector('span[id="feedback_chart_graph"]');

    /* ---- En cas d'absence de donnee ---- */
    if(action.toLowerCase() == 'block'){
        feedback_chart_graph.style.display = 'block';
        feedback_chart_graph.style.color   = 'red';
        feedback_chart_graph.innerHTML     = annee ? 'Donnees non trouvees !!!' : 'Veuillez specifier l\'annee !!!';
    } else {
        feedback_chart_graph.style.display = 'none';
        feedback_chart_graph.style.color   = 'black';
    }
} 


/* ***********************************************************************
 * INITIALISE L' ENSEMBLE DE GRAPHIQUE (CHARTS)
 * **********************************************************************/
function chartInit(evenements,dons,besoins,offre_emploies) {
    /* --- Offres emploies ---*/
    buildOrgGraphChart(offre_emploies);
    buildDomainesGraphChart(offre_emploies);

    /* ---- Evenements ---- */
    buildEventsModelChart(evenements);
    buildEventsMomentChart(evenements);

    /* ---- Donations ---- */  
    buildDonateursChartGraph(dons);
    buildDonsChartGraph(besoins);
    buildBesoinsChartGraph(besoins);
}



/* ***********************************************************************
 * ILLUSTRE UN TYPE DE GRAPHIQUE SPECIFIQUE A UNE ANNEE
 * **********************************************************************/
function chartForYear(annee,dataType) {
    /* ---- Reinitialize l'apparence des textes chart_total_br ---- */
    document.querySelectorAll('span[class="chart_total_br"]').forEach((item) => {
        item.style.color = 'black';      
    });   

    /* ---- Reinitialize la variable globale  window.chartGraph ---- */
    window.chartGraph = {
        annee: null,
        dataType: null
    }

    /* ---- En cas du type de donnee ---- */
    if(dataType.toLowerCase() == 'benevole') {
        // Filtre les donnees
        const data = benevoles.filter((item) => new Date(item.created_at).getFullYear() == annee);

        // Absence de donnee
        if(!data || data.length == 0){ 
            // Affiche le feedback 
            feedback_display('block');
            // Cache le feedback 
            setTimeout(function(){
               feedback_display('none');
            },4000);
            // Appel de la fonction avec parametres a valeurs initiales
            // chartInit(evenements,dons,besoins,offre_emploies)           
        } else {
            // Scrool vers la partie 
            document.querySelector('div[id="global_content"]').scrollIntoView({
               behavior: 'smooth',
               block: 'start' 
            });
            // Modifie l'apparence du text pour benevole_total_nbr
            document.querySelectorAll('span[id="benevole_total_nbr"]')[0].style.color = 'cadetblue';
            // Appel de la fonction avec parametres a valeurs initiales
            chartInit(evenements,dons,besoins,offre_emploies)
        } 
    }
    else if(dataType.toLowerCase() == 'evenement') {
        // Filtre les donnees
        const data = evenements.filter(item => item.type.toLowerCase() == 'journalier' ? new Date(item.date_du_jour).getFullYear()==annee : new Date(item.periode_date_debut).getFullYear() == annee);
        // Absence de donnee
        if(!data || data.length == 0){ 
            // Affiche le feedback 
            feedback_display('block');
            // Cache le feedback 
            setTimeout(function(){
               feedback_display('none');
            },4000);
            //Appel de la fonction avec parametres a valeurs initiales
            // chartInit(evenements,dons,besoins,offre_emploies)           
        } else {
            // Ajoute la valeur annee dans l'object
            data.annee = annee;
            // Scrool vers la partie 
            document.querySelector('div[id="evenement_bloc"]').scrollIntoView({
               behavior: 'smooth',
               block: 'start' 
            });
            // Modifie l'apparence du text pour event_total_nbr
            document.querySelector('span[id="event_total_nbr"]').style.color='cadetblue';
            // Definit la variable globale  window.chartGraph
            window.chartGraph = {
                annee: annee,
                dataType: 'evenement'
            }
            //Appel de la fonction avec parametres a valeurs initiales
            chartInit(evenements,dons,besoins,offre_emploies)
            //Appel de la fonction avec parametre avec data
            chartInit(data,dons,besoins,offre_emploies)
        }
    } 
    else if(dataType.toLowerCase() == 'donation') {
        // Initialise l'object data
        const data = {
            besoins: null,
            dons: null,
        }
        // Filtre les besoins
        data.besoins = besoins.filter(item => new Date(item.created_at).getFullYear() == annee); 
        // Filtre les dons
        data.dons = dons.filter(item => new Date(item.created_at).getFullYear() == annee);
        // Absence de donnees
        if(!data || data.besoins.length == 0 || data.dons.length == 0){
            // Affiche le feedback 
            feedback_display('block');
            // Cache le feedback 
            setTimeout(function(){
               feedback_display('none');
            },4000);
            // Appel de la fonction avec parametres a valeurs initiales
            // chartInit(evenements,dons,besoins,offre_emploies)           
        } else {
            // Scrool vers la partie 
            document.querySelector('div[id="donation_bloc"]').scrollIntoView({
                behavior: 'smooth',
                block: 'start' 
            });
            // Modifie l'apparence du text pour donateur_total_nbr
            document.querySelector('span[id="donateur_total_nbr"]').style.color='cadetblue';
            // Modifie l'apparence du text pour don_total_nbr
            document.querySelector('span[id="don_total_nbr"]').style.color='cadetblue';
            //Definit la variable window chart
            window.chartGraph= {
                annee: annee,
                dataType: 'donation'
            }
            //Appel de la fonction avec parametres a valeurs initiales
            chartInit(evenements,dons,besoins,offre_emploies)
            //Appel de la fonction avec parametre avec data
            chartInit(evenements,data.dons,data.besoins,offre_emploies)
        } 
    }
    else  {
        // Filtre les donnees
        const data = offre_emploies.filter(item => new Date(item.created_at).getFullYear() == annee);
        // Absence de donnee
        if(!data || data.length == 0){
            // Affiche le feedback 
            feedback_display('block');
            // Cache le feedback 
            setTimeout(function(){
               feedback_display('none');
            },4000);
            //Appel de la fonction avec parametres a valeurs initiales
            // chartInit(evenements,dons,besoins,offre_emploies)           
        } else {
            // Scrool vers la partie 
            document.querySelector('div[id="offre_emploie_bloc"]').scrollIntoView({
                behavior: 'smooth',
                block: 'start' 
            });
            // Modifie l'apparence du text pour event_total_nbr
            document.querySelector('span[id="offre_emploie_total_nbr"]').style.color = 'cadetblue';
            // Definit la variable window chart
            window.chartGraph = {
                annee: annee,
                dataType: 'offre_emploie'
            }
            // Appel de la fonction avec parametres a valeurs initiales
            chartInit(evenements,dons,besoins,offre_emploies)
            // Appel de la fonction avec parametre avec data
            chartInit(evenements,dons,besoins,data)
        }
    }
}


/* ***********************************************************************
 * AU MOMENT DE CHARGEMENT DU CONTENU DOM
 * **********************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    /* --- Variables DOM ---- */
    const chartOptionItems = document.querySelectorAll('li[class="chart-option-item"]');
    const yearInput = document.querySelector('input[id="annee"]')

    /*  Lorsqu'on clique sur chacun des items (chartOptionItems) */
    chartOptionItems.forEach(item => {
        item.onclick = function(e) {            
            // Recupere la valeur de l' input (annee)
            const annee = yearInput.value;
            // Appel a la methode charForYear (illustrant le graph)
            chartForYear(annee,e.currentTarget.getAttribute('id'));
        }
    }); 

    /* ---- Appel methode initiale (chatInit) --- */ 
    chartInit(evenements,dons,besoins,offre_emploies);     
});
       


