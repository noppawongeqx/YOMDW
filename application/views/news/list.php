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
					<li ><a style="" href="<?= base_url() ?>pages/view/contactus" class="menu">Contact Us</a></li>		
					<li class="h_line"></li>
				</ul>
			</div>
	  
	</div>
<div class="col-xs-8 col-xs-offset-2">
	<div class="box">
		<div class="box-body">
		<ul class="list-research">
	                <?php foreach($news->result_array() as $rows){ ?>
			            <li class="col-xs-12">
			                <div class="col-xs-2 date"><span class="d">20</span><span class="m-d">01 / 2017</span></div>
			                <div class="col-xs-10 desc">
			                    	<span class="date">20/01/2017</span>
			                        <p class="head tahoma"><strong>แม้ SET ยังลงอีกแต่คาดกรอบลบเริ่มจำกัด ก่อนขึ้นใหม่ เน้นทยอยซื้อ</strong></p>
			                        <p class="tahoma"></p>
									<div class="more-info"><a href="<?php echo base_url() ?>welcome/news_view/<?= $rows['id']; ?>" class="more" target="_blank">อ่านรายละเอียด</a></div>
			                </div>
			            </li>
		            <?php } ?>
		</ul>
		</div>
	</div>
</div>
<style >
 ul.list-research {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

 ul.list-research li {
    border-bottom: #d4d4d4 solid 1px;
    padding: 20px 0;
}
ul.list-research li div {
    margin: 0;
    padding: 0;
}
 ul.list-research li .date span.d {
    float: left;
    color: #fa831f;
    font-size: 80px;
    padding-top: 10px;
    line-height: 0.5em;
}
 ul.list-research li .date span.m-d {
    clear: both;
    float: left;
    color: #5d5d5d;
    font-size: 16px;
    padding-left: 5px;
    padding-top: 12px;
}
 ul.list-research li div.desc {
    position: relative;
    padding-top: 0;
}
 ul.list-research li div.desc {
    float: left;
    width: 60%;
    margin: 0;
    padding: 5px 0 0 15px;
}
 ul.list-research li div.desc:before {
    content: '';
    position: absolute;
    left: -35px;
    top: 0;
    border-left: #b7b7b7 solid 1px;
    width: 1px;
    height: 100%;
}
ul.list-research li div.desc span.date {
    color: #fa831f;
    position: relative;
    margin-top: 5px;
}
 ul.list-research li div.desc p.head {
    margin: 10px 0 0;
    color:#5d5d5d;
}
ul.list-research li div.desc p {
    margin: 5px 0 0;
}
 ul.list-research li div.desc a.more {
    font-size: 15px;
    float: left;
    margin-top: 10px;
    color:#000;
}

</style>