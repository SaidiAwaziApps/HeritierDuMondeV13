/* ***********************************************************************
 * FORMATTE LES DONNEES DESTINEES AU GRAPHIQUE
 * **********************************************************************/
function eventsMomentChartFormatData(evenements){
    /* ---- Initialize la variable data_chart_obj ---- */
    var data_chart_obj = [];

    /* ---- Initialize le tableau categorie ---- */
    var categories = ['0', '1', '2', '3', '4', '5', '6', '7', '8','9', '10', '11'];

    /* ---- Filtrer les evenements ---- */
    evenements = evenements.filter((item) => new Date(item.created_at).getFullYear()==new Date(evenements[evenements.length-1].created_at).getFullYear());

    /* ---- Parcourt de l' ensemble des elements filtres ---- */
    categories.forEach(value => {
        // filtrage elements
        const events = evenements.filter((event) => event.type.toLowerCase()=='journalier' ? new Date(event.date_du_jour).getMonth()==value : new Date(event.periode_date_debut).getMonth() == value);
        // Push (charge) resultats du filtrahe
        data_chart_obj.push(events.length); 
    });

    /* ---- Renvoie la data_chart_obj ---- */
    return data_chart_obj;    
}


/* ***********************************************************************
 * ILLUSTRATION GRAPHIQUE (BESOIN CHART GRAPH)
 * **********************************************************************/
function buildEventsMomentChart(evenements){
    /* ---- Initialize le texte ---- */
    const initialText='Illustration graphique moments les plus en evenement';

    /* ---- Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature ---- */
    Highcharts.chart('events_moment_graph', {
        chart: {
            type: 'line'
        },
        title: {
            text: window.chartGraph ? (window.chartGraph.dataType ? (window.chartGraph.dataType.toLowerCase()=='evenement' ? initialText+' de l\'an  <i style="color: cadetblue;">'+window.chartGraph.annee+'</i>' : initialText) : initialText) : initialText
        },
        subtitle: {
            text: 'Source: <a href="/evenement/list" target="_blank">H.M</a>'
        },
        xAxis: {
            categories: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                'Oct', 'Nov', 'Dec'
            ]
        },
        yAxis: {
            title: {
                text: 'Nombre d\'evenements'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Evenements',
            data: eventsMomentChartFormatData(evenements)
        }]
    });
}

