<script src="<?php echo base_url() ?>assets/js/font.js"></script> 
<script src="<?php echo base_url() ?>assets/js/home.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/js/slick-1.6.0/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/js/slick-1.6.0/slick/slick-theme.css"/>
<script src="<?php echo base_url() ?>assets/chart/amchart/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/chart/amchart/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/gistfile1.js"></script>

<script type="text/javascript" src="<?=base_url() ?>assets/js/slick-1.6.0/slick/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.contentcarousel.js"></script>
   <!--  <nav>
      <div class="container">
      <ul>
          <li class="active"><a href="<?= base_url() ?>">หน้าหลัก</a></li>
            <li class=""><a href="<?= base_url() ?>search">ค้นหา</a></li>
            <li class=""><a href="<?= base_url() ?>pages/view/knowledge">DW Knowledge</a></li>
            <li class=""><a href="<?= base_url() ?>pages/view/vocab">คำศัพท์ DW</a></li>
            <li class=""><a href="<?= base_url() ?>pages/view/faq">คำถามจากนักลงทุน</a></li>
            <li class=""><a href="<?= base_url() ?>pages/view/contactus">ข้อมูลนักลงทุน</a></li>
        </ul>
        <div class="line-v"></div>
      </div>  
    </nav> -->

      <div class="container">
	<table id="menu-table" width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bgcolor="#FFFFFF" style="font-family:'supermarketRegular', serif;font-size:2em;border-bottom: 1px #fff solid">
	<tbody><tr height="50">
		<td width="16.67%" align="center" valign="middle" bgcolor="#fb6d1c" onmouseover="this.bgColor='#fb6d1c';" onmouseout="this.bgColor='#fb6d1c';"><a style="color:#fff;font-size:25px!important;" href="<?= base_url() ?>" class="menu">หน้าแรก</a></td>
		<td width="16.67%" align="center" valign="middle" bgcolor="#99a0aa" onmouseover="this.bgColor='#fea32e';" onmouseout="this.bgColor='#99a0aa';"><a style="color:#fff;font-size:25px!important;" href="<?= base_url() ?>search" class="menu">ค้นหา DW</a></td>

		<td width="16.67%" align="center" valign="middle" bgcolor="#99a0aa" onmouseover="this.bgColor='#fea32e';" onmouseout="this.bgColor='#99a0aa';"><a style="color:#fff;font-size:25px!important;" href="<?= base_url() ?>pages/view/knowledge" class="menu">DW Knowledge</a></td>
		<td width="16.67%" align="center" valign="middle" bgcolor="#99a0aa" onmouseover="this.bgColor='#fea32e';" onmouseout="this.bgColor='#99a0aa';"><a style="color:#fff;font-size:25px!important;" href="<?= base_url() ?>pages/view/vocab" class="menu">คำศัพท์ DW</a></td>
		<td width="16.67%" align="center" valign="middle" bgcolor="#99a0aa" onmouseover="this.bgColor='#fea32e';" onmouseout="this.bgColor='#99a0aa';"><a style="color:#fff;font-size:25px!important;" href="<?= base_url() ?>pages/view/faq" class="menu">คำถามจากนักลงทุน</a></td>
		<td width="16.67%" align="center" valign="middle" bgcolor="#99a0aa" onmouseover="this.bgColor='#fea32e';" onmouseout="this.bgColor='#99a0aa';"><a style="color:#fff;font-size:25px!important;" href="<?= base_url() ?>pages/view/contactus" class="menu">ติดต่อเรา</a></td>		
	</tr>
