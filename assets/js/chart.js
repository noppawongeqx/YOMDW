function getDate( d ) {
   if(d){
     d = d.split(' ');
    var t = d[1];
    d = d[0];
    d = d.split('-');
    if( t == undefined )  t = [0,0,0,0];
    else          t = t.split(':');
    while( t.length < 4 )  t.push(0);
    var d = new Date( Date.UTC( d[0] , d[1]-1 , d[2] , t[0] , t[1] , t[2] , t[3] ) );
    return d.getTime();
 
   }else{
    return null;
   }
};
var volchart  = function (data)
{

console.log($.browser.version);
 var list = data['data'];
 var maxiv = parseFloat(data['maxiv']);
 var miniv = parseFloat(data['miniv']);
 var std = parseFloat(data['std']);
 var avg  = parseFloat(data['avg']);
 var result = [];
var max  =parseFloat(Math.round(((maxiv*100) + (avg*100*0.5) )/ 10) * 10);

var min = parseFloat(Math.round(((miniv*100) - (avg*100*0.5) )/ 10) * 10);
console.log(max);
 for(var key in list)
 {
  result.push([getDate(list[key].x),list[key].y]);
  
  }
  var chart = new EJSC.Chart(
  "lineChart",
  {show_legend: false,show_titlebar: false}
  );
  var myChartSeries = new EJSC.LineSeries(
    new EJSC.ArrayDataHandler(
        result
      )
    );
  myChartSeries.lineWidth = 2;
  chart.addSeries(myChartSeries);
  var myChart1 = new EJSC.Chart( 'lineChart' , {
        title: "Implied Volatility" ,
         axis_bottom: new EJSC.DateAxis( {
          caption: 'Date' ,
          major_ticks: { increment: '1M' } ,
          formatter: new EJSC.DateFormatter( {
            format_string: "YYYY MMM"
          } )
        } ) ,
        axis_left: {
          caption: 'Percent' ,
          size: 60,
          formatter: new EJSC.NumberFormatter( {
            forced_decimals: 2
          } )  },
        auto_zoom: 'y' ,
        auto_find_point_by_x: true
    } );
  myChart1.axis_left.setExtremes( min, max);
    myChart1.addSeries(myChartSeries);
};
