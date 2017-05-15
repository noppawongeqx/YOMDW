 var redirectTo = function(dw){
  window.location.replace('/dw24/dwdetail/'+dw);
}                     
var checkFilter = function(){
  jQuery('#search').keyup(function(e){
    $element = $(e.target);
    var value = $element.val().toUpperCase();  
      jQuery('.info-box').each(function(){
    
            console.log("value"+value);
    if(value == ""){
           $(this).show(); 
        }else if($(this).find('.info-box-dw').html().indexOf(value.toUpperCase()) != 0
            && $(this).find('.info-box-ul').html().indexOf(value.toUpperCase()) != 0){
            $(this).hide();
        }
      
    });
  });
}


$(document).ready(function(){
  var screenRes = window.screen.availWidth;
  if(screenRes < 1200)
  {
    jQuery('.container').css('width','100%');
  }else if(screenRes > 1300)jQuery('.container').css('width','1300px');

   checkFilter();
 jQuery.get('/dw24/ajax/moneyflowin', function(data, status){
   moneyflow(data,'in');
    console.log(data.uptime);
    jQuery('#mftime').html(data['uptime']);
 });
 jQuery.get('/dw24/ajax/topoutstanding', function(data, status){
  outstanding(data);
    console.log(data.uptime);
    jQuery('#ostime').html(data['uptime']);

});

 jQuery('select[name="ul"]').change(function(){
  if($(this).val()){
    $('#searchdwform').submit();      
  }
});
 jQuery('select[name="searchdw"]').change(function(){
  console.log('change');
  if($(this).val()){
    window.location.replace("/dw24/dwdetail/"+$(this).val());   
  }
});

//  $('#nickname').keyup(function() {
//   var nickname = $(this).val();

//   if(nickname == ''){
//     $('#msg_block').hide();
//   }else{
//     $('#msg_block').show();
//   }
// });


      // initial nickname check
      // $('#nickname').trigger('keyup');
      // $('#submit').click(function (e) {
      //   e.preventDefault();

      //   var $field = $('#message');
      //   var data = $field.val();

      //   $field.addClass('disabled').attr('disabled', 'disabled');
      //   sendChat(data, function (){
      //     $field.val('').removeClass('disabled').removeAttr('disabled');
      //   });
      // });

      // $('#message').keyup(function (e) {
      //   if (e.which == 13) {
      //     $('#submit').trigger('click');
      //   }
      // });

      // setInterval(function (){
      //   update_chats();
      // }, 1500);

    });
var request_timestamp = 0;

var setCookie = function(key, value) {
  var expires = new Date();
  expires.setTime(expires.getTime() + (5 * 60 * 1000));
  document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

var getCookie = function(key) {
  var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
  return keyValue ? keyValue[2] : null;
}

var guid = function() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}

if(getCookie('user_guid') == null || typeof(getCookie('user_guid')) == 'undefined'){
  var user_guid = guid();
  setCookie('user_guid', user_guid);
}


// https://gist.github.com/kmaida/6045266
// var parseTimestamp = function(timestamp) {
//   var d = new Date( timestamp * 1000 ), // milliseconds
//   yyyy = d.getFullYear(),
//     mm = ('0' + (d.getMonth() + 1)).slice(-2),  // Months are zero based. Add leading 0.
//     dd = ('0' + d.getDate()).slice(-2),     // Add leading 0.
//     hh = d.getHours(),
//     h = hh,
//     min = ('0' + d.getMinutes()).slice(-2),   // Add leading 0.
//     ampm = 'AM',
//     timeString;

//     if (hh > 12) {
//       h = hh - 12;
//       ampm = 'PM';
//     } else if (hh === 12) {
//       h = 12;
//       ampm = 'PM';
//     } else if (hh == 0) {
//       h = 12;
//     }

//     timeString = yyyy + '-' + mm + '-' + dd + ', ' + h + ':' + min + ' ' + ampm;
    
