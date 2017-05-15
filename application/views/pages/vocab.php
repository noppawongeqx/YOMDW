 <div id="header_menu">
       <div class="container">
        <ul id="menu-table" >
          <li  class="home"><a  href="<?= base_url() ?>" class="menu"><i class="fa  fa-home" ></i></a></li>
          <li class="h_line"></li>
          <li ><a style="" href="<?= base_url() ?>search" class="menu">Search DW</a></li>
          <li class="h_line"></li>
          <li  ><a style="" href="<?= base_url() ?>pages/view/knowledge" class="menu">DW Knowledge</a></li>
          <li class="h_line"></li>
          <li  class="selected-menu"><a style="" href="<?= base_url() ?>pages/view/vocab" class="menu">DW Vocabulary</a></li>
          <li class="h_line"></li>
          <li><a style="" href="<?= base_url() ?>pages/view/faq" class="menu">FAQ</a></li>
          <li class="h_line"></li>
					<li ><a style="" href="<?= base_url() ?>chat/viewchat" class="menu">Chat</a></li>	  
          <li class="h_line"></li>
        </ul>
      </div>
    
  </div> 
<div class="container">

<style>
	
	a.menu:link, a.menu:visited, a.menu:active {
    font-size: 22px;
    text-decoration: none;
    color: #FFFFFF;
    font-weight: normal;

}
.head a{
    	color:#ffffff!important;	
    }
</style>
<div><img src="<?=base_url() ?>assets/images/banner-vocabulary.png" width="100%" alt="" /></div>
<div class="box">
<div class="box-body">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="5" bgcolor="#FFFFFF">
	<tr>
		<td width="30%" valign="top">
			<table width="100%" border="0" align="center" cellpadding="10" cellspacing="1">
				<tr>
					<td height="30" bgcolor="#fb6d1c" class="head" valign="middle">คำศัพท์ DW ที่ควรทราบ</td>
				</tr>
				<tr>
					<td height="30" bgcolor="#b7b7b7" class="head" valign="middle" onMouseover="this.bgColor='#fea32e';" onMouseout="this.bgColor='#b7b7b7';"><a href="#01" class="menu">Effective Gearing</a></td>
				</tr>
				<tr>
					<td height="30" bgcolor="#b7b7b7" class="head" valign="middle" onMouseover="this.bgColor='#fea32e';" onMouseout="this.bgColor='#b7b7b7';"><a href="#02" class="menu">Time Decay</a></td>
				</tr>
				<tr>
					<td height="30" bgcolor="#b7b7b7" class="head" valign="middle" onMouseover="this.bgColor='#fea32e';" onMouseout="this.bgColor='#b7b7b7';"><a href="#03" class="menu">Implied Volatility</a></td>
				</tr>
				<tr>
					<td height="30" bgcolor="#b7b7b7" class="head" valign="middle" onMouseover="this.bgColor='#fea32e';" onMouseout="this.bgColor='#b7b7b7';"><a href="#04" class="menu">All-in Premium (% Premium)</a></td>
				</tr>
				<tr>
					<td height="30" bgcolor="#b7b7b7" class="head" valign="middle" onMouseover="this.bgColor='#fea32e';" onMouseout="this.bgColor='#b7b7b7';"><a href="#05" class="menu">Intrinsic Value</a></td>
				</tr>
				<tr>
					<td height="30" bgcolor="#b7b7b7" class="head" valign="middle" onMouseover="this.bgColor='#fea32e';" onMouseout="this.bgColor='#b7b7b7';"><a href="#06" class="menu">Delta</a></td>
				</tr>
				<tr>
					<td height="30" bgcolor="#b7b7b7" class="head" valign="middle" onMouseover="this.bgColor='#fea32e';" onMouseout="this.bgColor='#b7b7b7';"><a href="#06" class="menu">Leverage</a></td>
				</tr>
			</table>
		</td>
		<td width="70%" valign="top">

<table width="95%" border="0" align="center" cellpadding="10" cellspacing="1"><tr><td valign="top">

<a name="01"></a>
<div class="headdata">Effective Gearing</div>
<hr size="2" color="#999999" />

