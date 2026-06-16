/* ********************************************************************************
 * CONVERSION MONTANT (USD - EURO)
 * *******************************************************************************/
function convertDonateurAmount(amount, amountCurrency) {
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
function getDonateurDisplayCurrency() {
    return window.paymentSetting.currency;
}

/* ********************************************************************************
 * ICONES DE LA MONNAIE (USD // EURO)
 * *******************************************************************************/
function getDonateurCurrencyIcon(currency) {
    const icons = {
        USD: '$',
        EUR: '€'
    };

    return icons[currency];
}



/* ***********************************************************************
 * FORMATTE LES DONNEES DESTINEES AU GRAPHIQUE
 * **********************************************************************/
function donateursChartFormatData(dons){
    /* ---- Initialize les variables ---- */
    let chart_data_object = [];
    let chart_data_array = [];

    /* ---- Filtre les donateurs ---- */
    const donateurs = dons.map(item => item.donateur);

    /* ---- Unicite les element du tableau donateurs ---- */
    donateurs.filter((value,index,self) => self.indexOf(value) == index);

    /* ---- Fonction calculant le montant total en rapport avec un donateur ---- */
    const getTotalMontant = function(dons){
        return dons.reduce((accumulator, current) => accumulator + convertDonateurAmount(current.montant, current.currency), 0);
    }

    /* ---- Parcourt de l'ensemble de donateurs ---- */
    donateurs.forEach((item) => { 
        chart_data_object.push({
            donateur: '<a href="/donateur/details/'+item.id+'" style="text-decoration: none;color: blue;opacity: 0.6;font-size: 19px;font-weight: bold;font-family: italic;" class="btn btn-default btn-sm" title="Details sur le donateur">'+item.nom+' '+item.prenom+'</a>',
            montant:  item.dons ? getTotalMontant(item.dons) : 0
        }); 
    });

    /* ---- Delimite la taille de donnee ---- */
    chart_data_object.length = 10;

    /* ---- Filtre les donnnees ---- */ 
    const filter_data = chart_data_object.filter((item)=>{
        return item.montant > 0;
    });

    /* ---- Range les donnees filtrees ---- */
    const sort_data = filter_data.sort((a,b) => b.montant - a.montant);

    /* ---- Remplissage de donnee a renvoyer(Graphiques) ---- */
    sort_data.forEach((item) => {
        chart_data_array.push([
            item.donateur,
            item.montant       
        ]); 
    });

    /* ---- Renvoie le tableau contenant le format finale  ---- */
    return chart_data_array;
}


/* ***********************************************************************
 * ILLUSTRATION GRAPHIQUE (DONATEURS CHART GRAPH)
 * **********************************************************************/
function buildDonateursChartGraph(dons){
    /* ---- Initialize le texte ---- */
    const initialText = 'Illustration graphique des grands donateurs';

    /* ---- Build the chart ---- */
    Highcharts.chart('donateurs_chart_graph', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: window.chartGraph ? (window.chartGraph.dataType ? (window.chartGraph.dataType.toLowerCase()=='donation' ? initialText+'<br> de l\'an <i style="color: cadetblue;">'+window.chartGraph.annee+'</i>' : initialText) : initialText) : initialText 
        },
        subtitle: {
            text: 'Source: <a href="/donateur/list" target="_blank">H.M</a>'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            type: 'category',
            labels: {
                skew3d: true,
                style: {
                    fontSize: '16px'
                }
            }
        },
        yAxis: {
            title: {
                //text: 'Montant (Dollard US)',
                margin: 20
            }
        },
        tooltip: {
            valueSuffix: ' '+getDonateurCurrencyIcon(getDonateurDisplayCurrency())
        },
        series: [{
            name: 'Total pourcentage',
            data: donateursChartFormatData(dons)
        }] 
    });
}