//     return timeString;
//   }
//   var sendChat = function (message, callback) {
//     $.getJSON('/dw24/dw24back/api/send_message?message=' + message + '&nickname=' + $('#nickname').val() + '&guid=' + getCookie('user_guid'), function (data){
//       callback();
//     });
//   }

  // var append_chat_data = function (chat_data) {
  //   chat_data.forEach(function (data) {
  //     var is_me = data.guid == getCookie('user_guid');

  //     if(is_me){
  //       var html = '<li class="right clearfix">';
  //       html += ' <span class="chat-img pull-right">';
  //       html += '   <img src="http://placehold.it/50/FA6F57/fff&text=' + data.nickname.slice(0,2) + '" alt="User Avatar" class="img-circle" />';
  //       html += ' </span>';
  //       html += ' <div class="chat-body clearfix">';
  //       html += '   <div class="header">';
  //       html += '     <small class="text-muted"><span class="glyphicon glyphicon-time"></span>' + parseTimestamp(data.timestamp) + '</small>';
  //       html += '     <strong class="pull-right primary-font">' + data.nickname + '</strong>';
  //       html += '   </div>';
  //       html += '   <p>' + data.message + '</p>';
  //       html += ' </div>';
  //       html += '</li>';
  //     }else{

  //       var html = '<li class="left clearfix">';
  //       html += ' <span class="chat-img pull-left">';
  //       html += '   <img src="http://placehold.it/50/55C1E7/fff&text=' + data.nickname.slice(0,2) + '" alt="User Avatar" class="img-circle" />';
  //       html += ' </span>';
  //       html += ' <div class="chat-body clearfix">';
  //       html += '   <div class="header">';
  //       html += '     <strong class="primary-font">' + data.nickname + '</strong>';
  //       html += '     <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>' + parseTimestamp(data.timestamp) + '</small>';

  //       html += '   </div>';
  //       html += '   <p>' + data.message + '</p>';
  //       html += ' </div>';
  //       html += '</li>';
  //     }
  //     $("#received").html( $("#received").html() + html);
  //   });

  //   $('#received').animate({ scrollTop: $('#received').height()}, 1000);
  // }

  // var update_chats = function () {
  //   if(typeof(request_timestamp) == 'undefined' || request_timestamp == 0){
  //   var offset = 60*15; // 15min
  //   request_timestamp = parseInt( Date.now() / 1000 - offset );
  // }
  // $.getJSON('/dw24/dw24back/api/get_messages?timestamp=' + request_timestamp, function (data){
  //   append_chat_data(data); 

  //   var newIndex = data.length-1;
  //   if(typeof(data[newIndex]) != 'undefined'){
  //     request_timestamp = data[newIndex].timestamp;
  //   }
  // });      
