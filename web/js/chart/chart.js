var chart1; // globally available
    var categories = ['0-9', '10-19', '20-29', '30-39',
                    '40-49', '50-59', '60-69', '70-79', 
                    '80-89', '90-99', '100 +'];

    function afficherPyramide(elem, dataHomme, dataFemme, population){

        xMin=0;
        for (i=0; i < dataHomme.length; i++) {
            if (dataHomme[i] > xMin){
                xMin = dataHomme[i];
            }
        }
        /*xMin = -Math.round(xMin + 100);*/
        xMin = -Math.round(xMin);
        xMax = -Math.round(xMin);

        dataH = new Array();
        dataF = new Array();
        for (i=0; i < dataHomme.length; i++) {
            dataH[i]=-dataHomme[i];
        }
        
        for (i=0; i < dataFemme.length; i++) {
            dataF[i]=+dataFemme[i];
        }

        chart1 = new Highcharts.Chart({
            chart: {
                renderTo: elem,
                type: 'bar'
            },

            title: {
                text: 'Pyramide des âges'
            },

            subtitle: {
                text: 'Population totale : ' + population + ' habitants'
            },

            xAxis: [
                { 
                    categories: categories,
                    reversed: false
                }, 
                { // mirror axis on right side
                    opposite: true,
                    reversed: false,
                    categories: categories,
                    linkedTo: 0
                }
            ],

            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function(){
                        //return (Math.abs(this.value) / 1000) + 'K';
                        return (Math.abs(this.value));
                    }
                },
                min: xMin,
                max: xMax
            },

            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },

            tooltip: {
                formatter: function(){
                    return '<b>'+ this.series.name +', âge '+ this.point.category +'</b><br/>'+
                        //'Population: '+ Highcharts.numberFormat(Math.abs(this.point.y), 0);
                    'Population: '+ Math.abs(this.point.y);
                }
            },

            series: [
                {
                    name: 'Homme',
                    data: [dataH[0],dataH[1],dataH[2],dataH[3],
                           dataH[4],dataH[5],dataH[6],dataH[7],
                           dataH[8],dataH[9],dataH[10]]
                }, 
                {
                    name: 'Femmes',
                    data: [dataF[0],dataF[1],dataF[2],dataF[3],
                           dataF[4],dataF[5],dataF[6],dataF[7],
                           dataF[8],dataF[9],dataF[10]]
                }
            ]
        });

    }