/* ***********************************************************************
 * FORMATTE LES DONNEES DESTINEES AU GRAPHIQUE
 * **********************************************************************/
function orgChartFormatData(offre_emploies) {
    /* ---- Variable data_chart_obj ---- */
    const data_chart_obj = [];

    /* ---- Variable data_chart_array ---- */
    const data_chart_array = [];

    /* ---- Variable organisations ---- */
    const organismes = offre_emploies.map(item => item.organisme);

    /* ---- Rend unique le nom de l'organisation ---- */
    organismes.filter((value,index,self) => self.indexOf(value) == index);

    /* ---- Parcour le tableau organisme --- */
    organismes.forEach(org => {
        // Charge les donnees
        data_chart_obj.push({
            organisme: org,
            nbr_offr:  offre_emploies.filter((item) => item.organisme == org).length
        });
    });

    /* ---- Trie le tableau data_chart_obj ---- */
    data_chart_obj.sort((a,b) => b.nbr_offr - a.nbr_offr);

    /* ---- Fixe a 10 la taille du tableau(10 elements) ---- */
    data_chart_obj.length = 10;

    /* ---- Parcour l'ensemble des elements du tableau data_chart_obj ---- */
    data_chart_obj.forEach(item => {
       data_chart_array.push([
          item.organisme,
          item.nbr_offr
       ]);
    });

    /* ---- Renvoie les donnees formantees ---- */
    return data_chart_array;
}


/* ***********************************************************************
 * ILLUSTRATION GRAPHIQUE (BESOIN CHART GRAPH)
 * **********************************************************************/
function buildOrgGraphChart(offre_emploies){ 
    /* ---- Initialize le texte ---- */
    const initialText = 'Illustration graphique top entreprises emetteurs d\'offres d\'emploie';

    /* ---- Build the chart ---- */
    const chart = new Highcharts.Chart({
        chart: {
            renderTo: 'offre_emploie_org_graph',
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                enabled: false
            }
        },
        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: 'Cars sold: {point.y}'
        },
        title: {
            text: window.chartGraph ? (window.chartGraph.dataType ? (window.chartGraph.dataType.toLowerCase()=='offre_emploie' ? initialText+'<br> de l\'an <i style="color: cadetblue;">'+window.chartGraph.annee+'</i>' : initialText) : initialText) : initialText
        },
        subtitle: {
            text: 'Source: <a href="/offre-emploie/list" target="_blank">H.M</a>'
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [{
            data: orgChartFormatData(offre_emploies),
            colorByPoint: true
        }]
    });

    /* ---- Constante showValues ---- */
    const showValues = function showValues() {
        document.getElementById(
            'alpha-value'
        ).innerHTML = chart.options.chart.options3d.alpha;
        document.getElementById(
            'beta-value'
        ).innerHTML = chart.options.chart.options3d.beta;
        document.getElementById(
            'depth-value'
        ).innerHTML = chart.options.chart.options3d.depth;
    }

    /* ---- Activate the sliders ---- */
    document.querySelectorAll(
        '#sliders input'
    ).forEach(input => input.addEventListener('input', e => {
        chart.options.chart.options3d[e.target.id] = parseFloat(e.target.value);
        showValues();
        chart.redraw(false);
    }));
}


