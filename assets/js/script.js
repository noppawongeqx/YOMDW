var intervalList;
var intervalDialog;
var shiftDate = 0;
var shiftPrice = 0;
var currentSelection = '';

var templateItem =[
            ,'<div class="small-box  tile-wide" style="cursor:pointer"  onclick="showDialog(\'#content\',\'#dw\')" style="cursor:pointer"> '
             , '<div class="inner tile-content" style="background-color:transparent" >'
               , '<h3><span style="color:#00965e">#predw</span><span style="color:#e57f1d">#postdw</span></h3>'
               , '<div class="tile-label-top-dw" style="display:none">'
               ,  '#dw'
              ,'</div>'
               , '<div class="tile-label-top-3" style="display:none">'
              ,  '#ul'
              ,'</div>'
             , '<table  class="stock_info3">'
             
            ,  '<tbody>'
              ,  '<tr>'
                 , '<td >GEARING</td>'
                 , '<td  style="text-align:right">#gearing</td>'
                ,  '<td  >SENSITIVITY</td>'
                ,  '<td style="text-align:right">#sensitivity</td>'
              ,  '</tr>'
               , '<tr>'
                  ,'<td  >TIMEDECAY</td>'
                 , '<td style="text-align:right">#timedecay</td>'
                 , '<td >IMP.VOL</td>'
                 , '<td style="text-align:right">#implyVol</td>'
               , '</tr>'
               , '<tr >'
                  ,'<td colspan="2" style="color:#e57f1d;font-weight:bold" >Last Trading Date</td>'
                 , '<td colspan="2" style="color:#e57f1d;font-weight:bold" >#expdate</td>'
               , '</tr>'
               , '<tr><td colspan="4"  style="text-align:center;color:#00965e" >Click To View PriceTable </td></tr>'
             , '</tbody>'
             , '</table>'
             , '</div>'
           , '</div>'];

 var templateItem2 = [
          '<div class="tile-wide   #odd-even fg-white" data-role="tile"   onclick="showDialog(\'#content\',\'#dw\')" >',
            '<div class="tile-content iconic">',
              '<span class="tile-label-top" style="font-size:1.75em;font-family: \'Roboto\', sans-serif;text-align:center" class="tile-dw-name">',
                '<span>#predw</span><span style="color:#60a917;">#postdw</span>',
              '</span>',
              '<div class="tile-label-top-dw" style="display:none">',
                '#dw', 
              '</div>',
              "<div class=\"grid  rowtop\">",
                "<div class=\"row cells4\">",
              '<div class="tile-label-top-3" style="display:none">',
                '#ul', 
              '</div>',
              
              '<div class="cell" style="color:#60a917">',
                'GEARING', 
              '</div>',
               '<div class="cell" style="color:#60a917;" >',
                '#gearing', 
              '</div>',
              '<div class="cell" style="color:#60a917">',
                'TIMEDECAY', 
              '</div>',
              '<div class="cell" style="color:#60a917">',
                '#timedecay', 
              '</div>',
              '</div>',
              '</div>',
              "<br style=\"clear:both\">",
               "<div class=\"grid  rowunder\">",
                "<div class=\"row cells4\">",
                '<div class="tile-label-lower-lower" style="display:none">',
                '#ul', 
              '</div>',
               '<div class="cell" style="color:#60a917">',
                'SENSITIVITY',
              '</div>',
              '<div class="cell" style="color:#60a917">',
                '#sensitivity',
              '</div>',
               '<div class="cell" style="color:#60a917">',
                'IMP.VOL',
              '</div>',
              '<div class="cell" style="color:#60a917">',
                '#implyVol',
              '</div>',
               '</div>',
              '</div>',
              '<div class="tile-label" style="color:#666">',
                'last trading date : #expdate',
              '</div>',
            '</div>',
          '</div>'];
     

        jQuery( document ).ready(function() {
          jQuery('#search').keyup(function(e){
              $element = $(e.target);
              var value = $element.val();
              jQuery('.tile-wide').each(function(){
                  if(value == ""){
                          $(this).show();         
                  }else{
                    if($(this).find('.tile-label-top-dw').html().indexOf(value.toUpperCase()) != 1
                      && $(this).find('.tile-label-top-3').html().indexOf(value.toUpperCase()) != 1){
                      $(this).hide();
                    }else{
                        $(this).show();  
                    }
                  }
              });
          });
         

      });
      function compareNumbers(a, b) {
        return a - b;
      }
      

var checkFilter = function(){
              var value =   jQuery('#search').val();
             
              jQuery('.tile-wide').each(function(){
                  if(value == ""){
                          $(this).show();         
                  }else{
                    if($(this).find('.tile-label-top-dw').html().indexOf(value.toUpperCase()) != 1
                      && $(this).find('.tile-label-top-3').html().indexOf(value.toUpperCase()) != 1){
                      $(this).hide();
                    }else{
                        $(this).show();  
                    }
                  }
              });
}


var  showDialog = function(id,name){
  jQuery('#shortname').html(name);
  console.log(name) ;
  findPrice(name);
  findFeature(name);
  $('#content').modal('show');

}



/*
  Dropdown with Multiple checkbox select with jQuery - May 27, 2013
  (c) 2013 @ElmahdiMahmoud
  license: http://www.opensource.org/licenses/mit-license.php
*/