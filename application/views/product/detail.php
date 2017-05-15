  

<script src="<?php echo base_url() ?>assets/chart/amchart/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/chart/amchart/amcharts/serial.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/draw.js"></script>
<script src="<?php echo base_url() ?>assets/js/script.js"></script>
<style>
#inner_content{
    width: 100%;
    max-width: 1300px!important;
    margin: 0 auto 0px auto;
    display: block;
    padding: 0 0 1px 0;
}
</style>
    <div id="header_menu">
	     <div class="container">
				<ul id="menu-table" >
					<li  class="home"><a  href="<?= base_url() ?>" class="menu"><i class="fa  fa-home" ></i></a></li>
					<li class="h_line"></li>
					<li  ><a style="" href="<?= base_url() ?>search" class="menu">Search DW</a></li>
					<li class="h_line"></li>
					<li ><a style="" href="<?= base_url() ?>pages/view/knowledge" class="menu">DW Knowledge</a></li>
					<li class="h_line"></li>
					<li ><a style="" href="<?= base_url() ?>pages/view/vocab" class="menu">DW Vocabulary</a></li>
					<li class="h_line"></li>
					<li><a style="" href="<?= base_url() ?>pages/view/faq" class="menu">FAQ</a></li>
					<li class="h_line"></li>
					<li ><a style="" href="<?= base_url() ?>chat/viewchat" class="menu">Chat</a></li>		
					<li class="h_line"></li>
				</ul>
			</div>
	  
	</div>
<div id="inner_content">


<div><img src="<?= base_url()?>assets/images/Gear-Banner2.png" width="100%" alt="" /></div>
	<div class="normal_box p80 sticky">
		<div class="green_line "></div>
		<div class="code_name" style="position: relative">
			<h4 id="dw_Id_head_search" style="cursor:pointer;height:1.2em"><?=$dw ?>				
				<i class="fa   fa-toggle-down " ></i>
			</h4>
			<h4 >
				  <input type="text"  id="dw_Id_head_select" value="<?=$dw ?>" style="display:none;text-align:center;height:1.2em"/>
			
				</h4>
		<div class="row">
			<table class="stock_info2">
			<tbody><tr>
				    <th>Volume Bid</th>
				    <th>Price Bid</th>
				    <th>Price Offer</th>
				    <th>
				    	Volume Offer
				    </th> 
				  </tr>
				<tr>
					<td><?=$dwbidvol ?></td>
					<td><?=$dwbid?> </td>
					<td><?=$dwoffer?></td>
					<td><?=$dwoffervol ?></td>
				</tr>
			</tbody>
			</table>
 		</div>
		<span class="clearfix"></span>
	</div>
		<table class="stock_info">
		  <tbody><tr>
		    <th>Moneyness:</th>
		    <th>Days To Last Trading:</th>
		    <th>Effective Gearing :</th>
		    <th >
		    	Sensitivity
		    </th> 
		  </tr>
		  <tr>
		    <td class="down">
		    	<span class="<?php if($moneynessFlag == "OTM"){ ?>otm <?php }else{ ?>itm<?php } ?>"><?= $moneyness; ?></span>
		    	<span class="small_murity">Strike:<?= number_format($exercise,3); ?>(THB)</span></td>
		    <td><span class="count"><?=$ttl ?></span> <span class="small_murity hide">2017-03-02</span></td>
		    <td class="up"><span class="count"><?= $gearing; ?></span></td>
		    <td ><?= $sensitivity ?></td>
		  </tr>          
		</tbody></table>
	</div>
<span class="clearfix"/>
<div class="box" style="border-top:none">
		<div class="box-header ui-sortable-handle" style="cursor: move;">

			<h3 class="box-title ">Terms and Data</h3> 

			<!-- /. tools -->
		</div>
		<div class="box-body ">

			<table class="table table-condensed  table-striped">
				<tbody><tr class="tbl1-row ">
						<td width="25%" class="r bg-lightgrey b text-left">
						<span >Name</span></td>
						<td width="25%" class="l red"><?=$dw ?></td>
						<td width="25%" class="bg-lightgrey b text-left"><span  data-original-title="" title="">Expire Date(Maturity Date)</span></td>
						<td width="25%" class="l "><?= $expire ?></td>
					</tr>
					<tr class="tbl1-row ">
						<td class="r bg-lightgrey b text-left"> Underlying</td>
						<td class="l"><?=$underlying ?></td>
						<td class="bg-lightgrey b text-left">Last Trading Date</td>
						<td class="l"><?=$last_trading_date?></td>
					</tr>
					<tr class="tbl1-row ">
						<td class="text-left" > Type </td>
						<td ><?php if($type == "C") { ?> Call <?php }else{ ?> Put <?php } ?></td>
						<td class="text-left">Listing Date</td>
						<td ><?=$trading_date ?></td>
					</tr>
					<tr class="tbl1-row ">
						<td class="text-left">Strike</td>
						<td><?=number_format($exercise,3,'.','')?></td>
						<td class="text-left">Conversion Ratio</span></td>
						<td ><?=$conversion ?></td>
					</tr>
					<tr>
						<td width="25%" class="r bg-lightgrey b text-left">
						<span >TimeDecay Per Day</span></td>
						<td width="25%" class="l red"><?=$timedecay ?></td>
						<td width="25%" class="bg-lightgrey b text-left"><span  data-original-title="" title="">Effective Gearing </span></td>
						<td width="25%" class="l "><?= $gearing ?></td>
					</tr>
					<tr class="tbl1-row ">
						<td class="r bg-lightgrey b text-left"> Delta</td>
						<td class="l"><?=$delta ?></td>
						<td class="bg-lightgrey b text-left">Implied Volatility</td>
						<td class="l"><?=$impliedvol?></td>
					</tr>
				</tbody>
			</table>
		</div>
