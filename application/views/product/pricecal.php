<script src="<?php echo base_url() ?>assets/js/script.js"></script>
<div class="row" >
<div class="inner_content " >
	<div class="row" style="margin-bottom: 3em" >
		<div class="col-md-6 col-md-offset-3" >
			<div class="input-group">
				<span class="input-group-addon searchdw"><i class="fa fa-fw fa-search"></i></span>
			<input type="text" id="search" class="input-autocomplete" placeholder="Search DW"/>
			</div>
		</di>
		</div>
	</div>
	<span class="clearfix"></span>
	<div class="tile-container" >

	</div>

</div>
<div id="content" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document" style="width: 100%;max-width: 1000px;">
		<div class="modal-content">
			<div class="modal-header">

				<span id="shortname"></span>

				<strong> * ตารางราคาใช้เปรียบเทียบในการซื้อขายช่วง market open เท่านั้น ไม่รวมช่วง market call</strong>	
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">

				<div class="col-md-9">
						<div class="col-md-4 header_table"  class="text-right">
							<span>Price Calculation</span>
						</div>
						<div class="col-md-4 header_table">
							<span  id="updated_time" ></span>
						</div>
						<div class="col-md-4 header_table text-right" > 
							<span id="unit">Bid Price|Unit : Baht</span>
						</div>
						<table id="pricecal" class="table table-striped" cellpadding="0" cellspacing="0" width="100%" >
							<thead>
								<tr>
									<th rowspan="2" class="udrl_bid"><div style="margin-bottom: 10px"> Underlying Bid *</div></th>
									
									<th colspan="7"> DW Bid Price(THB) * </th>
								
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

				</div>

				<div class="col-md-3">
				<div id="feature_table" >
					<span class="specific">DW Specification</span>

					<table id="feature_t"  class="table table-striped" cellpadding="0" cellspacing="0" width="100%" >
						<tr>
							<td width="50%" class="gray">DW Name</td>
							<td class="dw_name"></td>
						</tr>
						<tr>
							<td class="gray">Underlying</td>
							<td class="underlying"></td>
						</tr>
						<tr>
							<td class="gray">Type</td>
							<td class="type"></td>
						</tr>
						<tr>
							<td class="gray">Exercise Price</td>
							<td class="exercise_price"></td>
						</tr>
						<tr>
							<td class="gray">Last Trading Date</td>
							<td class="lasttrade"></td>
						</tr>
						<tr>
							<td class="gray">Expiry Date</td>
							<td class="exp"></td>
						</tr>
						<tr>
							<td class="gray">Conversion Ratio</td>
							<td class="conv"></td>
						</tr>
						<tr>
							<td class="gray">Effective Gearing </td>
							<td class="eff_gearing"></td>
						</tr>
						<tr>
							<td class="gray">Sensitivity </td>
							<td class="sens"></td>
						</tr>
						<tr>
							<td class="gray">Delta </td>
							<td class="delta"></td>
						</tr>
						<tr>
							<td class="gray">Implied Volatility </td>
							<td class="imply_vol"></td>
						</tr>

						<tr>
							<td class="gray">Time decay Per Day </td>
							<td class="time_decay"></td>
						</tr>
						<tr>
							<td class="gray">Intrinsic Value Per DW </td>
							<td class="intrinsic"></td>
						</tr>
						<tr>
							<td class="gray">Moneyness</td>
							<td class="moneyness"></td>
						</tr>
						<tr>
							<td class="gray">Time to Last Trading Date(days)</td>
							<td class="ttm"></td>
						</tr>
					</table>
				</div>
				<button class="reset-pricecal btn btn-success">reset</button> 
			</div>
				<br style="clear:both"/>
				<div class="col-md-12" style="float:none">
					<p style="font-size:0.8em;line-height:18px;font-family:'tahoma';color:#000000">
						<strong>Disclaimer :</strong>		<br/>							
						1. บริษัทหลักทรัพย์ ฟินันเซีย ไซรัส จำกัด (มหาชน) อาจจะเป็นผู้ดูแลสภาพคล่อง (Market Maker) และผู้ออกใบสำคัญแสดงสิทธิอนุพันธ์ (Derivative Warrants) บนหลักทรัพย์ที่ปรากฎอยู่ในเอกสารฉบับนี้  โดยบริษัทฯ อาจจะจัดทำบทวิเคราะห์ของหลักทรัพย์อ้างอิงดังกล่าวนี้ด้วย ดังนั้นนักลงทุนควรศึกษารายละเอียดในหนังสือชี้ชวนของใบสำคัญแสดงสิทธิอนุพันธ์ดังกล่าวก่อนตัดสินใจลงทุน<br/>							
						2. ราคา DW ในตารางด้านบนเป็นราคาโดยประมาณที่คำนวณจาก fair price โดยใช้สูตร Black Scholes Model และสมมุติฐานตามที่ผู้ดูแลสภาพคล่องกำหนด ซึ่งราคา DW ที่ซื้อขายในตลาดหลักทรัพย์แห่งประเทศไทย อาจไม่สอดคล้องกับราคา DW ดังกล่าว ดังนั้น นักลงทุนจึงไม่อาจนำไปตีความว่าเป็นการให้การแนะนำ หรือเป็นการเสนอซื้อหรือเสนอขาย หรือชักชวนให้เสนอซื้อหรือเสนอขายซึ่งหลักทรัพย์<br/>									
						3. บริษัทหลักทรัพย์ ฟินันเซีย ไซรัส จำกัด (มหาชน) ขอสงวนสิทธิในการใช้ดุลยพินิจแต่เพียงผู้เดียวในการแก้ไขเพิ่มเติมข้อมูลเป็นครั้งคราวโดยไม่ต้องบอกกล่าว<br/>										
						<strong>4. * ตารางราคาใช้เปรียบเทียบในการซื้อขายช่วง market open เท่านั้น</strong>				

					</p>
				</div>
			</div>

		</div>
	</div>
