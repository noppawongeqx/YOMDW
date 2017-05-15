<div class="box">
	<div class="box-header"> <h3> Toppick </h3></div>
	<div class="box-body"> 

			<?php echo form_open(base_url().'admin/saveTopPick',array('class'=>'form-horizontal'));?>
			<?php if(!empty($id)) { ?>
				<input type="hidden" name="id" value="<?=$id; ?>"/> 
			<?php } ?>
			<table id="dwtable" class="table table-bordered table-hover dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
					</tr>
				</thead>
				<tbody>
				<?php $row_id = 0; ?>
				<?php for($i =0 ; $i< sizeof($list) -1 ; $i = $i + 4){ ?>  
				<?php $row_id++ ; ?>
					<tr>
						<td > <?=$row_id; ?></td>
						<?php if(isset($list[$i])){ ?>
						<td><input name="dw_Id[]" value="<?= $list[$i]['dw_Id']; ?>" type="checkbox" <?php if(in_array($list[$i]['dw_Id'],$choose)) {?> checked="checked" <?php } ?>/></td>
						<td><?= $list[$i]['dw_Id'] ?></td>
						<?php } ?>

						<?php if(isset($list[$i+1])){ ?>
							<td><input name="dw_Id[]" value="<?= $list[$i+1]['dw_Id']; ?>" type="checkbox" <?php if(in_array($list[$i+1]['dw_Id'],$choose)) {?> checked="checked" <?php } ?>/></td>
						<td><?= $list[$i+1]['dw_Id'] ?></td>
						<?php } ?>

						<?php if(isset($list[$i+2])){ ?>
					<td><input name="dw_Id[]" value="<?= $list[$i+2]['dw_Id']; ?>" type="checkbox" <?php if(in_array($list[$i+2]['dw_Id'],$choose)) {?> checked="checked" <?php } ?>/></td>
						<td><?= $list[$i+2]['dw_Id'] ?></td>
						<?php } ?>
							<?php if(isset($list[$i+3])){ ?>
					<td><input name="dw_Id[]" value="<?= $list[$i+3]['dw_Id']; ?>" type="checkbox" <?php if(in_array($list[$i+3]['dw_Id'],$choose)) {?> checked="checked" <?php } ?>/></td>
						<td><?= $list[$i+3]['dw_Id'] ?></td>
						<?php } ?>

					<?php } ?>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th></th>
						<th>DW</th>
					</tr>
				</tfoot>
			</table>

	
				<button type="submit"  class="btn btn-primary" > บันทึก </button>
				<a href="<?= base_url() ?>admin/slideshows" class="btn btn-danger"> ยกเลิก </a>

			</form>
	</div>
</div>