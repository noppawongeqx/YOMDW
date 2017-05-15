<div class="row">
<div class="col-md-offset-4 col-md-4">
<h1 class="text-center"><?php echo lang('login_heading');?></h1>
<div>กรุณา login ด้วย username และ email ที่ลงะทะเบียนไว้</div>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/login",array('class'=>'form-vertical'));?>

  <div class="form-group">
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </div>
<div class="form-group">
  
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </div>
<!-- <div class="form-group">
  
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </div> -->



<button type="button" class="btn btn-block btn-link .active" data-toggle="modal" data-target="#myModal">
<?php echo form_checkbox('remember', '1', TRUE, 'id="remember"');?>Rules and Conditions of use</button>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Please read the rules and conditions of use.</h4>
      </div>
      <div class="modal-body">
        <ol type="1">
  <li>Chat Room is for customers of the Company Only.</li>
  <li>It is prohibited to allude the Monarchy, religion and politics.</li>
  <li>Users will be named in Chat Room has only one name.</li>
  <li>To be a channel for contact and conversation with Analysts company.</li>
  <li>To be a channel to provide advice on trading securities analysts.</li>
  <li>Conversation is just an informed decision only not guaranteed in any matter specifically</li>
  <li>Not intended to serve as a channel to receive trading orders or confirmation of customer orders.</li>
  <li>Do not allow customers preferred to buy or sell the securities to other customers.</li>
  <li>To be a channel of communication activities, news and other information. The decision to engage in securities trading</li>
  <li>Conversation to use polite language and prohibit on any image or information is inappropriate both direct and indirect</li>
  <li>Any news or information. Prohibit or condemn others involve government agencies. And other securities companies</li>
  <li>Do not allow the sale of the stores, or leave in any case.</li>
  <li>The company denied any liability in case of damage arising from the misconduct of the customer and users in chat rooms.</li>
  <li>Prohibit on offenders Act on the Computer Crime Act 2007</li>
        </oi>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


  <div class="form-group"><?php echo form_submit('submit', lang('login_submit_btn'),array('class'=>'btn btn-default'));?></div>
<?php echo form_close();?>
<div class="form-group text-center"><span>ยังไม่ได้ลงทะเบียน ?</span></div>
<div class="form-group text-center"><a href="registration" class="btn btn-primary" style="width:100%">ลงทะเบียน</a></div>

<div class="form-group text-center"><a href="forgot_password">ลืมรหัสผ่าน ?</a></div>
</div>
</div>