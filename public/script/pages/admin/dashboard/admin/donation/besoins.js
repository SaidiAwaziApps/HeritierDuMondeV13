/* ********************************************************************************
 * CONVERSION MONTANT (USD - EURO)
 * *******************************************************************************/
function convertBesoinAmount(amount, amountCurrency) {
    if (amountCurrency != window.paymentSetting.currency) {
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
function getBesoinDisplayCurrency() {
    return window.paymentSetting.currency;
}

/* ********************************************************************************
 * ICONES DE LA MONNAIE (USD // EURO)
 * *******************************************************************************/
function getBesoinCurrencyIcon(currency) {
    const icons = {
        USD: '$',
        EUR: '€'
    };

    return icons[currency];
}

/* ***********************************************************************
 * CALCULE LE MONTANT TOTAL POUR L' ENSEMBLE DE BESOIN
 * **********************************************************************/
function getTotalBesoinMontant(besoins) {
    /* ---- Renvoie le montant total ---- */
    return besoins.reduce((accumulator,current) => accumulator + convertBesoinAmount(current.montant, current.currency), 0);
}


/* ***********************************************************************
 * CAlCULE LE MONTANT TOTAL RECU (RECEPTIONNE)
 * **********************************************************************/
function getTotalMontantRecu(besoins){
    /* ---- Initialise le montant ---- */
    let montant = 0;    

    /* ---- Parcours l'ensemble des dons(donnees) ---- */
    besoins.forEach((item) => {
        if(item.besoin_dons){
            item.besoin_dons.forEach((bd) => { // "bd" d' ou besoin_don
                if(bd.don.reception){
                    montant += convertBesoinAmount(bd.don.montant, bd.don.currency); 
                }   
            });
        } 
    });

    /* ---- Renvoie le montant total recu ---- */
    return montant;
}



/* ***********************************************************************
 * FORMATE LES DONNEES DESTINEES AU GRAPHIQUE (BESOIN CHART)
 * **********************************************************************/
function besoinsChartFormatData(besoins){
    /* ---- Total Montant recu ---- */
    var total_montant_recu = getTotalMontantRecu(besoins);

    /* ---- Total montant non recu ---- */
    const total_montant_montant_non_recu = function(besoins){
        // Variable solde
        const solde = getTotalBesoinMontant(besoins) - getTotalMontantRecu(besoins);
        // Solde positif
        if(solde > 0) {
           return solde; 
        } else  {
           return 0; 
        }
    }

    /* ---- Donnee illustratif(Chart) ---- */
    const data_chart = [{
            name: 'Recu',
            y: total_montant_recu
        },{
            name: 'Non Recu',
            y: total_montant_montant_non_recu(besoins)
    }];

    /* ---- Renvoie les donnees data_chart ---- */
    return data_chart;
}


/* ***********************************************************************
 * ILLUSTRATION GRAPHIQUE (BESOIN CHART GRAPH)
 * **********************************************************************/
function buildBesoinsChartGraph(besoins){
    /* ---- Initialize le texte ---- */
    const initialText = 'Illustration des montants reçus ou non en fonction des besoins';

    /* ---- Construit le graphique ---- */
    Highcharts.chart('besoins_chart_graph', {
        chart: {
            type: 'pie',
            custom: {},
            events: {
                render() {
                    const chart = this,
                    series = chart.series[0];
                    let customLabel = chart.options.chart.custom.label;

                    if (!customLabel) {
                        customLabel = chart.options.chart.custom.label =
                        chart.renderer.label(
                            'S. necessaire<br/>' +
                            '<strong>'+getTotalBesoinMontant(besoins)+' '+getBesoinCurrencyIcon(getBesoinDisplayCurrency())+'</strong>'
                        )
                        .css({
                            color: '#000',
                            textAnchor: 'middle'
                        })
                        .add();
                    }

                    const x = series.center[0] + chart.plotLeft,
                          y = series.center[1] + chart.plotTop - (customLabel.attr('height') / 2);

                    customLabel.attr({
                          x,
                          y
                    });
                    // Set font size based on chart diameter
                    customLabel.css({
                        fontSize: `${series.center[2] / 12}px`
                    });
                }
            }
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        title: {
            text: window.chartGraph ? (window.chartGraph.dataType ? (window.chartGraph.dataType.toLowerCase()=='donation' ? initialText+'<br> de l\'an <i style="color: cadetblue;">'+window.chartGraph.annee+'</i>' : initialText) : initialText) : initialText 
        },
        subtitle: {
            text: 'Source: <a href="/besoin/list" target="_blank">H.M</a>'
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.0f}%</b>'
        },
        legend: {
            enabled: true,
        },
        plotOptions: {
            series: {
                allowPointSelect: false,
                cursor: 'pointer',
                borderRadius: 8,
                dataLabels: [{
                    enabled: true,
                    distance: 20,
                    format: '{point.name}'
                },{
                    enabled: true,
                    distance: -15,
                    format: '{point.percentage:.0f}%',
                    style: {
                        fontSize: '0.9em'
                    }
                }],
                showInLegend: true
            }
        },
        series: [{
            name: 'Total Somme(montant) necessaire',
            colorByPoint: true,
            innerSize: '75%',
            data: besoinsChartFormatData(besoins)
        }]
    });   
}