// }
function drawFlowIn()
{
  jQuery.get('/dw24/ajax/moneyflowin', function(data, status){
    moneyflow(data,'in');
    console.log(data.uptime);
    jQuery('.flowin').addClass('selected');
    jQuery('.flowout').removeClass('selected');
    jQuery('#mftime').html(data['uptime']);
  });
}
function drawFlowOut()
{
  jQuery.get('/dw24/ajax/moneyflowout', function(data, status){
    moneyflow(data,'out');
    console.log(data.uptime);
    jQuery('.flowout').addClass('selected');
    jQuery('.flowin').removeClass('selected');
    jQuery('#mftime').html(data['uptime']);
  });
}
function moneyflow(data,flag){
// {
//  var chart = new EJSC.Chart("moneyflow", {
//   title:'',
//   show_legend: false,
//   allow_zoom:false,
//   allow_mouse_wheel_zoom: false,

//   // axis_left:{
//   //  caption_class:  "AxisCaption",
//   //  caption:"value(THB)", 
//   //  grid: { show: false }},

//    axis_bottom:{caption:"", caption_class: "AxisCaption",grid: { show: false },
//                label_class: "AxisTickLabels",major_ticks : {
//                thickness: 1,
//                size: 5,
// } },
//  } );
//  var mySeries = new EJSC.BarSeries(
//   new EJSC.ArrayDataHandler(data['data']) , {
//     orientation: "vertical",
//     intervalOffset: .5,
//     useColorArray: true,
//     defaultColors:['rgb(76,162,202)','rgb(36,179,199)'],
//     opacity: 100
//   }
//   )

//  mySeries.x_axis_formatter = new EJSC.NumberFormatter({
//   forced_decimals: 2
// } );

//  mySeries.y_axis_formatter = new EJSC.NumberFormatter({
//   forced_decimals: 2
// } );
var maxofGraph = 0;
var minofGraph = 0;
 minofGraph = data['min'].toFixed(1);
if(data['max'] > 1){
  console.log('else1');
  maxofGraph = (data['max']+(0.047*data['max'])).toFixed(2);
 
}else if(data['max'] < 0.4){
  console.log('else2');
  maxofGraph = (data['max']+0.02).toFixed(2)
  minofGraph = data['min'].toFixed(1);
}else if(data['max'] - data['min'] > 0.3){
  console.log('else3');
 maxofGraph = (data['max']+(0.07*data['max'])).toFixed(2)
} else{
  console.log('else');
 maxofGraph = (data['max']).toFixed(2)
}
var sign = (flag == 'in')?"+":"-";
var color = (flag == 'in')?"#009A00":"#ff0000";
var chart = AmCharts.makeChart( "moneyflowgraph", {
    "type": "serial",
    "theme": "light",
     
  "addClassNames": true,
    "dataProvider": data['data'],
    "gridAboveGraphs": true,
    "startDuration": 1,
    "fontFamily":"supermarketRegular",
    "graphs": [ {
     "balloonFunction": function(item, graph) {
      var result = graph.balloonText;
      for (var key in item.dataContext) {
        if (item.dataContext.hasOwnProperty(key) && !isNaN(item.dataContext[key])) {
          var formatted = AmCharts.formatNumber(item.dataContext[key], {
            precision: chart.precision,
            decimalSeparator: chart.decimalSeparator,
            thousandsSeparator: chart.thousandsSeparator
          }, 1);
          result = result.replace("[[" + key + "]]", formatted);
        }
      }
      return result;
    },
      "fillAlphas": 0.8,
      "lineAlpha": 0.2,
       "labelText": " ",
       "numberFormatter":{
          precision:-1,decimalSeparator:",",thousandsSeparator:""
        },
       "color":color,
       "showBalloon" :false,
      "labelPosition": "top",
      "labelFunction": function( item ) {
        /**
         * Calculate total of values across all
         * columns in the graph 
         */
        return  sign+item.values.value.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + "M";
      },
      "type": "column",
      "fontSize": 15,
      "valueField": "value",
     "fixedColumnWidth" : 50,
    "fillColors":'#ff7100'
    } ],
    "chartCursor": {
      "categoryBalloonEnabled": false,
      "cursorAlpha": 0,
      "zoomable": false 
    },
    "categoryField": "dw",
    "categoryAxis": {
      "gridPosition": "start",
      "gridAlpha": 0,
      "tickPosition": "start",
      "tickLength": 0,
      "fontSize" :15,
      "axisColor":"#888888",
      "color":"#888888",
      "listeners": [{
         "event": "clickItem",
        "method": function(event) {
          window.location.href = '/dw24/dwdetail/'+event.serialDataItem.dataContext.dw;
        }
      }],
    },
   "valueAxes": [ 
      {
        "fontSize": 15,
         "tickLength": 0,
       "labelsEnabled": false,
       "maximum":maxofGraph,
       "minimum":minofGraph,
       "gridAlpha" : 0,
       "axisAlpha" : 0,
        "valueBalloonEnabled": false,
       "ignoreAxisWidth":true,
      "axisColor":"#888888",
      }
    ],

  } );
}
function outstanding(data)
{
  var chart = AmCharts.makeChart( "outstandinggraph", {
    "type": "serial",
    "theme": "light",
    "rotate":true,
   
  "addClassNames": true,
    "dataProvider": data['data'],
    "gridAboveGraphs": true,
    "startDuration": 1,
    "fontFamily":"supermarketRegular",
    "graphs": [ {     
      "fillAlphas": 0.8,
      "lineAlpha": 0.2,
       "labelText": " ",
       "showBalloon" :false,
       "color":'#009A00',
      "labelPosition": "right",
      "labelFunction": function( item ) {
        var more ='';
        if(data['more']){
            more = data['more'][item.category];
        }
       
        if(more){
          return more.toFixed(1)+'M'
        }else{
          return  item.values.value.toFixed(1)+'M';
        }
      },
      "type": "column",
      "fontSize": 15,
      "valueField": "value",
     "fixedColumnWidth" : 30,
    "fillColors":'#009A00'
    } ],
    "chartCursor": {
      "categoryBalloonEnabled": false,
      "cursorAlpha": 0,
      "zoomable": false 
    },
    "categoryField": "dw",
    "categoryAxis": {
      "gridAlpha": 0,
      "tickLength": 0,
      "fontSize" :15,
      "axisColor":"#888888",
      "color":"#888888",
      "listeners": [{
         "event": "clickItem",
        "method": function(event) {
          window.location.href = '/dw24/dwdetail/'+event.serialDataItem.dataContext.dw;
        }
      }],
    },
   "valueAxes": [ 
      {
        "fontSize": 15,
         "tickLength": 0,
       "labelsEnabled": false,
       "maximum":20.0,
       "minimum":0.0,
       "gridAlpha" : 0,
       "axisAlpha" : 0,
        "valueBalloonEnabled": false,
        "strictMinMax":true,
       "ignoreAxisWidth":true,
      "axisColor":"#888888",
      }
    ],

  } );


  // var chart = new EJSC.Chart("outstanding", {
  //   title:'',
  //   show_legend: false,
  //   allow_zoom:false,
  //   allow_mouse_wheel_zoom: false,
  //   axis_left:{
  //    caption_class:  "AxisCaption",
  //    caption:"", 
  //    grid: { show: false }},

  //    axis_bottom:{caption:"volume", caption_class: "AxisCaption",grid: { show: false } },
  //  }
  //  );

  // var mySeries = new EJSC.BarSeries(new EJSC.ArrayDataHandler(data['data']) , {
  //   orientation: "horizontal",
  //   intervalOffset: .5,
  //   useColorArray: true,
  //   opacity: 100,
  //   lineWidth:2,
  //   defaultColors:['rgb(98,171,49)'],
  //   autosort:false
  // }
  // );

  // mySeries.x_axis_formatter = new EJSC.NumberFormatter({
  //   forced_decimals: 2
  // } );

  // mySeries.y_axis_formatter = new EJSC.NumberFormatter({
  //   forced_decimals: 2
  // } );
  
  // chart.addSeries(mySeries);

}

