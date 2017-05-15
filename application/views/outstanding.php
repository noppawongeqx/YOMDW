
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
<div class="col-xs-8 col-xs-offset-2">

	<div class="col-xs-12">
	<div class="box">
		<div class="box-header"> <h3 style="color:#328a33">Outstanding (<?= date('d-m-Y');?>) </h3></div>
		<div class="box-body"> 
			<div class="col-xs-12">

				<table id="dwtable" class="table table-bordered table-hover dataTable" cellspacing="0" width="100%">
					<thead>
						<tr style="background-color:#dbede6">
							<th>Dw</th>
							<th>No Of Issue</th>
							<th>Outstanding</th>
						</tr>
					</thead>
					<tbody>	
						<?php foreach($outstanding->result_array() as $row){ ?>  
						<tr >
							<td><?= $row['dw_Id'] ?></td>
							<td><?php echo number_format($row['no_of_issue'],"0",".",",") ?></td>
							<td style="color:#328a33"><?php echo number_format($row['value'],"0",".",",") ?></td>

						</tr>
						<?php } ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
	</div>

</div>