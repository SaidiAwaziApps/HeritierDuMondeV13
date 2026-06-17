/* ********************************************************************************
 * CONVERSION MONTANT (USD - EURO)
 * *******************************************************************************/
function convertAmount(amount, amountCurrency) {
    if (
        window.paymentSetting.currency_display_mode.toLowerCase() != 'current' &&
        amountCurrency != window.paymentSetting.currency
        && currency_exchange_rate
    ) {
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
function getDisplayCurrency() {
    return (window.paymentSetting.currency_display_mode.toLowerCase() === 'current')
        ? window.paymentSetting.currency
        : besoin.currency;
}


/* *********************************************************************
 * CALCULE LE MONTANT TOTAL RECU
 * *********************************************************************/
function getTotalMontantRecu() {
    /* ---- Initialise le montant ---- */
    var montant = 0;

    /* ---- Parcours l'ensemble des dons(donnees) ---- */
    if (besoin.besoin_dons && besoin.besoin_dons.length > 0) {
        besoin.besoin_dons.forEach((item) => {
            if (item.don.reception) {
                montant += convertAmount(
                    item.don.montant,
                    item.don.currency
                );
            }
        });
    }

    /* ---- Renvoie le montant total recu ---- */
    return montant;
}


/* *********************************************************************
 * FORMATTE LES DONNEES DESTINEES AU GRAPHIQUE
 * *********************************************************************/
function besoinChartFormatData() {
    /* ---- Total Montant recu ---- */
    const total_montant_recu = getTotalMontantRecu();

    /* ---- Total montant non recu ---- */
    const total_montant_montant_non_recu = function () {
        // Renvoie la solde (Difference entre le montant que demande le besoin (convertie) et le montant total recu(convertie))
        return convertAmount(besoin.montant, besoin.currency) - total_montant_recu > 0
            ? convertAmount(besoin.montant, besoin.currency) - total_montant_recu
            : 0;
    };

    /* ---- Donnee illustratif(Chart) ---- */
    const data_chart = [
        {
            name: 'Recu',
            y: total_montant_recu // Convertie
        },
        {
            name: 'Non Recu',
            y: total_montant_montant_non_recu() // Convertie
        }
    ];

    /* ---- Renvoie les donnees data_chart ---- */
    return data_chart;
}


/* ********************************************************************************
 * ICONES DE LA MONNAIE (USD // EURO)
 * *******************************************************************************/
function getCurrencyIcon(currency) {
    const icons = {
        USD: '$',
        EUR: '€'
    };

    return icons[currency];
}


/* ******************************************************************
 * ILLUSTRATION GRAPHIQUE (CHART GRAPH)
 * ******************************************************************/
// if(strtolower($paymentSetting->currency_display_mode) != 'current' && $besoin->currency != $paymentSetting->currency) {
//     if($besoin->currency == 'USD') {
//         $defaultAmount = $besoin->montant * $currency_exchange_rate;
//     }
//     else {
//         $defaultAmount = $besoin->montant / $currency_exchange_rate;
//     }
// }
function buildChartGraph() {
    Highcharts.chart('besoin_chart_graph', {
        chart: {
            type: 'pie',
            custom: {},
            events: {
                render() {
                    const chart = this;
                    const series = chart.series[0];

                    let customLabel = chart.options.chart.custom.label;

                    if (!customLabel) {
                        customLabel = chart.options.chart.custom.label =
                            chart.renderer.label(
                                'S. necessaire<br/>' +
                                '<strong>' +
                                convertAmount(besoin.montant, besoin.currency) +
                                getCurrencyIcon(getDisplayCurrency()) +
                                '</strong>'
                            )
                            .css({
                                color: '#000',
                                textAnchor: 'middle'
                            })
                            .add();
                    }

                    const x = series.center[0] + chart.plotLeft;
                    const y = series.center[1] +
                        chart.plotTop -
                        (customLabel.attr('height') / 2);

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
            text: 'Illustration des montants reçus ou non en fonction du besoin'
        },
        subtitle: {
            text: 'Source: <a href="/besoin/list" target="_blank">H.M</a>'
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.0f}%</b>'
        },
        legend: {
            enabled: true
        },
        plotOptions: {
            series: {
                allowPointSelect: false,
                cursor: 'pointer',
                borderRadius: 8,
                dataLabels: [
                    {
                        enabled: true,
                        distance: 20,
                        format: '{point.name}'
                    },
                    {
                        enabled: true,
                        distance: -15,
                        format: '{point.percentage:.0f}%',
                        style: {
                            fontSize: '0.9em'
                        }
                    }
                ],
                showInLegend: true
            }
        },
        series: [{
            name: 'Total Somme(montant) necessaire',
            colorByPoint: true,
            innerSize: '75%',
            data: besoinChartFormatData()
        }]
    });
}


/*  ******************************************************************
 *  LORSQUE LE DOM EST CHARGE (DISPONIBLE)
 *  ******************************************************************/
document.addEventListener('DOMContentLoaded', function () {
    // Variables icones
    const imagesIcon = document.querySelector('i[class="fa fa-images"]');
    const globeIcon = document.querySelector('i[class="fa fa-globe"]');

    // Modifie la couleur des icones
    imagesIcon ? imagesIcon.style.color = 'cadetblue' : '';
    globeIcon ? globeIcon.style.color = 'cadetblue' : '';

    // Appel a la mehode buildChartGraph
    buildChartGraph();
});