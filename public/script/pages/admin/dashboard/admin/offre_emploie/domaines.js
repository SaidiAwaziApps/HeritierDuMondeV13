/* ***********************************************************************
 * FORMATTE LES DONNEES DESTINEES AU GRAPHIQUE
 * **********************************************************************/
function domainesChartFormatData(offre_emploies) {
    /* ---- Variable data_chart_obj --- */
    const data_chart_obj = [];

    /* ---- Variable data_chart_array ---- */
    const data_chart_array = [];

    /* ---- Variable organisations ---- */
    const domaines = offre_emploies.map(item => item.domaine);

    /* ---- Rend unique le nom de l'organisation ---- */
    domaines.filter((value,index,self) => self.indexOf(value) == index);

    /* ---- Parcour le tableau organisme ---- */
    domaines.forEach(dom => {
        const nbr_offr = offre_emploies.filter((item) => item.domaine == dom).length;
        data_chart_obj.push({
            domaine: dom,
            nbr_offr: nbr_offr
        });
    });

    /* ---- Trie le tableau data_chart_obj ---- */
    data_chart_obj.sort((a,b) => b.nbr_offr - a.nbr_offr);

    /* ---- Fixe a 10 la taille du tableau(10 elements) ---- */
    data_chart_obj.length = 10;

    /* ---- Parcour l'ensemble des elements du tableau data_chart_obj ---- */
    data_chart_obj.forEach((value,index) => {
        // Charge les donnees
        data_chart_array.push([
            value.domaine,
            value.nbr_offr,
            index == 0 ? true : false,
            index == 0 ? true : false
        ]);
        // Cas index=0(Active element(s)) du graphique
    });

    /* ---- Renvoie les donnees formatees --- */
    return data_chart_array;
}


/* ***********************************************************************
 * ILLUSTRATION GRAPHIQUE (BESOIN CHART GRAPH)
 * **********************************************************************/
function buildDomainesGraphChart(offre_emploies){
    /* ---- Initialize le texte ---- */
    const initialText = 'Illustration graphique de top domaines d\'offres d\'emploie';

    /* ---- Build the chart ---- */
    Highcharts.chart('offre_emploie_domaine_graph', {
        // chart: {
            //     styledMode: true
        // },
        title: {
            text:  window.chartGraph ? (window.chartGraph.dataType ? (window.chartGraph.dataType.toLowerCase()=='offre_emploie' ? initialText+'<br> de l\'an <i style="color: cadetblue;">'+window.chartGraph.annee+'</i>' : initialText) : initialText) : initialText
        },
        subtitle: {
            text: 'Source: <a href="/offre-emploie/list" target="_blank">H.M</a>'
        },
        series: [{
            type: 'pie',
            allowPointSelect: true,
            keys: ['name', 'y', 'selected', 'sliced'],
            data: domainesChartFormatData(offre_emploies),
            showInLegend: true
        }]
    });
}