</div>

<!-- LINE CHART -->
<div class="row">
	
	<div class="col-md-7 col-xs-7" >
		<div class="box" style="border-top:none">
			<div class="box-header with-border">ตารางราคา <span id="shortname"><?=$dw ?></span><br/> 

				<?php if(isset($dw24)){ ?><strong style="color:000000;"> * ตารางราคาใช้เปรียบเทียบในการซื้อขายช่วง market open เท่านั้น ไม่รวมช่วง market call</strong><?php } ?>	</div>
			<div class="box-body" >
				<?php if(isset($dw24)){ ?>
						<div id="content" >
										
							
									<div class="modal-body">

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
															
															<th colspan="5"> DW Bid Price(THB) * </th>
														
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>

										<button class="reset-pricecal btn btn-success">reset</button> 
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


						<?php }else{?>
							<div class="othertable">

							<?= $dwother['html'] ?>
							<script type="text/javascript">
								$('.othertable table').find('p').each(function(){
									$(this).removeAttr('style');
								});

								$('.othertable table').find('p').each(function(){
									$(this).css('background','none');
									$(this).css('margin','0');
									$(this).css('padding','0');
								});
								$('.othertable table').find('td').each(function(){
									$(this).removeAttr('style');
								});
								$('.othertable table').find('td:first-child').each(function(){
									$(this).removeAttr('style');
								});
								$('.othertable table').find('tr:first-child').find('td:first-child').each(function(){
									$(this).css({'width':'20%','text-align':'center'});
								});
								$('.othertable table').find('tr:first-child').find('td:nth-child(2)').each(function(){
									$(this).css({'text-align':'center'});
								});
							</script>
							</div>
							ที่มา <a href="<?= $dwother['credit'] ?>" target="blank"><?= $dwother['credit'] ?></a>
							<style>

							.othertable table{
								font-size:1em!important;
								    border-collapse: collapse;
							}
							.othertable table th td {
								   border: 1px solid black;
								}
							</style>
							<script type="text/javascript">
							jQuery('.othertable table').addClass("table table-condensed  table-bordered table-striped");

							</script>
						<?php } ?>

			</div>
		</div>

	</div>
	<div class="col-md-5 col-xs-5">
		<div class="box box-info" style="border-top:none">
			<div class="box-header with-border">
				<h3 class="box-title">Implied Volatility (ย้อนหลัง)</h3>

			</div>
			<div class="box-body ">

				<div class="chart">
				  <!--[if lte IE 8]>
					<div id="lineChart"  style="width:550px; height:300px;"></div>
					<![endif]-->
					<!--[if gt IE 8 | (!IE)]><!-->
					<div id="lineChart" style="width:460px;height: 400px;"></div>
					<!--<![endif]-->
				</div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
</div>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script>

	jQuery(document).ready(function(){
		var dw_Id = '<?= $dw ?>';

	  jQuery.get('<?= base_url() ?>impliedvolLine/'+dw_Id, function(data, status){
	  		
	  		volchart(data);
	   });
	  jQuery('#change').val(dw_Id);
	  jQuery('#change').change(function(){
			window.location.replace("<?= base_url() ?>dwdetail/"+$(this).val());
	  });	

	});


