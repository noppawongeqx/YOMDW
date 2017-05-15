<!DOCTYPE html public "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DW24: Derivative Warrants by Finansia Syrus</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
  <!-- Ionicons --><!-- 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/select2/select2.min.css">

  <script type="text/javascript" src="<?php echo base_url() ?>assets/chart/EJSChart.js"></script>
  <script>

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-65561537-7', 'auto');
ga('send', 'pageview');

</script>
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/chart/EJSChart.css">
  <style>
.table-striped>tbody>tr:nth-of-type(odd){
  background-color: #eee;
}
  </style>
  <!--[if lte IE 8]>

<script src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/chart/excanvas.js"></script>
<script src="<?php echo base_url() ?>assets/js/common.js"></script>
<![endif]-->
<!--[if gt IE 8 | (!IE)]><!-->

<script src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
<!--<![endif]-->

    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>

   <!--[if lt IE 9]>
      <script src="<?php echo base_url() ?>assets/js/html5shiv.js"></script>
      <script src="<?php echo base_url() ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <script src="<?=base_url()?>assets/js/emojionearea.js"></script>
   <link rel="stylesheet" href="<?=base_url()?>assets/js/emojionearea.css">
   <link rel="stylesheet" href="<?=base_url()?>assets/js/emojione.css">
   <link rel="stylesheet" href="<?=base_url()?>assets/js/emojione-awesome.css">
    <script src="<?=base_url()?>assets/js/emojione.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.ba-dotimeout.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
</head>
<body class="hold-transition skin-black ">
<div class="wrapper" style="background-color:#ecf0f5">

  <header class="main-header">
    <nav class="navbar navbar-static-top" style="margin-left:0px;">

     <div class="container-fluid">

      <div class="collapse navbar-collapse" id="navbar-collapse" style="margin: 0 auto;width: 1300px;">

        <div class="navbar-header" style="padding-top: 0px">
          <a href="http://www.fnsyrus.com" class="navbar-brand" style="padding-top: 5%;border-right:none;"><img  style="height:40px" src="<?php echo base_url();?>assets/dist/img/logodw24.png"  > </img></a>
          <a href="http://www.fnsyrus.com" class="navbar-brand" style="padding-top: 5%;border-right:none;"><img style="height:40px" src="<?php echo base_url();?>assets/dist/img/logotextdw24.png" > </img></a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
          <ul class="nav navbar-nav">
    
              <li class="margin-header"> <div style="font-size: 1.1em"><i class="fa  fa-phone"></i> (+66)2 658 9915 </div></li>
               <li class="margin-header"> <div style="font-size: 1.1em"><i class="fa  fa-envelope"></i> dw@fnsyrus.com </div></li>
               <li >
                   <div class="" style="font-size: 1.1em;color:#009A00">
                      <strong> Line DW24 </strong>
                      <img  width="100" height="100" src="<?= base_url() ?>assets/images/QR_Code.png"/> 
                  </div>
                  </li>
                  <?php if ($this->ion_auth->logged_in()) { ?>
                    <li class="margin-header"><a style="" href="<?= base_url() ?>auth/logout" class="menu">ออกจากระบบ</a></li>    
                  <?php } ?>
            </ul>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->

            <!-- /.navbar-custom-menu -->
            <!-- /.container-fluid -->
          </div>
        </div>
      </nav>

    </header>
  <!-- Left side column. contains the logo and sidebar -->
  
