<script type="text/javascript">

if (!Array.prototype.indexOf)
{
  Array.prototype.indexOf = function(elt /*, from*/)
  {
    var len = this.length >>> 0;

    var from = Number(arguments[1]) || 0;
    from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
    if (from < 0)
      from += len;

    for (; from < len; from++)
    {
      if (from in this &&
          this[from] === elt)
        return from;
    }
    return -1;
  };
}
</script>
<style type="text/css">
.form-control{
	padding: 0px;
}
.w3-note {
    background-color: #ffffcc;
    border-left: 6px solid #ffeb3b;
}
	.dropdown {
	  margin-top:1.5em;
	  position: relative;
	}

	.dropdown dd,
	.dropdown dt {
	  margin: 0px;
	  padding: 0px;
	}

	.dropdown ul {
	  margin: -1px 0 0 0;
	}

	.dropdown dd {
	  position: relative;
	}
	a:link{
		font-size:1.3rem;
	}
	p.multiSel{
		margin:0!important;
	}
	/*.dataTables_wrapper .dataTables_paginate .paginate_button.current ,.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover, .dataTables_paginate .paginate_button.active {
		background:none;
	    background-color: #1ba1e2!important;
	    border-color: #59cde2!important;
	    color: #ffffff!important;
	    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4)!important;
	}*/
	.dropdown a,
	.dropdown a:visited {
	  color: #fff;
	  text-decoration: none;
	  outline: none;
	  font-size: 12px;
	}

	.dropdown dt a {
	  background-color: white!important;

	  border: 1px #d9d9d9 solid!important;
	  color:black;
	  display: block;
	  padding-left: 8px;
	  min-height: 34px;
	  overflow: hidden;
	  border: 0;
	  padding:3px 6px;
	  width: 100%;
	  margin-top:-2em;
	}

	.dropdown dt a span,
	.multiSel span {
	  cursor: pointer;
	  display: inline-block;
	  color:black;
	  font-size: 15px;
	}
	.hida{
		font-weight: 600;
		font-size:1.2em;
		color:black;
	}
	.dropdown dd ul {
	  background-color: white;
	  border: 1px #d9d9d9 solid;
	  color:black;
	  display: none;
	  left: 0px;
	  padding: 2px 15px 2px 5px;
	  position: absolute;
	  top: 2px;
	
	  width: 100%;
	  list-style: none;
	  height: 250px;
	  z-index:700;
	  overflow: auto;
	}
	#dropdownmulti{
	    display: inline-block;
	    min-height: 2.125rem;รี
	    height: 2.125rem;
	    position: relative;
	    vertical-align: middle;
	    margin: .325rem 0;
	    line-height: 1;
	  width: 100%;
	}
	.dropdown span.value {
	  display: none;
	}

	.dropdown dd ul li a {
	  padding: 5px;
	  display: block;
	}

	 input[type="checkbox"]{
		 width: 1.2em;
	    height: 1.2em;
	    cursor: pointer;
	    margin-right: .5rem;
	 }
	.dropdown dd ul li a:hover {
	  background-color: #fff;
	}
	a:visited {
	    color: #6e6e6e; 
	}
</style>

    <div id="header_menu">
	     <div class="container">
				<ul id="menu-table" >
					<li  class="home"><a  href="<?= base_url() ?>" class="menu"><i class="fa  fa-home" ></i></a></li>
					<li class="h_line"></li>
					<li class="selected-menu" ><a style="" href="<?= base_url() ?>search" class="menu">Search DW</a></li>
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
<div class="container">

