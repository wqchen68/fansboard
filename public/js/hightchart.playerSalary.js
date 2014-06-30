$(function () {
    
    
    $.getJSON('sort/getRealtime',function(data_bag){
    
        
        var chart = new Highcharts.Chart({
        chart: {
            renderTo: $('#chart_playerSalary').get(0),
            type: 'column'
        },
        title: {
            text: 'Drilldown label styling'
        },
        xAxis: {
            type: ''
        },

        legend: {
            enabled: false
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            }
        },

        series: [{
            name: 'Things',
            colorByPoint: false,
            data: [
                {name: 'LAC',y:103339235,drilldown:'lac'},
                {name: 'BRO',y:103109456,drilldown:'bro'},
                {name: 'NYK',y:93917621 ,drilldown:'nyk'},
                {name: 'MIA',y:79402201 ,drilldown:'mia'},
                {name: 'OKC',y:78634534 ,drilldown:'okc'},
                {name: 'LAL',y:76601997 ,drilldown:'lal'},
                {name: 'IND',y:70963676 ,drilldown:'ind'},
                {name: 'GSW',y:70549908 ,drilldown:'gsw'},
                {name: 'MEM',y:70119616 ,drilldown:'mem'},
                {name: 'CHI',y:70057494 ,drilldown:'chi'},
                {name: 'BOS',y:70047470 ,drilldown:'bos'},
                {name: 'DAL',y:67724658 ,drilldown:'dal'},
                {name: 'MIN',y:67532310 ,drilldown:'min'},
                {name: 'DEN',y:65706825 ,drilldown:'den'},
                {name: 'WAS',y:64287203 ,drilldown:'was'},
                {name: 'NOR',y:63664716 ,drilldown:'nor'},
                {name: 'SAS',y:62816535 ,drilldown:'sas'},
                {name: 'TOR',y:62178363 ,drilldown:'tor'},
                {name: 'POR',y:61260350 ,drilldown:'por'},
                {name: 'SAC',y:60517196 ,drilldown:'sac'},
                {name: 'DET',y:59397253 ,drilldown:'det'},
                {name: 'HOU',y:57275965 ,drilldown:'hou'},
                {name: 'ATL',y:55613844 ,drilldown:'atl'},
                {name: 'CLE',y:51775584 ,drilldown:'cle'},
                {name: 'MIL',y:51189658 ,drilldown:'mil'},
                {name: 'CHA',y:48614618 ,drilldown:'cha'},
                {name: 'UTH',y:47629601 ,drilldown:'uth'},
                {name: 'PHO',y:47563432 ,drilldown:'pho'},
                {name: 'ORL',y:34459374 ,drilldown:'orl'},
                {name: 'PHI',y:26358700 ,drilldown:'phi'}
            ]
        }],
        drilldown: {
            activeAxisLabelStyle: {
                textDecoration: 'none',
                fontStyle: 'italic'
            },
            activeDataLabelStyle: {
                textDecoration: 'none',
                fontStyle: 'italic'
            },
            series: [{
                id: 'animals',
                data: [
                    ['Cats', 4],
                    ['Dogs', 2],
                    ['Cows', 1],
                    ['Sheep', 2],
                    ['Pigs', 1]
                ]
            }, {
                id: 'fruits',
                data: [
                    ['Apples', 4],
                    ['Oranges', 2]
                ]
            }, {
                id: 'cars',
                data: [
                    ['TOYOTA', 4],
                    ['BENZ', 4],
                    ['BMW', 4],
                    ['HONDA', 2]
                ]
            }]
        }
    })
        
        
    });
    
    

});

