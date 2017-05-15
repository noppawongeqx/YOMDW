            var chart;
            var chartData = [];
            var chartCursor;
            var max;
            var min;
      
            var drawChart = function () {
                // generate some data first
               // generateChartData();
               console.log('drawChart');
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();

                chart.dataProvider = chartData;
                chart.categoryField = "date";
                chart.balloon.bulletSize = 10;
                chart.fontSize = 14;
                chart.theme= "light";

                // listen for "dataUpdated" event (fired when chart is rendered) and call zoomChart method when it happens
                //chart.addListener("dataUpdated", zoomChart);

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                categoryAxis.dashLength = 1;
                categoryAxis.twoLineMode = true; 
                categoryAxis.dateFormats = [{
                    period: 'fff',
                    format: 'JJ:NN:SS'
                }, {
                    period: 'ss',
                    format: 'JJ:NN:SS'
                }, {
                    period: 'mm',
                    format: 'JJ:NN'
                }, {
                    period: 'hh',
                    format: 'JJ:NN'
                }, {
                    period: 'DD',
                    format: 'DD'
                }, {
                    period: 'WW',
                    format: 'DD'
                }, {
                    period: 'MM',
                    format: 'MMM'
                }, {
                    period: 'YYYY',
                    format: 'YYYY'
                }];

             //   categoryAxis.axisColor = "#DADADA";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.autoGridCount = false;
                valueAxis.axisAlpha = 0;
                valueAxis.dashLength = 1;
                valueAxis.minMaxMultiplier = 2;
            
               valueAxis.maximum = max;
                valueAxis.minimum = min;
                valueAxis.gridCount = 5;
                valueAxis.labelfrequency = 5; 
               // valueAxis.autoGridCount = false;
               // valueAxis.gridCount = 10;
                valueAxis.unit = "%";
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.title = "red line";
                graph.valueField = "value"; 
                graph.bullet = "round";
                graph.bulletBorderColor = "#FFFFFF";
                graph.bulletBorderThickness = 2;
                graph.bulletBorderAlpha = 1;
                graph.balloonText = "[[custom]]";
                graph.lineThickness = 1;
                graph.type= "smoothedLine",
                graph.lineColor = "#5fb503";
                graph.negativeLineColor = "#000000";
                graph.hideBulletsCount = 1; // this makes the chart to hide bullets when there are more than 50 series in selection
                chart.addGraph(graph);

                // CURSOR
                chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorPosition = "mouse";
                chartCursor.cursorAlpha = 0.5;
                chartCursor.cursorColor = '#4da2cb';
                chartCursor.pan = true; // set it to fals if you want the cursor to work in "select" mode
                chart.addChartCursor(chartCursor);

                // SCROLLBAR
                var chartScrollbar = new AmCharts.ChartScrollbar();
                chart.addChartScrollbar(chartScrollbar);

                chart.creditsPosition = "bottom-right";

                // WRITE
                chart.write("lineChart");
                jQuery('.amcharts-chart-div a').hide();
            };

            // generate some random data, quite different range
            function volchart(data) {
                // var firstDate = new Date();
                // firstDate.setDate(firstDate.getDate() - 500);

                // for (var i = 0; i < 500; i++) {
                //     // we create date objects here. In your data, you can have date strings
                //     // and then set format of your dates using chart.dataDateFormat property,
                //     // however when possible, use date objects, as this will speed up chart rendering.
                //     var newDate = new Date(firstDate);
                //     newDate.setDate(newDate.getDate() + i);

                //     var visits = Math.round(Math.random() * 40) - 20;

                //     chartData.push({
                //         date: newDate,
                //         visits: visits
                //     });
                // }
                     
                 // jQuery.get("/node/EmapiConnector-proxy/impliedVol/"+dwname, function(res, status){
                 //    //console.log(data);
                 //     if(res && !jQuery.isEmptyObject(res)){
                 //        var data = res.result
                 //        chartData = [];
                var maxiv = parseFloat(data['maxiv']);
                 var miniv = parseFloat(data['miniv']);
                 var std = parseFloat(data['std']);
                 var avg  = parseFloat(data['avg']);
                 var result = [];
                 max  =parseFloat(Math.round(((maxiv*100) + (avg*100*0.5) )/ 10) * 10);
                 min = parseFloat(Math.round(((miniv*100) - (avg*100*0.5) )/ 10) * 10);
                 console.log(maxiv);

                 console.log(max);
                $('#lineChart').empty();
                 var list = data['data'];
                for(var i = 0; i< list.length; i++){        
                    chartData.push({
                        date: getDate( list[i].x),
                        value: list[i].y ,
                        custom: "implied volatillity:(%)"+(list[i].y)
                    });        

                }
                drawChart();

                 //  });
            }

            // this method is called when chart is first inited as we listen for "dataUpdated" event
            function zoomChart() {
                // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
                chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
            }

            // changes cursor mode from pan to select
            function setPanSelect() {
                if (document.getElementById("rb1").checked) {
                    chartCursor.pan = false;
                    chartCursor.zoomable = true;
                } else {
                    chartCursor.pan = true;
                }
                chart.validateNow();
            }
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