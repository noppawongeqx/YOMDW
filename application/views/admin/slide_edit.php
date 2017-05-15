<div class="box">
	<div class="box-header"> <h3> Slideshow </h3></div>
	<div class="box-body"> 

			<?php echo form_open_multipart(base_url().'admin/saveSlideshow',array('class'=>'form-horizontal'));?>
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
			<div class="form-group">
				<label class="control-label col-md-3" >link to page</label>
				<div class="col-md-7"> 
					<input type="text" class="form-control" name="link" value="<?= set_value('link',isset($link)?$link:"") ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3" >position</label>
				<div class="col-md-7"> 
					<select class="form-control" name="position">
	                    <option value ="1" <?php echo set_select('position','1' , isset($position)?$position == "1":false)?> > 1</option>
	                    <option value ="2" <?php echo set_select('position','2' , isset($position)?$position == "2":false)?>> 2</option>
	                    <option value ="3" <?php echo set_select('position','3' , isset($position)?$position == "3":false)?>> 3</option>
	                    <option value ="4" <?php echo set_select('position','4' , isset($position)?$position == "4":false)?>> 4</option>
	                    <option value ="5" <?php echo set_select('position','5' , isset($position)?$position == "5":false)?>> 5</option>
	                  </select>
				</div>
			</div>
	
				<button type="submit"  class="btn btn-primary" > บันทึก </button>
				<a href="<?= base_url() ?>admin/slideshows" class="btn btn-danger"> ยกเลิก </a>

			</form>
	</div>
</div>