<style>
  .margin-header{
    margin-top:2.2em;
    padding-right:15px;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left:0px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
         
    </section>

    <!-- Main content -->
    <section class="content">
      

      <!-- Main row -->
      <div class="row">
        <div class="content_box center-block" style="float:none" >
        <!-- Left col -->
          <!--/.box -->
         <?= $contents ?>

       </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer >
    <div class="container">
      <div style="width:100%;background-color: #fff;border-top: 6px solid #fa821e;"  ><img style="width:100%" src="<?= base_url() ?>assets/images/web-support-internet.png"/></div>
      <div class="col-xs-12 sitemap"  style="padding-bottom: 3em">
          <div class="col-xs-12 contact-fss">
              <div class="col-xs-5 head-office">
                  <h4>บริษัทหลักทรัพย์ ฟินันเซีย ไซรัส จำกัด (มหาชน) </h4>
                  <p>ชั้น 18 และ 25  อาคาร ดิ ออฟฟิศเศส แอท เซ็นทรัลเวิลด์ <br>999/9 ถนนพระราม1 แขวงปทุมวัน  เขตปทุมวัน  กรุงเทพฯ 10330</p>
                  <div class="col-xs-5 tel"><a href="#"><i class="fa  fa-phone" ></i>  02-658-9500</a></div><div class="col-xs-6 fax"><a href="#"><i class="fa  fa-fax"></i>  02-658-9110</a></div>
              </div>
              <div class="col-xs-2 follow-us">
                  <h4>ติดตามเรา</h4>
                  <div class="social">
                      <a href="http://www.facebook.com/fnsyrus" class="facebook" target="_blank"></a>
                      <a href="http://www.twitter.com/fnsyrus" class="twitter" target="_blank"></a>
                      <a href="https://www.youtube.com/channel/UC5A8hznHNydj7zcH4LhSIng" class="youtube" target="_blank"></a>
                      <a href="https://line.me/ti/p/@pxl9948x" class="line" target="_blank"></a>
                  </div>
              </div>
              <div class="col-xs-3 e-newsletter">
            <div class="fss-e-newsletter">
                  <h4 style="padding-left:15%">FSS E-Newsletter</h4>
                  <a href="http://www.fnsyrus.com/eNewsLetter/2016/12/" class="btn btn-default btn-rounded btn-newsletter" target="_blank"><div class="volume">12</div><div class="m-y" style="font-size:15px;">DECEMBER 2016 </div></a>
                  <div class="clearfix"></div>
              </div>
          </div>
          </div>
      </div>
    </div>
</div>
  </footer>
  <div id="livechat-compact-container" >
      <div id="mobile_invitation_container" style="display:block"><div class="invitation_message" style="display:none"><div id="invitation_message_text"></div></div><div id="operator_avatar_container"><div id="operator_avatar" ><i class="icon-leavemessage fa fa-wechat"></i></div></div></div>

  </div>
<div id="livechat-full" class="outline style-background-color style-border-color">
   <table id="livechat-content" cellspacing="0" cellpadding="0">
      <tbody>
         <tr id="title-container" class="style-background-color">
            <td>  <a id="title" href="#" class="title title-bg title-font style-text-shadow">       
             <span id="minimize" class="title-button" data-title="Minimize window"><i class="fa fa-close"></i></span>    
             <span id="title-text">DW24 Live Chat</span>  
             </a>  
             </td>
         </tr>
         <tr id="body-container">
            <td>
               <div id="body-chat" class="style-border-color" style="height: 650px;">
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
                              ">
                         <button onclick="bottomFunction()" id="myBtn"  class="btn btn-default" title="Go to Bottom">ดูข้อความล่าสุด</button><div class="box-body chat"  style="overflow: hidden; width: auto;">

                              <div  class="col-md-12">

                        
                              <div class="direct-chat-messages" id="dialog" style="height:490px">
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
                                    

                              <div id="chat_url" style="display: none"><?=base_url() ?>chat/logchat</div>
                                   

                           
                                  <div class="direct-chat-messages" id="dialog" style="height:490px">
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
            </td>
         </tr>
      </tbody>
   </table>
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/select2/select2.full.min.js"></script>
<!-- ChartJS 1.0.1 --> 
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/u/dt/dt-1.10.12/datatables.min.js"></script>

<script  type="text/javascript"  src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.easing.1.3.js"></script>
    <!-- the jScrollPane script -->
<style>
#operator_avatar_container {
    display: table-cell;
    padding: .1em;
}
#mobile_invitation_container {
    position: absolute;
    left: 0;
    right: 0;
    width: 100%;
    font-size: .9em;
}
#livechat-compact-container{
  position: fixed; bottom:-30px; right: 15px; width: 75px; height: 105px; overflow: hidden; visibility: visible; z-index: 2147483639; background: transparent; border: 0px; transition: transform 0.2s ease-in-out; backface-visibility: hidden; opacity: 1; transform: translateY(0%);
}
#livechat-full{
    position: fixed;
    bottom: 0px;
    right: 15px;
    width: 600px;
    height: 650px;
    overflow: hidden;
    visibility: visible;
    z-index: 2147483639;
    background: transparent;
    border: 0px;
    transition: transform 0.2s ease-in-out;
    backface-visibility: hidden;
    transform: translateY(0%);
    opacity: 1;
}
.outline {
    border: 0;
    padding: 15px 15px 0;
    box-shadow: none;
}
#livechat-content {
    width: 100%;

    border: 0!important;
    height: 100%;
}
#livechat-content {
    padding: 0;
    background: #fff;
    border-radius: 4px 4px 0 0!important;
    box-shadow: 0 2px 25px rgba(0,0,0,.2)!important;
    background-clip: padding-box!important;
}
#title {
    padding-top: 10px;
    padding-bottom: 10px;
    border-radius: 3px 3px 0 0;
}
#title, #title-container #close-chat {
    display: block;
}
#title-container td {
    height: 26px;
    line-height: 26px;
    font-size: 14px;
}
.title-bg {
    background-color: #60a917 !important;
}
.title-bg, .title-button, .title-button:hover {
    background-color: #60a917;
}
.title {
    color: #fff;
    font-size: 16px;
    font-weight: 400;
    text-shadow: none;
}
#title #title-text {
    color: #fff;
    font-size: 16px!important;
    font-weight: 400!important;
    text-shadow: none!important;
}
#title #title-text {
    margin-left: 30px;
    font-size: 14px;
}
#title-container #minimize {
    height: 29px;
    padding-top: 3px;
    margin-right: 15px;
}
#title-container #minimize {
    margin-top: 0;
}
#title-container #minimize {
    padding-bottom: 5px;
}
#title-container .title-button {
    display: block;
    cursor: pointer;
    float: right;
    background-repeat: no-repeat;
}
.title-button {
    background-color: #60a917 !important;
}
.direct-chat-text{
    border-radius: 5px;
    position: relative;
    padding: 5px 10px;
    background: #d2d6de;
    border: 1px solid #d2d6de;
    margin: 5px 0 0 50px;
    color: #444444;
    width: 40%;
    font-size: 15px;
}
.right .direct-chat-text {
    margin-right: 50px;
    margin-left: 60%;
}
.emojione{
  width: 32px;
  height:32px;
  background-image:none;
}
.direct-chat-messages{
  overflow-y:scroll;
  overflow-x:hidden;
}
.chat .col-md-12{
  padding: 0px;
}
.chat{
  padding-right: 0px;
}
</style>


</body>
</html>