<div><img src="<?= base_url()?>assets/images/searchDW.png" width="100%" alt="" /></div>
	<div class="box">
		<div class="box-header ui-sortable-handle" style="cursor: move;">

			<h3 class="box-title">ค้นหา / เปรียบเทียบ DW  </h3>

			<!-- /. tools -->
		</div>
		<div class="box-body">
			<form action="<?php echo base_url()?>search" method="get">
				<div class="form-group col-sm-2">
					<label for="underlying" >Underlying</label>
				</div>
				<div class="form-group col-sm-4">
					<select type="select" class="form-control" name="ul" id="underlying">
					</select>
				</div>
				<div class="form-group col-sm-2">
					<label for="Age" >Tenor</label>
				</div>
				<div class="form-group col-sm-4">
					<select type="select" class="form-control" name="age" id="age">
						<option    value="">All</option>

						<option  <?php if(isset($age1)){ ?>selected="selected"<?php } ?> value="1">น้อยกว่า 1 เดือน</option>
						<option <?php if(isset($age2)){ ?>selected="selected"<?php } ?> value="2" >มากกว่า 1 เดือน</option>
						<option <?php if(isset($age3)){ ?>selected="selected"<?php } ?> value="3" >มากกว่า 3 เดือน</option>
						<option <?php if(isset($age4)){ ?>selected="selected"<?php } ?> value="4" >มากกว่า 6 เดือน</option>
						<option <?php if(isset($age5)){ ?>selected="selected"<?php } ?> value="5" >มากกว่า 9 เดือน</option>
					</select>
				</div>
				<br style="clear:both"/>
				<div class="form-group col-sm-2">
					<label for="type" >Type</label>
				</div>
				<div class="form-group col-sm-4">
					<select type="select" class="form-control" name="type"  id="type">

						<option value="">All</option>
						<option <?php if(isset($Call)){ ?> selected="selected"<?php } ?> value="C">Call</option>
						<option <?php if(isset($Put)){ ?> selected="selected"<?php } ?> value="P" >Put</option>
					</select>
				</div>

				<div class="form-group col-sm-2">
					<label for="type" >Issuer</label>
				</div>
				<div class="form-group col-sm-4">
					 <div id="dropdownmulti">
                     <dl class="dropdown"> 
  
					    <dt>
					    <a href="#">
					      <span class="hida">Select</span>    
					      <p class="multiSel"></p>  
					    </a>
					    </dt>
					  
					    <dd>
					        <div class="mutliSelect">
					            <ul>
					                <li>
					                    <input type="checkbox"  value="" />All</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="24" />FSS</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="01" />BLS</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="03" />CGS</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="06" />PHATRA</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="07" />CIMBS</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="08" />ASP</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="11" />KS</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="13" />KGI</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="16" />TNS</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="18" />KTZ</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="23" />SCBS</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="27" />RHBOSK</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="28" />MACQ</li>
					                <li>
					                    <input type="checkbox" name="issuer[]" value="42" />MBKET</li>
					            </ul>
					        </div>
					    </dd>
					</dl>
					</div>
				</div>
			
				<br style="clear:both"/>		
			<button type="submit" class="pull-left btn btn-default" id="submit">Search
				<i class="fa fa-search"></i>
				</button>
		</div>
	</form>
</div>
<div class="col-xs-12">
	<div class="box">
		<div class="box-body">
			<table id="dwtable" class="table table-bordered  table-striped table-hover dataTable" cellspacing="0" width="100%" style="font-size:0.9em;">
				<thead>
					<tr>
						<th>DW</th>
						<th>Type</th>
						<th>Gearing</th>
						<th>Time 
						<br/>Decay</th>
						<th>bidDw</th>
						<th>Sensitivity</th>
						<th>Historical 
						<br/>Volatility *</th>
						<th>Implied 
						<br/>Volatility *</th>
						<th>MM 
						<br/>Quality *</th>
						<th>Last<br/> Trading Date</th>
					</tr>
				</thead>
				<tbody>	
					<?php foreach($datas as $row){ ?>  
					<tr>
						<td ><?= $row['dw'] ?></td>
						<td style="text-align:center"><?=$row['type'] ?></td>
						<td style="text-align:center"><?=$row['gearing'] ?></td>
						<td style="text-align:center"><?=$row['time'] ?></td>
						<td style="text-align:center"><?=$row['spotdw'] ?></th>
						<td style="text-align:center"><?=$row['sense'] ?></td>
						<td style="text-align:center"><?=$row['histvol'] ?></td>
						<td style="text-align:center"><?=$row['impliedvol'] ?></td>
						<td style="text-align:center"><?=$row['sd'] ?></td>
						<td style="text-align:center"><?=$row['expire_date'] ?></td>

						</tr>
						<?php } ?>
					</tbody>
					
				</table>
				
			</div>
	</div>
	<section class="well w3-note ">
			    	<h3> คำอธิบาย </h3>
			    	<p> 
			    		1. BidDW : ราคา DW (bid)<br>
			    		2. Gearing : อัตราทด คือ ความสามารถในการทำกำไรว่าเป็นกี่เท่าเมื่อเทียบกับการซื้อหุ้นอ้างอิงปกติ<br>
			    		3. Time Decay : คือ มูลค่าเวลาในหน่วย percent ของ DW ที่จะลดลงใน 1 วัน<br>
			    		4. Sensitivity : เป็นค่าที่บอกว่าถ้าหุ้นอ้างอิงเปลี่ยนแปลง 1 ช่อง DW บนหุ้นอ้างอิงนั้นจะเปลี่ยนแปลงไปเท่าใด<br>
			    		5. *Historical Volatility (30 , 365) <br> 
			    		6. *Implied Volatility : ค่าความผันผวนแฝง สะท้อนความถูก-แพงของราคา DW (เทียบจาก Bid Underlying กับ BidDW )<br>
			    		7. *MM Quality : คุณภาพในการดูแลราคา DW ไม่ให้เบี่ยงเบนไปจากราคายุติธรรม<br>
			    	</p>
			    </section>