</div>




</div>
<script type="text/javascript" >
          
			var findFeature = function(suggestion){
				if(suggestion){
					jQuery.get("<?=base_url() ?>ajax/feature/"+suggestion, function(data, status){
                    //console.log(data);
		                    if(data && !jQuery.isEmptyObject(data)  &&  jQuery('#shortname').html() == suggestion){
		                    	jQuery('.dw_name').html(data["dw"]);
		                    	jQuery('.underlying').html(data["underlying"]);
		                    	jQuery('.type').html(data["type"]);
		                    	jQuery('.exercise_price').html(data["strike"]);
		                    	jQuery('.lasttrade').html(data["last_trading_date"]);
		                    	jQuery('.exp').html(data["exp_date"]);
		                    	jQuery('.conv').html(data["conversion"]);
		                    	jQuery('.imply_vol').html(data["implyVol"]);
		                    	jQuery('.delta').html(data["delta"]);
		                    	jQuery('.eff_gearing').html(data["gearing"]);
		                    	jQuery('.time_decay').html(data["timedecay"]);
		                    	jQuery('.intrinsic').html(data["intrinsic"]);
		                    	jQuery('.moneyness').html(data["moneyness"]);
		                    	jQuery('.ttm').html(data["ttm"]);
		                    	jQuery('.sens').html(data["sens"]);
		                     // jQuery('.hist_vol').html(data["hvol"]);

		                 }

		             });

				}
			}
 			var findPrice = function(suggestion){
               console.log("find Price");
               	if(suggestion){
               		currentSelection = suggestion;
               		jQuery.ajax({url:"<?=base_url() ?>ajax/pricecal/"+currentSelection,type:'POST', data:{shiftPrice:shiftPrice,shiftDate:shiftDate},dataType:'json',success:function(data, status){
                    if(data && !jQuery.isEmptyObject(data) && data['dw'] == currentSelection){
                    	

                    	if(data.timeOfEvent){
                    		jQuery('#updated_time').html('updated time :'+data.timeOfEvent);
                    	}else{
                    		jQuery('#updated_time').html('');                      
                    	}
                    	jQuery('#pricecal tbody').empty(); 
                    	var sorted = {},
                    	key, a = [];

                    	for (key in data['table']) {
                    		if (data['table'].hasOwnProperty(key) && key != "timeOfEvent") {
                    			a.push(parseFloat(key));

                    		}
                    	}
                    	if(jQuery('#pricecal thead tr').length > 1){
		                    jQuery('#pricecal thead tr').last().remove();
                    	}
                    		jQuery('#pricecal thead tr').first().find('th').first().find('.shift-up').remove();
                			jQuery('#pricecal thead tr').first().find('th').first().find('.shift-down').remove();
                		
	                 //    }
                    	jQuery('#pricecal thead').append('<tr>');
                    	for(key in data['datelist'])
                    	{
                    		jQuery('#pricecal thead tr ').last().append('<th>'+data['datelist'][key]+'</th>');

                    	}
                    	var buttonRight = $('<a href="#" class="shift-right"><i class="fa fa-chevron-right" ></i></a>');
                    	var buttonLeft = $('<a href="#" class="shift-left"><i class="fa fa-chevron-left" ></i></a>');
                    	var buttonUp = $('<a href="#" class="shift-up"><i class="fa fa-chevron-up" ></i></a>');
                    	var buttonDown = $('<a href="#" class="shift-down"><i class="fa fa-chevron-down" ></i></a>');
                    	buttonRight.click(function(){
                    		shiftDate +=1;
                    		findPrice(currentSelection);
                    	});
                    	if(shiftDate > 0){

                    		jQuery('#pricecal thead tr').last().find('th').first().append(buttonLeft);
	                    	buttonLeft.click(function(){
	                    		shiftDate -=1;
	                    		findPrice(currentSelection);
	                    	});	
                    	}
                    	if(shiftPrice < 30){	

	                    	buttonUp.click(function(){
	                    		shiftPrice +=1;
	                    		findPrice(currentSelection);
	                    	});	

                    		jQuery('#pricecal thead tr').first().find('th').first().append(buttonUp);
                    	}
                    	if(shiftPrice > -30){
                    	
	                    	buttonDown.click(function(){
	                    		shiftPrice -=1;
	                    		findPrice(currentSelection);
	                    	});

	          	          	jQuery('#pricecal thead tr').first().find('th').first().append(buttonDown);
	                    }
                    	
                    	jQuery('#pricecal thead tr').last().find('th').last().append(buttonRight);
                    	a.sort(compareNumbers);
                    	for (key = a.length -1 ; key > -1; key--){
                    		var in_array = data['table'][(a[key]).toFixed(2)+''];
                    		if(parseFloat(a[key]).toFixed(2) == data['currentBid'])
                    		{
                    			console.log( data['currentBid']);
                    			jQuery('#pricecal tbody').append('<tr class="highlight">');
                    		}else{
                    			jQuery('#pricecal tbody').append('<tr >');
                    		}
                    		jQuery('#pricecal tbody tr').last().append('<td>'+parseFloat(a[key]).toFixed(2)+'</td>');
                    		for(var i = 0; i< in_array.length; i++){
                    			jQuery('#pricecal tbody tr').last().append('<td>'+in_array[i]+'</td>');
                    		}
                    	}
                    }

                }});
			}
		}

		var refreshList = function(){
			jQuery.get("<?=base_url() ?>ajax/list", function(data, status){
		                    //console.log(data);
		                    if(data && !jQuery.isEmptyObject(data)){
		                    	jQuery('.tile-container').empty();
		                    	var count = 0;
		                    	for(var i = 0; i < data['res'].length ; i++){
		                        // if(count % 5 == 0){
		                        //   console.log('push');
		                        //   jQuery('#filterpane').append('<div class="row cells5 index'+Math.floor(count/5)+'"></div>');  
		                        // }
		                        var html = templateItem.join("\n").replace(/#dw/g,data['res'][i].dw);
		                        html = html.replace(/#gearing/g,data['res'][i].gearing);
		                        html = html.replace(/#sensitivity/g,data['res'][i].sens);
		                        html = html.replace(/#expdate/g,data['res'][i].exp_date);
		                        html = html.replace(/#timedecay/g,data['res'][i].timedecay);
		                        html = html.replace(/#implyVol/g,data['res'][i].implyVol);
		                        html = html.replace(/#ul/g,data['res'][i].ul);
		                        html = html.replace(/#predw/g,data['res'][i].predw);
		                        html = html.replace(/#postdw/g,data['res'][i].postdw);
		                      //   html = html.replace(/#hvol/g,data['res'][i].hvol);


		                      html = html.replace(/#odd-even/g,"tile-odd");

		                       //  jQuery('#filterpane').find('.index'+Math.floor(count/5)).append(html);
		                       jQuery('.tile-container').append(html);
		                       // break;
		                       count++;

		                   }   
		                   checkFilter();
		               }
		    
					}); 
		};

				jQuery(document).ready(function(){
						jQuery.get("<?=base_url() ?>ajax/list", function(data, status){
			                    //console.log(data);
			                    if(data && !jQuery.isEmptyObject(data)){
			                    	var count = 0;
			                    	for(var i = 0; i < data['res'].length ; i++){
				                       // if(count % 5 == 0){
				                        //   console.log('push');
				                        //   jQuery('#filterpane').append('<div class="row cells5 index'+Math.floor(count/5)+'"></div>');  
				                        // }
				                        var html = templateItem.join("\n").replace(/#dw/g,data['res'][i].dw);
				                        html = html.replace(/#gearing/g,data['res'][i].gearing);
				                        html = html.replace(/#sensitivity/g,data['res'][i].sens);
				                        html = html.replace(/#expdate/g,data['res'][i].exp_date);
				                        html = html.replace(/#timedecay/g,data['res'][i].timedecay);
				                        html = html.replace(/#implyVol/g,data['res'][i].implyVol);
				                        html = html.replace(/#ul/g,data['res'][i].ul);

				                        html = html.replace(/#predw/g,data['res'][i].predw);
				                        html = html.replace(/#postdw/g,data['res'][i].postdw);
				                       // html = html.replace(/#hvol/g,data['res'][i].hvol);

				                       html = html.replace(/#odd-even/g,"tile-odd");
				                       jQuery('.tile-container').append(html);
				                       //  jQuery('#filterpane').find('.index'+Math.floor(count/5)).append(html);

				                       // break;
				                       count++;
			                   		}
			                   }   

				            $('.reset-pricecal').click(function(){
					              shiftPrice= 0;
					              shiftDate = 0;
					              findPrice(currentSelection);
				            });
				            $('#content').on('hidden.bs.modal', function () {
				            	console.log('close');
				            	shiftPrice= 0;
				              	shiftDate = 0;
				              //findPrice(currentSelection);
							  // do something…
							})
                       intervalList =  setInterval(function(){
                        //  findPrice(jQuery('#shortname').html());
                        //  findFeature(jQuery('#shortname').html());
                         refreshList();
                        }, 5000);
                         intervalDialog =  setInterval(function(){
                          if(jQuery('#content').is(":visible")){
                            findPrice(currentSelection);
                            findFeature(currentSelection);
                          }
                         //refreshList();
                        }, 5000);


			});
		});



</script>