<p>เป็นเครื่องมือในการวัดความเสี่ยงด้านราคา DW (Effective Gearing ของ DW 4 เท่า แปลว่า ถ้าราคาหุ้นอ้างอิงเปลี่ยนไป 1% ราคา DW จะเปลี่ยนแปลงประมาณ 4% ทั้งนี้ Effective Gearing ที่สูงทําให้นักลงทุนสามารถได้รับกําไร/ขาดทุนในปริมาณที่สูงเทียบกับเงินลงทุน</p>
<p><strong>ตัวอย่าง</strong> เช่น Put Warrant ที่มีอัตราทดจริง 4 เท่า หมายความว่า ราคา Put Warrant จะเปลี่ยนไปประมาณ 4% หากราคาหุ้นอ้างอิงเปลี่ยนไป 1% </p>

<a name="02"></a>
<div class="headdata">Time Decay</div>
<hr size="2" color="#999999" />

<p>คือค่าที่บอกว่าเมื่อเวลาผ่านไป 1 วัน ราคา DW จะลดลงกี่เปอร์เซนต์ (เมื่อกําหนดตัวแปรอื่นคงที่ เช่น ราคาหุ้นอ้างอิง) ดังนั้น นักลงทุนที่ชอบถือ DW เป็นระยะเวลานานๆ ควรหลีกเลี่ยงการถือครอง DW ที่มีค่า Time Decay สูง </p>
<p><strong>ตัวอย่าง</strong> เช่น 1-Day Time Decay เท่ากับ 0.02 บาท หมายความว่า เมื่อเวลาผ่านไป 1 วัน โดยปัจจัยแวดล้อมอื่นคงที่ ราคา DW ควรจะลดลงเท่ากับ 0.02 บาท</p>

<a name="03"></a>
<div class="headdata">Implied Volatility</div>
<hr size="2" color="#999999" />

<p>นักลงทุนควรเปรียบเทียบ Implied Volatility ของ DW ที่เลือกไว้กับ DW ของผู้ออกรายอื่น ที่มีหุ้นอ้างอิงเหมือนกัน โดย DW ที่มี Implied Volatility ตํ่ากว่าอีกตัว หมายความว่า DW ตัวนั้นถูกกว่า นอกจากนี้ควรเลือกซื้อ DW ที่ค่า IV  ในอดีตไม่ผันผวนมากนัก เนื่องจากค่า IV ที่ไม่ผันผวนจะส่งผลให้ราคาของ DW เคลื่อนไหวสอดคล้องกับราคาหุ้นอ้างอิงตามที่ควรจะเป็น</p>

<a name="04"></a>
<div class="headdata">All-in Premium (% Premium)</div>
<hr size="2" color="#999999" />

<p>เป็นค่าที่บอกให้นักลงทุนทราบว่าการซื้อ DW และแปลงสภาพเป็นหุ้นอ้างอิงทันที แพงกว่าการซื้อหุ้นอ้างอิงโดยตรงเท่าใด เพราะการลงทุนใน DW นั้นต้องคํานึงถึงต้นทุนที่ได้มาว่าถูกหรือแพงอย่างไร เพื่อนักลงทุนจะได้สามารถประเมินโอกาสในการทํากําไรได้ ทั้งนี้ All-in-premium ใช้หลักการในการพิจารณาเช่นเดียวกับความผันผวนแฝง แต่ให้นักลงทุนเปรียบเทียบระหว่าง DW บนหุ้นอ้างอิงตัวเดียวกันที่มีอายุคงเหลือใกล้เคียงกันเท่านั้น เนื่องจาก DW ที่มีอายุคงเหลือมากกว่ามีแนวโน้มที่ All-in-premium จะสูงกว่า</p>
<p><strong>ตัวอย่าง</strong> เช่น DTAC24C1712A (Call Warrant ที่อ้างอิงกับหุ้น DTAC) มี % Premium เท่ากับ 10% หมายความว่า ราคาหุ้น DTAC ณ วันครบกำหนดอายุต้องขึ้นอีกอย่างน้อย 10% จากราคาปัจจุบัน ผู้ถือ DTAC24C1712A จึงจะได้กำไร</p>
<a name="05"></a>
<div class="headdata">Intrinsic Value</div>
<hr size="2" color="#999999" />

<p>มูลค่าของ DW โดยสมมติว่าทำการใช้สิทธิที่ราคาหลักทรัพย์ปัจจุบัน โดย Intrinsic value ของ DW มีค่ามากกว่า 0 ถ้า DW มีสถานะเป็น In-the-money (ITM) และ มีค่าเป็น 0 ถ้า DW มีสถานะเป็น Out-of-the-money (OTM) หรือ At-the-money (ATM)</p>

<a name="06"></a>
<div class="headdata">Delta</div>
<hr size="2" color="#999999" />

<p>เป็นเครื่องมือที่บอกให้นักลงทุนทราบถึงความอ่อนไหวของราคา DW เทียบกับการเปลี่ยนแปลงของราคาหุ้นอ้างอิง โดยถ้าราคาหุ้นอ้างอิงเปลี่ยนไป 1 หน่วย ราคา DW จะเปลี่ยนไปเท่าไร โดยราคา Call DW จะเปลี่ยนแปลงในทิศทางเดียวกับราคาหุ้นอ้างอิง ยิ่งราคาหุ้นอ้างอิงเพิ่มสูงขึ้น มูลค่าของ Call DW ก็จะเพิ่มสูงขึ้นตามไปด้วย ในทางกลับกันราคา Put DW จะเปลี่ยนแปลงในทิศทางตรงกันข้ามราคาหุ้นอ้างอิง ยิ่งราคาหุ้นอ้างอิงลดต่ำลง มูลค่าของ Put DW ก็จะยิ่งเพิ่มสูงขึ้น</p>

<center><img src="<?=base_url() ?>assets/images/vac-01.jpg" width="160" height="53" alt="" /></center>

<p><strong>ตัวอย่าง</strong> เช่น Call DW บนหุ้นอ้างอิง DTAC มีราคาใช้สิทธิ 50 บาท อัตราใช้สิทธิ 20 : 1 หากมีค่า Delta เท่ากับ 70% หมายความว่า เมื่อราคา DTAC เพิ่มขึ้น 1 บาท จะทำให้ Call DW บนหุ้น DTAC เพิ่มขึ้นประมาณ  0.035 บาท (คำนวนโดยใช้ เดลต้า/อัตราใช้สิทธิ) </p>

<a name="07"></a>
<div class="headdata">Leverage</div>
<hr size="2" color="#999999" />

<p>การที่นักลงทุนใช้เงินลงทุนน้อย แต่มีโอกาสที่จะได้กำไรหรือขาดทุนมากเมื่อเทียบกับเงินที่ลงทุนไปนั้น เช่น การลงทุนซื้อ DW จะมีการจ่ายเงินแค่ประมาณ 10-15% ของมูลค่าหุ้นอ้างอิงที่ลงทุน จึงเท่ากับเป็นการเพิ่มอัตราผลตอบแทนให้มากขึ้น ส่งผลให้นักลงทุนสามารถใช้เงินลงทุนเพียงเล็กน้อยไปลงทุนในหุ้นอ้างอิงที่มีมูลค่ามากได้</p>
</td></tr></table>

		
		</td>
	</tr>
</table>
</div>
</div>
</div>