</tbody></table>
</div>
<section class="banner-tabs">
	<div class="container">

		<?php $length = sizeof($slideshows->result_array()); ?>
	<!-- 	<ul class="col-xs-3 col-md-3 nav nav-tabs match-height" style="padding-right: 0px!important;" role="tablist" id="hilight-home" >

			<?php $index = 0; ?>
			<?php foreach ($slideshows->result_array() as $row) { ?>
			<?php $index++; ?>
			<li role="banner" class="nav-tab link-<?= $row['id'] ?> <?= (1  == $index)?'text-active':'' ?> <?= ($length  == $index)?'last':'' ?>"><a href="#" data-id="<?= $row['id'] ?>"  role="tab" data-toggle="tab" aria-expanded="false">


			<img src="<?=base_url() ?>/assets/images/nav-tab-0<?=$index ?>.png"  />
			<span><?= $row['title'] ?></span></a></li>			
			<?php } ?>
		</ul> -->
		<div class="col-xs-12 tab-content match-height" style="padding-right: 0px!important;" id="hilight-tab-content">
			<?php $index = 0; ?>
			<?php foreach ($slideshows->result_array() as $row) { ?>

			<?php $index++; ?>
			<div role="tabpanel" style="height:420px;width:100%" data-id="<?= $row['id'] ?>" class="tab-pane  <?= (1  == $index)?'active':'' ?> <?= ($length  == $index)?'last':'' ?>" id="img-<?= $row['id'] ?>">
				<img src="<?= base_url() ?>uploads/slideshow/<?= $row['img_url'] ?>" class="img-responsive" style="width:100%">
			</div>
			<?php } ?>
		</div>
	
		<div id="index_content">

			<div class="row">
				<div class="col-xs-12" >
					
					<div class="scroller" id="scroller">
						<div class="scrollingtext" id="scrollingtext">

						    <strong class="news" > DW24 HOT NEWS : </strong>

							<?php $idx = 0; ?>
							<?php foreach ($newslist->result_array() as $row) { ?>
							<?php if($idx !=0){?>
							<strong class="strip">|</strong><a class="news" href="<?php echo base_url() ?>welcome/news_view/<?= $row['id']; ?>" data-id="<?= $row['id']; ?>" ><?= $row['title'] ?></a>
							<?php }else { ?>
							<a class="news" href="<?php echo base_url() ?>welcome/news_view/<?= $row['id']; ?>" data-id="<?= $row['id']; ?>" ><?= $row['title'] ?></a>
							<?php } ?>
							<?php $idx++; ?>
							<?php } ?>

						</div>
					</div>
				</div>
			</div>
			<span class="clearfix"></span>
			<div id="index_panel">
				<div class="grid clearfix" style="position: relative;height: 665px;">
				<div class="box  box-warning top-pick">
					
					<div class="box-body">
						<div class="header" style=";height:51px">
							 DW24 Top Pick 
							 <a class="more" id="toppick_more" href="<?php base_url() ?>search">More</a>
						</div>
						<div class="w_line"></div>
						<div id="ca-container2" class="ca-container">
							<div class="ca-wrapper">
							<?php $j = 0; ?>
								<?php foreach ($listpick as $row) { ?>
								<div class="ca-item2 ca-item-<?= $j  ?>">
								<?php $j++ ?>
									<a href="<?=base_url()?>dwdetail/<?= $row['dw'] ?>" >
										<div class="ca-item-main2">
										 <h3><?= $row['dw'] ?></h3>
											<div class="num"><b>E.GEARING </b><b class="gearing" ><?= $row['gearing']; ?>  </b></div>
											<div class="txt">Strike: <?= number_format($row['strike'],3,'.',''); ?>
												<br>Sensitivity: <?= $row['sensitivity'] ?>  
												<br>I.V.: <?= $row['implyVol']; ?>
												<br>Last Trade: <?= $row['exp_date']; ?>
												<br>

											</div>
												
										</div>
									</a>
								</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			<!-- <div  id="searchdw" >
				<div class="box box-warning searchdw">
				
					<div class="box-body">
						<div class="header">
							 ค้นหา DW24
						</div>
						<div class="w_line"></div>
						<div class="input-group" style="margin-top:5px">
							<span class="input-group-addon searchdw"><i class="fa fa-fw fa-search"></i></span>
								<input type="text" id="search" class="input-autocomplete"  placeholder="Search DW"/>
						</div>
						
						<div class="tile-container" >
							<h4 class="h4_title"><span id="rname" style="display:block"> No related Data</span>   <span id="rcode"></span></h4>
							<div class="w_line"></div>
					      <div class="w_line"></div>
					      <div class="timer">Last Update: <span id="rstime">-</span></div>
						</div>

					</div>
				</div>
				
			</div> -->
			<div class="box  box-warning ourdw">
					
					<div class="box-body">
						<div class="header">
						<form class="form-inline" style="margin-bottom: 0px;height:30px">
							 <div class="form-group" style="margin-bottom: 0px">	 
						  <label class="txt_icon" style="margin-bottom: 0px;display: inline;color:#e9721c">
								 Our DW24 &nbsp;&nbsp;&nbsp;
							</label><input id="rsearchcode" class="form-control " type="text" placeholder="Underlying Search" style="height:29px;">
					        <a id="rsearchbtn" href="javascript:void(0);"></a>
					      </div>
					      </form>
						</div>
						<div class="w_line"></div>


						<div id="ca-container" class="ca-container">
							<div class="ca-wrapper-2">
							<?php $j = 0; ?>
								<?php foreach ($listall as $row) { ?>
								<div class="ca-ul-<?= $row['underlying'] ?> ca-slick  ca-item-<?= $j  ?> ca-dw-<?= $row['dw'] ?> ">
								<?php $j++ ?>
									<a href="<?=base_url()?>dwdetail/<?= $row['dw'] ?>" >
										<div class="ca-item-main2">
										 <h3><?= $row['dw'] ?></h3>
											<div class="num"><b>E.GEARING </b><b class="gearing" ><?= $row['gearing']; ?>  </b></div>
											<div class="txt">Strike:  <?= number_format($row['strike'],3,'.',''); ?>
												<br>Sensitivity: <?= $row['sensitivity'] ?>  
												<br>I.V.: <?= $row['implyVol']; ?>
												<br>Last Trade: <?= $row['exp_date']; ?>
												<br>

											</div>
												
										</div>
									</a>
								</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			

			
				<div id="moneyflow" >
					<div class="box  box-info moneyflow " style="height:380px">
						<div class="box-header with-border"> 
							Top5 Money Flow 

							<div class="btn-group">
		                      <button type="button" onclick="drawFlowIn()" class="btn btn-info selected flowin">Flow in</button>
		                      <button type="button" onclick="drawFlowOut()" class="btn btn-info flowout">Flow out</button>
		                    </div>
			                      <a class="more" href="<?=base_url()?>welcome/moneyflow/" >More</a>
						</div>

						<div class="box-body">
							<div id="moneyflowgraph" style="width:100%; height:280px;">
							</div>
			                      <br class="clear" />
		                      <div class="timer" style="position: absolute;bottom: 10px;">Last Update: <span id="mftime">-</span></div>
			                   
						</div>

					</div>
				</div>
				<div id="outstanding" >
					<div class="box  box-info outstanding" style="height:380px">
						<div class="box-header with-border">
							DW24 Outstanding
						</div>

						<div class="box-body">
							<div id="outstandinggraph" style="width:100%; height:280px;">
							</div>

			                      <br class="clear" />
		                      <div class="timer" style="position: absolute;bottom: 10px;">Last Update: <span id="ostime">-</span></div>
			                   
						</div>

					</div>
				</div> 
			</div>

				<div class="row" style="margin-right: 0px!important;margin-left: -30px;">
				<h1 style="  text-align: center;font-family: 'Arial';font-size:3em;color:#b052a8;margin-top:0px;">DW24 Market comparison</h1>
				<div class="col-xs-3 adjust">
				<div class="box-header " style="color:#5d5d5d;font-size: 1em;font-weight:bold;text-align: center; ">Average imply volatility (%)</div>
				<div class="small-box bg-mkt">
						<div class="col-sm-offset-1" style="padding: 0px;background-color: #fff">
								<span class="info-box-icon <?php if($feature['iv24'] < $feature['ivMkt']) {?>smile<?php } else { ?>sad <?php } ?> " ><i class="fa 
							<?php if($feature['iv24'] < $feature['ivMkt']) {?>fa-smile-o<?php } else { ?>fa-frown-o <?php } ?>	
							" style="font-size:4.5em"></i>
									 <br/>DW24 <br/> <?=number_format($feature['iv24']*100,2,'.','') ?>%
							 </span>
							<span class="info-box-icon" ><i class="fa 
							<?php if($feature['iv24'] < $feature['ivMkt']) {?>fa-frown-o<?php } else { ?>fa-smile-o <?php } ?>	
							" style="font-size:4.5em"></i>
									 <br/>Market <br/><?=number_format($feature['ivMkt']*100,2,'.','') ?>% 
							 </span>
						</div>

				</div>
				</div>
				<div class="col-xs-3 adjust">
				<div class="box-header" style="color:#5d5d5d;font-size: 1em;font-weight: bold;text-align: center;">Average gearing</div>
				<div class="small-box bg-mkt">
						<div class="col-sm-offset-1" style="padding: 0px;background-color: #fff">
							<span class="info-box-icon <?php if($feature['gearing24'] > $feature['gearingMkt']){?>smile<?php } else { ?>sad <?php } ?>" ><i class="fa 
							 <?php if($feature['gearing24'] > $feature['gearingMkt']){?>fa-smile-o<?php } else { ?>fa-frown-o <?php } ?>
							 " style="font-size:4.5em"></i>
									 <br/>DW24 <br/> <?=number_format($feature['gearing24'],2,'.','') ?> 
							 </span>
								<span class="info-box-icon" ><i class="fa 
							<?php if($feature['gearing24'] < $feature['gearingMkt']) {?>fa-smile-o<?php } else { ?>fa-frown-o <?php } ?>	
							" style="font-size:4.5em"></i>
									 <br/> Market<br/> <?=number_format($feature['gearingMkt'],2,'.','') ?>
							 </span>
						</div>
				</div>
				</div>
				<div class="col-xs-3 adjust" >
				<div class="box-header " style="color:#5d5d5d;font-size: 1em;font-weight: bold;text-align: center;">Average best bid/best offer </div>
				<div class="small-box bg-mkt">
					  	<div class="col-sm-offset-1" style="padding: 0px;background-color: #fff">
							<span class="info-box-icon <?php if($AVGBidOffer['bidoffer24'] > $AVGBidOffer['bidofferMkt']){?>smile<?php } else { ?>sad <?php } ?>" ><i class="fa 
							 <?php if($AVGBidOffer['bidoffer24'] > $AVGBidOffer['bidofferMkt']){?>fa-smile-o<?php } else { ?>fa-frown-o <?php } ?>
							 " style="font-size:4.5em"></i>
									 <br/>DW24 <br/> <?=number_format($AVGBidOffer['bidoffer24']/1000000,2,'.',',') ?> M
							 </span>
									<span class="info-box-icon" ><i class="fa 
							<?php if($AVGBidOffer['bidoffer24'] > $AVGBidOffer['bidofferMkt']) {?>fa-frown-o<?php } else { ?>fa-smile-o <?php } ?>	
							" style="font-size:4.5em"></i>
									 <br/> Market <br/><?=number_format($AVGBidOffer['bidofferMkt']/1000000,2,'.',',') ?> M
							 </span>
						</div>

				</div>
				</div>
				<div class="col-xs-3 adjust" >
				<div class="box-header " style="color:#5d5d5d;font-size: 1em;font-weight: bold;text-align: center;">Average time decay(THB/day)</div>
				<div class="small-box bg-mkt">
					 	<div class="col-sm-offset-1" style="padding: 0px;background-color: #fff">
							<span class="info-box-icon <?php if(round($feature['time24'],4) >= round($feature['timeMkt'],4)){?>smile<?php } else { ?>sad <?php } ?>" ><i class="fa 
							 <?php if(round($feature['time24'],4) >= round($feature['timeMkt'],4)){?>fa-smile-o<?php } else { ?>fa-frown-o <?php } ?>
							 " style="font-size:4.5em"></i>
									 <br/> DW24 <br/> <?=number_format($feature['time24'],4,'.',',') ?> <br/>
							 </span>
							<span class="info-box-icon" ><i class="fa 
							<?php if($feature['time24'] < $feature['time24']) {?>fa-frown-o<?php } else { ?>fa-smile-o <?php } ?>	
							" style="font-size:4.5em"></i>
									 <br/>  Market <br/><?=number_format($feature['timeMkt'],4,'.',',') ?> <br/>
							 </span>
						</div>


				</div>
				</div>
				</div>
				<span class="clearfix"/>
				<!--   <div class="row">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<i class="fa fa-comment"></i> Chat
							</div>
							<div class="panel-body">
								<ul class="chat" id="received">
									
								</ul>
							</div>
							<div class="panel-footer">
								<div class="clearfix">
									<div class="col-md-3">
										<div class="input-group">
											<input id="nickname" type="text" class="form-control input-sm" placeholder="Nickname..." />
										</div>
									</div>
									<div class="col-md-9" id="msg_block">
										<div class="input-group">
											<input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
											<span class="input-group-btn">
												<button class="btn btn-warning btn-sm" id="submit">Send</button>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
				    </div> -->
		</div>
	</div>
</section>

<script type="text/javascript">
 // $('#ca-container').contentcarousel();
 // $('#ca-container2').contentcarousel();
 $('.match-height').slick({
  dots: true,
  autoplay:true,
  infinite: true,
  speed: 500,
  fade: true,
});
	
  $('.ca-wrapper-2').slick({
  	 slidesToShow: 3,
  autoplay:true,
  infinite: false,
  slidesToScroll: 1
	});
  $('.ca-wrapper').slick({
  	 slidesToShow: 2,
  autoplay:true,
  infinite: false,
  slidesToScroll: 1
	});
  jQuery(document).on('click','#clearfilter',function() {
  	 $('#rsearchcode').val('');
  	$(this).remove();
  	$('.ca-wrapper-2').slick('slickUnfilter');
  });
  jQuery('#rsearchcode').keyup(function(){
  		var $this=  $(this);
	  	var ul  = $('#rsearchcode').val();
	  if (ul) {
	    $('.ca-wrapper-2').slick('slickUnfilter');
	    $('.ca-wrapper-2').slick('slickFilter',"[class^='ca-ul-"+ul.toUpperCase()+"']");
	    filtered = true;
	  } else {
	    $('.ca-wrapper-2').slick('slickUnfilter');
	    filtered = false;
	  }
  });
</script>
<style>
.adjust{
	width:25%;
	padding-left:0px!important;
	padding-right:0px!important;
}
.txt_thumb2{
	padding: 0px;
	height:130px;
	background-color: #fff;
}
.txt_thumb2 h3{
	border-bottom: none;
}
/*.bg-mkt{
	background-color: #49AEC0;
}*/
.img-container2{
	max-width: 100%;
	overflow: hidden;
	padding: 10px;
	display: inline-block;
}
.img-container-2 .text-image{
	margin-top:1.5em!important;
}

.img-container{
	max-width: 100%;
	background-image:url('<?=base_url() ?>assets/images/thumb_up2.png');
	height: 130px; 
    background-size: 100%;
    background-repeat: no-repeat;
	overflow: hidden;
    
}
.img-container-2{
	max-width: 100%;
	background-image:url('<?=base_url() ?>assets/images/thumb_down1.png');
	height: 130px; 
    background-size: 100%;
    background-repeat: no-repeat;
	overflow: hidden;
    
}


.ie8-img-container{
max-width: 100%;
	background-image:url('<?=base_url() ?>assets/images/thumb_up2.png');
	height: 130px; 
    background-size: 100%;
    background-repeat: no-repeat;
	overflow: hidden;
    -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader( src='<?=base_url() ?>assets/images/thumb_up2.png', sizingMethod='scale')";
    
}

.ie8-img-container2 {
max-width: 100%;
	background-image:url('<?=base_url() ?>assets/images/thumb_down1.png');
	height: 130px; 
    background-size: 100%;
    background-repeat: no-repeat;
	overflow: hidden;
    -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader( src='<?=base_url() ?>assets/images/thumb_down1.png', sizingMethod='scale')";
    
}
a{
	color:#222222;
}
.text-image {
    font-size: 15px!important;
    margin-top:3.5em!important;
    border-bottom :0px!important;
    color: #49AEC0;
    font-weight: bold;
}
.text-image2 {
    font-size: 15px!important;
    margin-top:3.5em!important;
    border-bottom :0px!important;

    color: #fa831f;
    font-weight: bold;
}
/* Make it a marquee */
/* ::before was :before before ::before was ::before - kthx */
.scroller {
    background-color: #fb6d1c;
    color: #ffffff;
    font-size: 20px;
    height:30px;
    line-height:28px;
    overflow:hidden;
    position:relative;
}
.small-box{
	text-align:left;
}
.small-box .img-container h3,.small-box .img-container-2 h3{
	    border-bottom: none;
	    margin-left:1em;

}
.small-box {
    width: 100%!important;
    float: left;
}
.small-box .icon{
	    top: 15px;
    right: 10px;
}
.btn-group button{
	font-size:1.2em;
}
.ie8-img-container2 .text-image{
	margin-top:1.2em!important;
}
.scrollingtext {
    white-space:nowrap;
    position:absolute;
    font-size: 18px;
}
.scrollingtext a:visited {
    text-decoration:none;
}
.news{
	padding-top:0.5em;
	padding-bottom:0.5em;
	color:#fff;
	font-weight: 600;

}
.amcharts-chart-div a{
	display: none;
}
.strip{
	padding-left:1em;
	padding-right:1em;
}
.marquee {
    width: 100%;
    margin: 0 auto;
    white-space: nowrap;
    overflow: hidden;
    box-sizing: border-box;
    border: 1px #a2d246 solid;
    background-color:#ebf8a4;
    margin-top:2em;
	padding-top:10px;
	padding-bottom:10px;
}

.marquee span {
    display: inline-block;
    padding-left: 100%;
    text-indent: 0;
    animation: marquee 20s linear infinite;
}
.marquee span:hover {
    animation-play-state: paused
}

/* Make it move */
@keyframes marquee {
    0%   { transform: translate(0, 0); }
    100% { transform: translate(-100%, 0); }
}

/* Make it pretty */
.microsoft {
    padding-left: 1.5em;
    position: relative;
    font: 16px 'Segoe UI', Tahoma, Helvetica, Sans-Serif;
}


/* Style the links */
.vanity {
    color: #333;
    text-align: center;
    font: .75em 'Segoe UI', Tahoma, Helvetica, Sans-Serif;
}

.vanity a, .microsoft a {
    color: #1570A6;
    transition: color .5s;
    text-decoration: none;
}

.vanity a:hover, .microsoft a:hover {
    color: #F65314;
}

/* Style toggle button */
.toggle {
	display: block;
    margin: 2em auto;
}

.amcharts-chart-div a {display:none !important;}
.slick-dots{
	    position: relative;
	    bottom:0px;
}
.selected{
	background-color:#fa831f!important;;
	border-color:#fa831f!important;
    color: #fff!important;
}
.moneyflow .btn-info{
	
    background-color: #fff;
    color: #fa831f;
    font-size: 1em;
    border-color: #fa831f;
}
.moneyflow .btn-info:hover{
	background-color: #db6808;
    color: #fff!important;
}
.moneyflow .btn-info:active{
	background-color: #db6808;
    color: #fff!important;
}
.info-box-icon{
	height: 130px;
    width: 50%;
    padding-top: 10px;
    color:white;
    font-size: 15px;
    line-height: 20px;
    background-color: #fff;
    color:#000;
}

.smile{
	background-color:#60a917!important;
	color:#fff!important;
}
.sad{
	background-color: #dd4b39 !important;
	color:#fff!important;
}
</style>