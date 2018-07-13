$(document).ready(function(){
// Morris Bar
if ($('#bar-chart').length) {
    Morris.Bar({
        barGap: 3,
        barSizeRatio: 0.2,
        element: 'bar-chart',
        barColors: ['#ff5b5b', '#20bd83', '#6956ec'],
        data: [{
            x: '05/2017',
            y: 110,
            z: 100,
            a: 80
        },
               {
                   x: '06/2017',
                   y: 75,
                   z: 25,
                   a: 50
               },
               {
                   x: '07/2017',
                   y: 140,
                   z: 150,
                   a: 120
               }
              ],
        xkey: 'x',
        ykeys: ['y', 'z', 'a'],
        labels: ['Y', 'Z', 'A']
    }).on('click', function(i, row) {
        console.log(i, row);
    });
}

/* Morris Area */
if ($('#area-chart').length) {
    Morris.Area({
        element: 'area-chart',
        data: [{
            period: '2010',
            Electronics: 0,
            Fashion: 0,
            Furnitures: 0
        }, {
            period: '2011',
            Electronics: 220,
            Fashion: 120,
            Furnitures: 30
        }, {
            period: '2012',
            Electronics: 130,
            Fashion: 100,
            Furnitures: 80
        }, {
            period: '2013',
            Electronics: 80,
            Fashion: 60,
            Furnitures: 70
        }, {
            period: '2014',
            Electronics: 70,
            Fashion: 180,
            Furnitures: 140
        }, {
            period: '2015',
            Electronics: 160,
            Fashion: 130,
            Furnitures: 100
        }, {
            period: '2016',
            Electronics: 105,
            Fashion: 100,
            Furnitures: 90
        },
               {
                   period: '2017',
                   Electronics: 300,
                   Fashion: 150,
                   Furnitures: 100
               }
              ],
        xkey: 'period',
        ykeys: ['Electronics', 'Fashion', 'Furnitures'],
        labels: ['Electronics', 'Fashion', 'Furnitures'],
        pointSize: 0,
        fillOpacity: 0.6,
        pointStrokeColors: ['#6956ec', '#ffbc34 ', '#2ac774'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 0,
        hideHover: 'auto',
        lineColors: ['#6956ec', '#ffbc34 ', '#2ac774'],
        resize: true

    });
}

/* Morris Area */
if ($('#area-chart2').length) {
    Morris.Area({
        element: 'area-chart2',
        data: [{
            period: '01',
            Electronics: 0,
        }, {
            period: '02',
            Electronics: 450,
        }, {
            period: '03',
            Electronics: 550,
        }, {
            period: '04',
            Electronics: 450,
        }, {
            period: '05',
            Electronics: 150,
        }, {
            period: '06',
            Electronics: 250,
        }, {
            period: '07',
            Electronics: 350,
        }, {
            period: '08',
            Electronics: 250,
        }, {
            period: '09',
            Electronics: 130,
        }, {
            period: '10',
            Electronics: 80,
        }, {
            period: '11',
            Electronics: 70,
        }, {
            period: '12',
            Electronics: 160,
        }, {
            period: '13',
            Electronics: 105,
        },
               {
                   period: '14',
                   Electronics: 300,
               }
              ],
        xkey: 'period',
        ykeys: ['Electronics'],
        labels: ['Electronics'],
        pointSize: 0,
        fillOpacity: 0.6,
        pointStrokeColors: ['#6956ec'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 0,
        hideHover: 'auto',
        lineColors: ['#6956ec'],
        resize: true

    });
}

/* Morris Donut Chart */
if ($('#donut-chart').length) {
    Morris.Donut({
        element: 'donut-chart', //js calls inside this id
        colors: ["#ff5b5b", "#20bd83", "#6956ec"], //set colors for each bar
        resize: true,
        data: [{
            label: "ELECTRONICS",
            value: 43
        },
               {
                   label: "FASHION",
                   value: 20
               },
               {
                   label: "FURNITURES",
                   value: 37
               },
              ]
    });
}

/* Morris Line */
if ($('#line-chart').length) {
    Morris.Line({
        element: 'line-chart',
        lineColors: ['#f5b439'],
        data: [{
            y: '2011',
            a: 100
        },
               {
                   y: '2012',
                   a: 75
               },
               {
                   y: '2013',
                   a: 50
               },
               {
                   y: '2014',
                   a: 75
               },
               {
                   y: '2015',
                   a: 50
               },
               {
                   y: '2016',
                   a: 75
               },
               {
                   y: '2017',
                   a: 100
               }
              ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Traffic State']
    });
}

/* Morris Line */
if ($('#line-chart2').length) {
    Morris.Line({
        element: 'line-chart2',
        lineColors: ['#f5b439','#ff5b5b'],
        data: [
            { y: '2011', a: 100, b: 90 },
            { y: '2012', a: 75,  b: 65 },
            { y: '2013', a: 50,  b: 40 },
            { y: '2014', a: 75,  b: 65 },
            { y: '2015', a: 50,  b: 40 },
            { y: '2016', a: 75,  b: 65 },
            { y: '2017', a: 100, b: 90 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B']
    });
}

});
