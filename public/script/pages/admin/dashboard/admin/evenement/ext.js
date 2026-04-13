export class EventModelsChartGraph {
    // Format les donnees a illustrer(Chart) 
    eventsModelChartFormatData(data){
        //Initialize la variable data_chart_obj
        var data_chart_obj=[];
        //Models evenements
        var models=data.map((item)=>item.model);
        //Rend unique les valeurs de tableau models
        models=models.filter((value,index,self)=>{
            return self.indexOf(value)==index;
        });
        //Parcour l'ensemble de models
        models.forEach(model => {
            const events=data.filter((item)=>{
                return item.model.toLowerCase()==model.toLowerCase();
            });
            data_chart_obj.push({
                name: model,
                y: events.length
            });
        });
        //Renvoie les donnees du graphique
        return data_chart_obj; 
    }


    static buildEventModelsGraph(data){
        // Data retrieved from https://netmarketshare.com/
        // Make monochrome colors   
        const colors = Highcharts.getOptions().colors.map((c, i) =>
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            Highcharts.color(Highcharts.getOptions().colors[0])
                .brighten((i - 3) / 6)
               .get()
            );
 
            // Build the chart
            Highcharts.chart('events_modele_graph', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Illustration graphique modeles evenements organises'
                },
                subtitle: {
                    text: 'Source: <a href="/evenement/list" target="_blank">H.M</a>'
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
                        allowPointSelect: false,
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
                data: this.eventsModelChartFormatData(data)
            }]
        });
    }
}