</script>

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
                    		jQuery('#updated_time').html('As Of: '+data.timeOfEvent);
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
                    	buttonRight.click(function(evt){
                    		evt.preventDefault();
                    		shiftDate +=1;
                    		findPrice(currentSelection);
                    	});
                    	if(shiftDate > 0){

                    		jQuery('#pricecal thead tr').last().find('th').first().append(buttonLeft);
	                    	buttonLeft.click(function(evt){
                    		evt.preventDefault();
	                    		shiftDate -=1;
	                    		findPrice(currentSelection);
	                    	});	
                    	}
                    	if(shiftPrice < 30){	

	                    	buttonUp.click(function(evt){
                    		evt.preventDefault();
	                    		shiftPrice +=1;
	                    		findPrice(currentSelection);
	                    	});	

                    		jQuery('#pricecal thead tr').first().find('th').first().append(buttonUp);
                    	}
                    	if(shiftPrice > -30){
                    	
	                    	buttonDown.click(function(evt){

	                    		evt.preventDefault();
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

	var listDWTpl = [


		'<div class="ac-gn-searchview-content" >',
		'<ul class="ac-gn-searchresults-list">',
		'</ul>',
		'</div>'
		];
				
		var defaultul = [	'<li class="ac-gn-searchresults-item">',
			'<a href="<?= base_url() ?>dwdetail/<?=$dw ?>" class="ac-gn-searchresults-link ac-gn-searchresults-link-suggestions" ><?=$dw ?></a>',
			'</li>',
		]
		var replaceul = [	'<li class="ac-gn-searchresults-item">',
			'<a href="<?= base_url() ?>dwdetail/#dw" class="ac-gn-searchresults-link ac-gn-searchresults-link-suggestions" >#dw</a>',
			'</li>',
		]



				jQuery(document).ready(function(){
						currentSelection = $('#shortname').html();	
						findPrice(currentSelection);

			            $('.reset-pricecal').click(function(){
				              shiftPrice= 0;
				              shiftDate = 0;
				              findPrice(currentSelection);
			            });
			            //$('.select2-dw').css('height','28px');
			   			//$('.select2-dw').select2();
			   			//$('#dw_Id_head_select').css({'height':'28px','margin-top':'10px','margin-bottom':'10px'});
			   			$('#dw_Id_head_select').hide();
			   			$('#dw_Id_head_search').click(function(event){
			   				$('#dw_Id_head_select').show();
			   				$('#dw_Id_head_select').focus();
			   				$('#dw_Id_head_select').select();
			   					$('#dw_Id_head_select').addClass('visible');
			   					event.stopPropagation();
			   				$('#dw_Id_head_select').after(listDWTpl.join('\n'));

			   				$(this).hide();
			   					$('.ac-gn-searchresults-list').empty();
			   					jQuery.get('/dw24/ajax/otherdwSearch',{searchdw:$('#dw_Id_head_select').val()}, function(data, status){

									for(var i =0 ; i< data.length ; i++)
									{
										var html = replaceul.join('\n').replace(/#dw/g , data[i]);
										$('.ac-gn-searchresults-list').append(html);
									}
							  });
			   			});	
			   			$('#dw_Id_head_select').keyup(function(){
			   				//otherdwSearch
			   				if($('#dw_Id_head_select').val()){
			   					$('.ac-gn-searchresults-list').empty();
			   				  jQuery.get('/dw24/ajax/otherdwSearch',{searchdw:$('#dw_Id_head_select').val()}, function(data, status){

									for(var i =0 ; i< data.length ; i++)
									{
										var html = replaceul.join('\n').replace(/#dw/g , data[i]);
										$('.ac-gn-searchresults-list').append(html);
									}
							  });
			   				}
			   			});
			   			$('body:not(.ac-gn-searchview-content)').click(function(){
			   				if($('#dw_Id_head_select').hasClass('visible')){

			   					$('#dw_Id_head_select').hide();
			   					$('#dw_Id_head_search').show();
			   					$('.ac-gn-searchview-content').hide();
			   					$('.ac-gn-searchresults-list').empty();
			   				}
			   			});

			   			// $('#dw_Id_head_select').focusout(function(){
			   			// 		$(this).hide();
			   			// 		$('#dw_Id_head_search').show();
			   			// 		$('.ac-gn-searchresults-list').remove();
			   			// });
                       intervalList =  setInterval(function(){
                        }, 5000);
                         intervalDialog =  setInterval(function(){
                          if(jQuery('#content').is(":visible")){
                            findPrice(currentSelection);
                            findFeature(currentSelection);
                          }
                         //refreshList();
                        }, 5000);
		});

$(window).scroll(function(){
  var sticky = $('.sticky'),
      scroll = $(window).scrollTop();

  if (scroll >= 550){
   		$('.stock_info').addClass('fixed-bg');
   		sticky.addClass('fixed');
	}else{ 
		sticky.removeClass('fixed');
   		$('.stock_info').removeClass('fixed-bg'); 
	}
});

</script>

<style>
.box-header{
	color:#9C3363;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 0;
    padding-right: 0;
    height: auto;
    margin-top: -7px;

}
.ac-gn-searchresults-list >li > a{
	    color: #999; 
    width:100%; 
    display:block;
   	font-size:1.2em;
    font-weight: bold;
}
.ac-gn-searchresults-list >li > a:hover{
	    color:	#0070c9; 
}
.ac-gn-searchresults-list >li:hover{
	 background-color:#f2f2f2;
}
.ac-gn-searchresults-list{
    font-size: 15px;
    line-height: 2;
    font-weight: 400;
    letter-spacing: normal;
    background: #fff;
    border-top: none;
    color: #999;
    overflow-x: hidden;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    white-space: nowrap;
    display: block;
    list-style: none;
    border: 1px solid #ccc;
    max-height: 178px;
}
.ac-gn-searchresults-list {
    list-style: none;
    padding-left:0px;
}
.ac-gn-searchview-content {
    position: absolute;
    width: 100%;
    height: 100vh;
    position: absolute;
    z-index: 1001;
}

</style>