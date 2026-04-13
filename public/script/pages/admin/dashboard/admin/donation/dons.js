/* ***********************************************************************
 * FORMATTE LES DONNEES DESTINEES AU GRAPHIQUE
 * **********************************************************************/
function donsChartFormatData(besoins) {
    /* ---- Initialize les variables(tableaux) ---- */
    var data_chart_obj = [];
    var data_chart_array = [];

    /* ---- Parcourt des donnees besoins ---- */
    besoins.forEach(function(item){
        if(item.besoin_dons){
            const totalMontant = item.besoin_dons.reduce((accumulator,current) => accumulator + current.don.montant,0);
            data_chart_obj.push({
               besoin: '<a href="/besoin/details/'+item.id+'" style="font-size: 16px;font-family: italic;color: black;opacity: 0.8;text-decoration: none;">'+item.intitule+'</a>',
               montant: totalMontant
            });
        }
    });

    /* ---- Organise le donnee en fonction de montant(Decroissant) ---- */
    data_chart_obj = data_chart_obj.sort((a,b) => b.montant - a.montant);

    /* ---- Fixe les nombres d'item a 10 ---- */
    data_chart_obj.length = 10;

    /* ---- Remplissage du tableau data_chart_array ---- */
    data_chart_obj.forEach(function(value,index){
        data_chart_array.push([
            value.besoin,
            value.montant,
            false,
            false
        ]);

        //Cas index=0(Active element(s)) du graphique
        if(index == 0){
            if(value.montant >= data_chart_obj[index + 1].montant){
               data_chart_array[index][2] = true;
               data_chart_array[index][3] = true; 
            }
        }else {
            if(value.montant == data_chart_obj[index - 1].montant){
                data_chart_array[index][2] = true;
                data_chart_array[index][3] = true; 
            }
        }
    });

    /* --- Renvoie les donnees finales (formantees) --- */
    return data_chart_array;
}



/* ***********************************************************************
 * ILLUSTRATION GRAPHIQUE (BESOIN CHART GRAPH)
 * **********************************************************************/
function buildDonsChartGraph(besoins) {
    /* ---- Initialize le texte ---- */
    const initialText = 'Illustration graphique des besoins largement statisfaits';

    /* ---- Build the chart ---- */ 
    Highcharts.chart('dons_chart_graph', {
        // chart: {
        //     styledMode: true
        // },
        title: {
            text: window.chartGraph ? (window.chartGraph.dataType ? (window.chartGraph.dataType.toLowerCase()=='donation' ? initialText+'<br> de l\'an <i style="color: cadetblue;">'+window.chartGraph.annee+'</i>' : initialText) : initialText) : initialText 
        },
        subtitle: {
            text: 'Source: <a href="/don/list" target="_blank">H.M</a>'
        },
        series: [{
            type: 'pie',
            allowPointSelect: true,
            keys: ['name', 'y', 'selected', 'sliced'],
            data: donsChartFormatData(besoins),
            showInLegend: true
        }] 
    });
}
