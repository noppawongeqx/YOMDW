<div class="box">
	<div class="box-header"> <h3> News </h3></div>
	<div class="box-body"> 

			<?php echo form_open_multipart(base_url().'admin/saveNews',array('class'=>'form-horizontal'));?>
			<?php if(!empty($id)) { ?>
				<input type="hidden" name="id" value="<?=$id; ?>"/> 
			<?php } ?>

			<div class="form-group">
				<label class="control-label col-md-3">รูป</label>
				<div class="col-md-7"> 
					<input type="file"  name="img_url" size="20" />
					<input type="hidden" name="img_url_default" value="<?= set_value('img_url_default',isset($img_url)?$img_url:"") ?>" />
				</div>

			</div>	
			<div class="form-group" >
				<label class="control-label col-md-3">title</label>
				<div class="col-md-7"> 
					<input type="text" class="form-control" name="title" value="<?= set_value('title',isset($title)?$title:"") ?>" />
				</div>

			</div>

	
				<button type="submit"  class="btn btn-primary" > บันทึก </button>
				<a href="<?= base_url() ?>admin/slideshows" class="btn btn-danger"> ยกเลิก </a>

			</form>
	</div>
</div>