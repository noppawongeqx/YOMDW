<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <script src="<?=base_url()?>assets/js/emojionearea.js"></script>
   <link rel="stylesheet" href="<?=base_url()?>assets/js/emojionearea.css">
   <link rel="stylesheet" href="<?=base_url()?>assets/js/emojione.css">
   <link rel="stylesheet" href="<?=base_url()?>assets/js/emojione-awesome.css">
       <script src="<?=base_url()?>assets/js/emojione.js"></script>

       <script src="<?=base_url()?>assets/js/jquery.ba-dotimeout.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
   <!--  <nav>
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
    <div id="header_menu">
       <div class="container">
        <ul id="menu-table" >
          <li  class="selected-menu home"><a  href="<?= base_url() ?>" class="menu"><i class="fa  fa-home" ></i></a></li>
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
<section class="banner-tabs">
  <div class="container">

      <div><img src="<?=base_url() ?>assets/images/banner-contact.png" width="100%" alt="" /></div>
      <?php if ($this->ion_auth->logged_in()) { ?>
      <div class="box">

<script src="<?php echo base_url() ?>assets/js/chat.js"></script>
  <script type="text/javascript">

  function convert(input) {
     var output = emojione.toImage(input);
     document.getElementById('chatmessage').innerHTML = output;
 }
    
  </script>
        <div style="position: relative; overflow: hidden; width: auto;
        "><div class="box-body chat"  style="overflow: hidden; width: auto;">

        <div  class="col-md-12">
         <div class="box-header ui-sortable-handle" style="cursor: move;">
          <i class="fa fa-comments-o"></i>

          <h3 class="box-title">Chat</h3>

         
        </div>

   <button onclick="bottomFunction()" id="myBtn"  class="btn btn-default" title="Go to Bottom">ดูข้อความล่าสุด</button>
  
        <div class="direct-chat-messages" id="dialog" style="height:700px">
          <!-- /.direct-chat-msg -->

        </div>
        <!-- /.item -->
      </div>
      <!-- /.chat -->
    </div>
    <div id="chat_url" style="display: none"><?=base_url() ?>chat/logchat</div>
    <div id="user_id" style="display: none"><?=$this->ion_auth->user()->row()->username ?></div>
    <div id="user_id_hidden" style="display: none"><?=$this->ion_auth->user()->row()->id ?></div>
    <div class="box-footer col-md-12" style="background-color:#ccc">
      <div class="input-group">
        <input class="form-control  " id="chatmessage"  placeholder="Type message..."  disabled="disabled">
  
        <div class="input-group-btn">
 
        </div>
      </div>

    </div>
  </div>
  </div>
  <?php }else{ ?>

      <div class="box">

<script src="<?php echo base_url() ?>assets/js/chat.js"></script>
 
        <div style="position: relative; overflow: hidden; width: auto;
        "><div class="box-body chat"  style="overflow: hidden; width: auto;">

        <div  class="col-md-12">
         <div class="box-header ui-sortable-handle" style="cursor: move;">
          <i class="fa fa-comments-o"></i>

          <h3 class="box-title">Chat</h3>

    <div id="chat_url" style="display: none"><?=base_url() ?>chat/logchat</div>
         
        </div>

 
        <div class="direct-chat-messages" id="dialog" style="height:700px">
          <!-- /.direct-chat-msg -->

        </div>
        <!-- /.item -->
      </div>
      <!-- /.chat -->
    </div>
    <div class="box-footer col-md-12" style="background-color:#ccc">
      <div class="input-group">
        <input class="form-control  " id="chatmessage_block"  disabled="disabled">
  
        <div class="input-group-btn">
 
          <a href="<?= base_url() ?>auth/login" id="btn-chat" class="btn btn-success">log in เพื่อ ส่งข้อความ</a>
        </div>
      </div>

    </div>
    </div>
  </div>

  <?php } ?>
</div>
</section>
<style>

.direct-chat-text {
    min-height: 31px;
    display: inline-block;
    min-width: 30px;
    word-wrap: break-word;
    max-width: 500px;
    font-size: 15px!important;
  }
.right{
  float:right;
}
.self-color{
  background-color: #8BDB3a;
}
img.emojione{
  height:auto!important;
  }
.direct-chat-text.self-color:after, .direct-chat-text.self-color:before {
  
    border-left-color:#8BDB3a;
}
.right .direct-chat-text {
    float: right;
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
    width:auto!important;
    color: white; /* Text color */
    cursor: pointer; /* Add a mouse pointer on hover */
}

#myBtn:hover {
    background-color: #555; /* Add a dark-grey background on hover */
}
</style>

