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
<div class="col-xs-8 col-xs-offset-2">

	<div class="col-xs-6">
	<div class="box">
		<div class="box-header"> <h3 style="color:#328a33">MoneyFlowIn (<?= date('d-m-Y');?>) </h3></div>
		<div class="box-body"> 
			<div class="col-xs-12">

				<table id="dwtable" class="table table-bordered table-hover dataTable" cellspacing="0" width="100%">
					<thead>
						<tr style="background-color:#dbede6">
							<th>Dw</th>
							<th>Value(THB)</th>
						</tr>
					</thead>
					<tbody>	
						<?php foreach($table_flowin->result_array() as $row){ ?>  
						<tr >
							<td><?= $row['stock'] ?></td>
							<td style="color:#328a33">+<?php echo number_format($row['value'],"0",".",",") ?></td>

						</tr>
						<?php } ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
	</div>
	<div class="col-xs-6">
	<div class="box">
		<div class="box-header"> <h3 style="color:#E62E2F">MoneyFlowOut (<?= date('d-m-Y'); ?>)</h3></div>
		<div class="box-body"> 
			<div class="col-xs-12">
				<table id="dwtable" class="table table-bordered table-hover dataTable" cellspacing="0" width="100%">
					<thead>
						<tr style="background-color:#f5d2d2">
							<th>Dw</th>
							<th>Value(THB)</th>
						</tr>
					</thead>
					<tbody>	
						<?php foreach($table_flowout->result_array() as $row){ ?>  
						<tr>
							<td><?= $row['stock'] ?></td>
							<td style="color:#E62E2F">-<?php echo number_format($row['value'],"0",".",",") ?></td>

						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div>

</div>