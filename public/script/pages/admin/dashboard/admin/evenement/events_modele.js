/* ***********************************************************************
 * FORMATTE LES DONNEES DESTINEES AU GRAPHIQUE
 * **********************************************************************/
function eventsModelChartFormatData(evenements){
    /* ---- Initialize la variable data_chart_obj ---- */
    var data_chart_obj = [];

    /* ---- Modeles evenementes ---- */
    var models = evenements.map((item) => item.model);

    /* ---- Unicite le tableau models ---- */
    models = models.filter((value,index,self) => self.indexOf(value) == index);
    
    /* ---- Parcour l'ensemble de models ---- */
    models.forEach(model => { 
        data_chart_obj.push({
            name: model,
            y: evenements.filter(item => item.model.toLowerCase() == model.toLowerCase()).length
        });
    });

    /* ---- Fixe a 10 la taille du tableau --- */
    data_chart_obj.length = 10;

    /* ---- Renvoie les donnees du graphique ---- */
    return data_chart_obj; 
}


/* ***********************************************************************
 * ILLUSTRATION GRAPHIQUE (BESOIN CHART GRAPH)
 * **********************************************************************/
function buildEventsModelChart(evenements){
    // Data retrieved from https://netmarketshare.com/
    // Make monochrome colors
    const colors = Highcharts.getOptions().colors.map((c, i) =>
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        Highcharts.color(Highcharts.getOptions().colors[0])
                  .brighten((i - 3) / 7)
                  .get()
    );

    /* ---- Initialise le texte ---- */
    const initialText='Illustration graphique modeles evenements organises';

    /* ---- Build the chart ---- */
    Highcharts.chart('events_modele_graph', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: window.chartGraph ? (window.chartGraph.dataType ? (window.chartGraph.dataType.toLowerCase()=='evenement' ? initialText+' annee <i style="color: cadetblue;">'+window.chartGraph.annee+'</i>' : initialText) : initialText) : initialText
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors,
                borderRadius: 5,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -70,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Evenement',
            data: eventsModelChartFormatData(evenements)
        }]
    });
}
