<div class="row">
<div class="col-md-offset-4 col-md-4">


<h1>ลงทะเบียน</h1>
<p><?php echo lang('create_user_subheading');?></p>

<div id="infoMessage" class="bg-danger"><?php echo $message;?></div>

<?php echo form_open("auth/registration",array('class'=>'form-vertical'));?>
        
      <?php
      if($identity_column!=='email') {
          echo '<div class="form-group" >';
          echo lang('create_user_identity_label', 'identity');
          echo '<br />';
          echo form_input($identity);
          echo '</div>';
      }
      ?>

      <div class="form-group">
            <label> หมายเลขประจำตัวประชาชนหรือเลขบัญชี finansia:</label>
            <?php echo form_input($idcard_no);?>
      </div>
       <div class="form-group">
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </div>
       <div class="form-group">
            <?php echo lang('create_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </div>
      <div class="form-group">
             <label><?php echo lang('create_user_password_label', 'password');?></label> 
            <?php echo form_input($password);?>
      </div>

      <div class="form-group">
             <label><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label> 
            <?php echo form_input($password_confirm);?>
      </div>


      <div class="form-group">
      <?php echo form_submit('submit', lang('register_submit_btn'),array('class'=>'btn btn-default'));?></div>

<?php echo form_close();?>
</div>
</div>
<style>
p{
      background: none;
}
#infoMessage{
  color:red;
}
</style>