<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Дизайн-проект ЗD в интернет-магазине prokwarti.ru");
?> 
<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox").fancybox({
				prevEffect : 'none',
				nextEffect : 'none',
				helpers: {
					title : {
						type : 'inside'
					}
				}
			});

		});
	</script>
 	 
<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
 
<script language="JavaScript">
   winW = document.documentElement.clientWidth*0.8;  
   winH = document.documentElement.clientHeight*0.7; 
   //winH = winW*0.7;
   winWpic = winW*0.7;
   winHpic = winH-30;
   winWpic1 = winW;
   winHpic1 = winH-10;
   winWpic2 = winW-300;
   winHpic2 = winH-10;
   winWpic3 = winW-30;
   winHpic3 = winH-215;
   display = "none";
</script>
 
<div id="gift_text"> 
  <div id="gift_text" style="padding-bottom: 2px !important;"> <a href="/catalog/plitka/3d_project/projects.php" ><img src="/catalog/plitka/3d_project/projects.jpg" style="float: right; margin-left: 10px; height: 139px; width:139px;" title="Наши проекты" height="139" width="139"  /></a> 
    <div id="gift"> 
      <p style="text-align: left; padding-left: 70px; font-weight: bold; font-size: 16px;"><span></span>Дизайн-проект 3D по плитке в подарок при покупке.</p>
     </div>
   
    <p style="font-size: 14px; line-height: 18px;">Стоимость данной услуги <b>1500 рублей</b> (развертка по плоскостям 1000 рублей и визуализация 500 рублей). Услуга предоставляется в подарок, если сумма покупки (согласно заказанному дизайн-проекту) составит более 15000 рублей. Дизайн-проект делается на одно помещение и предполагает максимально два варианта раскладки плитки из одной коллекции.</p>
   </div>
 </div>
 
<table cellspacing="0" cellpadding="0" border="0" id="gift_pics"> 
  <tbody> 
    <tr> <td><a class="fancybox" href="/catalog/plitka/3d_project/project1-3.jpg" data-fancybox-group="gift"><img src="/catalog/plitka/3d_project/project1-3.jpg" style="height: 234px;" title="Открыть проект" id="project1-3" height="234"  /></a></td> <td><a class="fancybox" href="/catalog/plitka/3d_project/project1-0.jpg" data-fancybox-group="gift"><img src="/catalog/plitka/3d_project/project1-0.jpg" style="height: 121px;" title="Открыть проект" id="project1-0" height="121"  /></a><a class="fancybox" href="/catalog/plitka/3d_project/project1-2.jpg" data-fancybox-group="gift"><img src="/catalog/plitka/3d_project/project1-2.jpg" style="height: 121px; margin-right: 0px;" title="Открыть проект" id="project1-2" height="121"  /></a> 
        <br />
       <a class="fancybox" href="/catalog/plitka/3d_project/project1-4.jpg" data-fancybox-group="gift"><img src="/catalog/plitka/3d_project/project1-4.jpg" style=height: 102px;" height="102" title="Открыть проект" id="project1-4"  /></a><a class="fancybox" href="/catalog/plitka/3d_project/project1-1.jpg" data-fancybox-group="gift"><img src="/catalog/plitka/3d_project/project1-1.jpg" style="margin-right:0px; height: 102px;" height="102" title="Открыть проект" id="project1-1"  /></a> </td> </tr>
    <tr> <td><a class="fancybox" href="/catalog/plitka/3d_project/project3-2.jpg" data-fancybox-group="gift"><img src="/catalog/plitka/3d_project/project3-2.jpg" style="margin-bottom: 0px;  width: 362px;" width="362" title="Открыть проект" id="project3-2"  /></a></td><td><a class="fancybox" href="/catalog/plitka/3d_project/project3-0.jpg" data-fancybox-group="gift"><img src="/catalog/plitka/3d_project/project3-0.jpg" style="height: 101px; width: 156px;" height="101" title="Открыть проект" id="project3-0"  /></a><a class="fancybox" href="/catalog/plitka/3d_project/project3-4.jpg" data-fancybox-group="gift"><img src="/catalog/plitka/3d_project/project3-4.jpg" style="height: 101px; width: 156px; margin-right:0px;" height="101" title="Открыть проект" id="project3-4"  /></a>
        <br />
       <a class="fancybox" href="/catalog/plitka/3d_project/project3-1.jpg" data-fancybox-group="gift"><img src="/catalog/plitka/3d_project/project3-1.jpg" style="margin-bottom:0px; height: 101px; width: 156px;" height="101" title="Открыть проект" id="project3-1"  /></a><a class="fancybox" href="/catalog/plitka/3d_project/project3-3.jpg" data-fancybox-group="gift"><img src="/catalog/plitka/3d_project/project3-3.jpg" style="margin-right:0px; margin-bottom:0px; height: 101px; width: 156px;" height="101" title="Открыть проект" id="project3-3"  /></a> </td> </tr>
   </tbody>
 </table>
 
<div id="gift_text" style="margin-top: 10px;"> 
  <div id="gift_text"> 
    <p style="text-align: center; font-weight: bold; font-size: 16px; padding: 10px 0px 20px;">Как заказать Дизай-проект 3D</p>
   
    <p style="font-size: 14px; line-height: 18px;">1. Выберите понравившуюся коллекцию плитки из <a href="/catalog/plitka/" >ассортимента нашего магазина</a>.</p>
   
    <p style="font-size: 14px; line-height: 18px;">2. Скачайте <a href="/catalog/plitka/3d_project/Заказ на дизайн-проект.docx" target="_blank" ><b>бланк заказа услуги</b></a>.</p>
   
    <p style="font-size: 14px; line-height: 18px;">3. Заполните в бланке все необходимые поля (выделенные цветом).</p>
   
    <p style="font-size: 14px; line-height: 18px;">4. Отправьте заполненный бланк заказа на электронный адрес <a href="mailto:info@prokwarti.ru" ><b>Info@prokwarti.ru</b></a> вместе с планом вашего помещения.</p>
   
    <p style="font-size: 14px; line-height: 18px;">5. Оплатите заказываемую услугу (1500 рублей) наличными в <a href="/about/contacts/" >магазине ПроКвартиРу</a> или через Яндекс-Деньги (по предварительному согласованию).</p>
   
    <p style="font-size: 14px; line-height: 18px;">В течение 1-2 рабочих дней после поступления вашей оплаты, на электронную почту, которую вы укажете в заказе, мы отправим эскиз визуализации вашего помещения. После того, как вы одобрите данную визуализацию, на эту же электронную почту вам будет отправлена развертка по плоскостям (раскладка плитки по стенам и полу).</p>
   
    <br />
   
    <p style="font-size: 14px; line-height: 18px;">Все возникшие у вас вопросы по данной услуге вы можете задать по телефону: 
      <br />
     <b>8-985-155-17-55, 8-985-118-17-55.</b></p>
   </div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>