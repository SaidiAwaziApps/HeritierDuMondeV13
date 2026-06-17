/* ********************************************************************************
 * CONVERSION MONTANT (USD - EURO)
 * *******************************************************************************/
function convertDonAmount(amount, amountCurrency) {
    if (amountCurrency != window.paymentSetting.currency && currency_exchange_rate) {
        return amountCurrency === 'USD'
            ? amount * currency_exchange_rate
            : amount / currency_exchange_rate;
    } else {
        return amount;
    }
}

/* *********************************************************************
 * RENVOIE LA MONAIE
 * **********************************************************************/
function getDonDisplayCurrency() {
    return window.paymentSetting.currency;
}

/* ********************************************************************************
 * ICONES DE LA MONNAIE (USD // EURO)
 * *******************************************************************************/
function getDonCurrencyIcon(currency) {
    const icons = {
        USD: '$',
        EUR: '€'
    };

    return icons[currency];
}


/* ***********************************************************************
 * FORMATTE LES DONNEES DESTINEES AU GRAPHIQUE
 * **********************************************************************/
function donsChartFormatData(besoins) {
    /* ---- Initialize les variables(tableaux) ---- */
    var data_chart_obj = [];
    var data_chart_array = [];

    /* ---- Dons sans but specifique ---- */
    const no_specify_don_length = dons.filter(item => !item.besoin_dons).length;
    const no_specify_dons_amount = dons.filter(item => !item.besoin_dons).reduce((accumulator, current) => accumulator + convertDonAmount(current.montant, current.currency), 0);

    /* --- -----*/
    if(no_specify_don_length > 0) {
        data_chart_array.push([
            'Pas specifie',
            no_specify_dons_amount,
            false,
            false
        ]); 
    }

    /* ---- Parcourt des donnees besoins ---- */
    besoins.forEach((item) => {
        if(item.besoin_dons){
            const totalMontant = item.besoin_dons.reduce(
                (accumulator, current) =>
                    accumulator + convertDonAmount(
                        current.don.montant,
                        current.don.currency
                    ),
                0
            );

            data_chart_obj.push({
               besoin: '<a href="/besoin/details/'+item.id+'" style="font-size: 16px;font-family: italic;color: black;opacity: 0.8;text-decoration: none;">'+item.intitule+'</a>',
               montant: totalMontant
            });
        }
    });


    /* ---- Organise le donnee en fonction de montant(Decroissant) ---- */
    data_chart_obj = data_chart_obj.sort((a,b) => b.montant - a.montant);

    /* ---- Fixe les nombres d'item a 10 ---- */
    data_chart_obj = data_chart_obj.slice(0, 10);

    /* ---- Remplissage du tableau data_chart_array ---- */
    data_chart_obj.forEach(function(item,index){
        data_chart_array.push([
            item.besoin,
            item.montant,
            false,
            false
        ]);

        //Cas index=0(Active element(s)) du graphique
        if(index == 0){
            if(data_chart_obj[index + 1] && item.montant >= data_chart_obj[index + 1].montant){
               data_chart_array[index][2] = true;
               data_chart_array[index][3] = true; 
            }
        }else {
            if(item.montant == data_chart_obj[index - 1].montant){
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
    const initialText = 'Illustration des motivations des dons, avec ou sans besoin identifié';

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
        tooltip: {
            pointFormat: '<b>{point.y} ' + getDonCurrencyIcon(getDonDisplayCurrency()) + '</b>'
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