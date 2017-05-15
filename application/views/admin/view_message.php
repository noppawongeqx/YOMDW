<div class="box">
    <script src="<?=base_url()?>assets/js/emojionearea.js"></script>
   <link rel="stylesheet" href="<?=base_url()?>assets/js/emojionearea.css">
   <link rel="stylesheet" href="<?=base_url()?>assets/js/emojione.css">
   <link rel="stylesheet" href="<?=base_url()?>assets/js/emojione-awesome.css">
       <script src="<?=base_url()?>assets/js/emojione.js"></script>

       <script src="<?=base_url()?>assets/js/jquery.ba-dotimeout.js"></script>
<div style="position: relative; overflow: hidden; width: auto;
"><div class="box-body chat"  style="overflow: hidden; width: auto;">
	<!-- <div class="col-md-1" style="height:700px;overflow-y: scroll;">
<!-- 		<ul class="nav nav-pills nav-stacked">
				<li role="presentation" ><a id="firstroom" data-url="<?=base_url() ?>admin/logchat" class="session" href="javascript:initConv('<?=$this->ion_auth->users()->row()->id ?>',this,'<?=base_url() ?>admin/logchat/')">room 1</a></li>
		
		</ul>


	</div> -->

	<div  class="col-md-12">
	 <div class="box-header ui-sortable-handle" style="cursor: move;">
  <i class="fa fa-comments-o"></i>

  <h3 class="box-title">Chat</h3>

    <div id="chat_url" style="display: none"><?=base_url() ?>admin/logchat</div>
    <div id="user_id" style="display: none"><?=$this->ion_auth->user()->row()->username ?></div>
    <div id="user_id_hidden" style="display: none"><?=$this->ion_auth->user()->row()->id ?></div>

</div>

<script src="<?php echo base_url() ?>assets/js/admin_chat.js"></script>

    <button onclick="bottomFunction()" id="myBtn" class="btn" title="Go to Bottom">ดูข้อความล่าสุด</button>
<div class="direct-chat-messages" id="dialog" style="height:700px">
   
    <!-- /.direct-chat-msg -->

  </div>
  <!-- /.item -->
</div>
<!-- /.chat -->
</div>
<div class="box-footer col-md-12 " style="background-color:#ccc">
  <div class="input-group">
    <input class="form-control" id="chatmessage" placeholder="Type message..." disabled="disabled">
    <div class="input-group-btn">
      <button type="button" id="btn-chat" class="btn btn-success">Send</button>
    </div>
  </div>
</div>
</div>
</div>
<style>

.direct-chat-text {
    min-height: 31px;
    display: inline-block;
    min-width: 30px;
    word-wrap: break-word;
    max-width: 500px;
  }
.right{
  float:right;
}
.self-color{
  background-color: #8BDB3a;
}
.direct-chat-text.self-color:after, .direct-chat-text.self-color:before {
  
    border-left-color:#8BDB3a;
}
.right .direct-chat-text {
    float: right;
}
img.emojione{
  height:auto!important;
  }

.emoji-menu {
    position: absolute;
    right: 0;
    z-index: 999;
    width: 225px;
    overflow: hidden;
    
    top: -200px;
}
#dialog .emojione{
  background-image:none!important;
}
#myBtn {
    display: none; /* Hidden by default */
    position: fixed; /* Fixed/sticky position */
    top: 500px; /* Place the button at the bottom of the page */
    right: 30px; /* Place the button 30px from the right */
    z-index: 99; /* Make sure it does not overlap */
    border: none; /* Remove borders */
    outline: none; /* Remove outline */
  
    color: white; /* Text color */
    cursor: pointer; /* Add a mouse pointer on hover */
}

#myBtn:hover {
    background-color: #555; /* Add a dark-grey background on hover */
}
</style>