</div>
</div>
 <script type="text/javascript">
    jQuery(document).ready(function($) {

    	var mapissuer = {"01" :"BLS",
    	"03" :"CGS",
    	"06" :"PHATRA",
    	"07" :"CIMBS",
    	"08" :"ASP",
    	"11" :"KS",
    	"13" :"KGI",
    	"16" :"TNS",
    	"18" :"KTZ",
    	"23" :"SCBS",
    	"24" :"FSS",
    	"27" :"RHBOSK",
    	"28" :"MACQ",
    	"42" :"MBKET"};

    	jQuery.get("<?php echo base_url(); ?>dwunderlying", function(res, status){
    		jQuery('#underlying').append('<option value="">All</option>');
    		for(var i = 0;i < res.length; i++){
    			jQuery('#underlying').append('<option value="'+res[i]+'">'+res[i]+'</option>');
    		}
    		jQuery('#underlying').val('<?= $ul ?>');

    	});
    	var currentSelect = "<?= $issuer ?>";
    	var arraySelect = currentSelect.split(',');
    	jQuery('input[name="issuer[]"]').each(function(){
    		if(arraySelect.indexOf($(this).val()) > -1){
    			$(this).prop('checked', true);
    		}
    	});
    	var initSelect="";
    	for(var i = 0; i< arraySelect.length;i++){
    		if(mapissuer[arraySelect[i]]){
    			initSelect += mapissuer[arraySelect[i]]+",";
    		}
    	}
    	if(initSelect){
    		var html = '<span title="' + initSelect + '">' + initSelect + '</span>';
    		$('.multiSel').append(html);
    		$(".hida").hide();
    	}
    	jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    		"percent-pre": function ( a ) {

    			if(a == "N/A")return -1000;
    			var x = (a == "-") ? 0 : a.replace( /%/, "" );

    			return parseFloat( x );
    		},

    		"percent-asc": function ( a, b ) {
    			return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    		},

    		"percent-desc": function ( a, b ) {
    			return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    		},

    		"snum-pre": function ( a ) {

    			if(a == "N/A")return -1;

    			return parseFloat( a );
    		},

    		"snum-asc": function ( a, b ) {
    			return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    		},

    		"snum-desc": function ( a, b ) {
    			return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    		}
    	} );


    	var table =  $('#dwtable').DataTable( {
    		"processing":true,
    		  "scrollX": true,
    		"columnDefs":[{
    			"type":"percent","targets":6
    		},{
    			"type":"percent","targets":2
    		},{
    			"type":"percent","targets":3
    		},{
    			"type":"snum","targets":5
    		},{
    			"type":"snum","targets":4
    		},{
    			"type":"percent","targets":7
    		},{
    			"type":"percent","targets":8
    		}
		],
	      "searching": false,
	      "ordering": true,
		"order": [],
		"rowCallback": function( row, data, index ) {
			$('td:eq(0)', row).html( '<a   href="<?= base_url() ?>dwdetail/'+data[0]+'">'+data[0]+'</a>' );
						      /*
						      if( "{{minsd}}" == data[7]){
						      	$('td:eq(7)', row).css({'color':'#60a917','font-weight':'bold'});
						      }
						      if( {{maxSense}} == data[6]){
						      	$('td:eq(6)', row).css({'color':'#60a917','font-weight':'bold'});
						      }
						      if( '{{minTimedecay}}' == data[5]){
						      	$('td:eq(5)', row).css({'color':'#60a917','font-weight':'bold'});
						      }*/


						  }
	} );

jQuery('#dwtable_length').append('&nbsp;<label> of '+table.data().length+'</label>');

$(".dropdown dt a").on('click', function(e) {
	e.preventDefault();
	$(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
	$(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
	return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
	var $clicked = $(e.target);
	if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});


$('.mutliSelect input[type="checkbox"]').on('click', function() {

	var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
	title = mapissuer[$(this).val()] + ",";

	if($(this).val()==  ""){
		if ($(this).is(':checked')) {
			$('.multiSel').html('');
			$('.mutliSelect input[type="checkbox"]').each(function(){ $(this).prop('checked', true)});
			var str = "";
			for(var key in mapissuer){
				if(mapissuer[key]){
					str+=mapissuer[key]+ ",";
				}
			}
			var html = '<span title="' + str + '">' + str + '</span>';

			$('.multiSel').append(html);
			$(".hida").hide();
		}else{
			$('.mutliSelect input[type="checkbox"]').prop('checked', false);
			$('.multiSel').html('');
			$(".hida").show();
		}
	}else{
		if ($(this).is(':checked')) {
			var html = '<span title="' + title + '">' + title + '</span>';
			$('.multiSel').append(html);
			$(".hida").hide();
		} else {
			$('span[title="' + title + '"]').remove();
	   // var ret = $(".hida");
	  //  $('.dropdown dt a').append(ret);
	  $('.mutliSelect input[type="checkbox"]').first().prop('checked',false);

	  if($('.multiSel').html()==""){
	  	$('.multiSel').html('');
	  	$(".hida").show();
	  }
	}
}
});

} );


</script>
</div>
<style>
#dwtable a{
	color:#fa821e;
}

#dwtable a:visited{
	font-size: 0.9em;
	color:#fa821e;
}
#dwtable th{
	vertical-align:top;
}
th{
	vertical-align: top!important;
}
</style>