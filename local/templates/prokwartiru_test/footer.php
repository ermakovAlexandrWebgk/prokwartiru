</div><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
                </div> <!-- text close -->
            </div> <!-- content-inner close -->
            <div id="sidebar">
                <ul class="sidebar-menu">
                <!--ul class="right-menu"-->
                    <li><a class="basket" href="/personal/cart/" title="">Ваша корзина</a></li>
                    <li><a class="contacts" href="/about/contacts/" title="">Как нас найти</a></li>
                    <li><a class="dostavka" href="/about/delivery/" title="">Доставка<br />и самовывоз</a></li>
                    <li><a class="skidki" href="/about/discounts/" title="">Акции и скидки</a></li>
                    <li><a class="payment" href="/about/payment/" title="">Оплата<br />и возврат</a></li>
                    <!--li><a class="bloknot" href="/catalog/compare.php" title="">Ваш блокнот</a></li-->
                    <!--li><a class="vopros" href="/about/ask_a_question/" title="">Задать вопрос</a></li-->
                    <!--li><a class="reg" href="/login/?backurl=%2Flogin%2F" title="">Регистрация</a></li-->
                    <!--li><a class="reg" href="/personal/" title="">Личный кабинет</a></li-->
                </ul>
                <div class="chat" style="text-align: right;">
<!-- mibew button -->
 <a href="/mibew/client.php?locale=ru&amp;style=original" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('http://prokwarti.ru/mibew/client.php?locale=ru&amp;style=original&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" ><img src="http://prokwarti.ru/mibew/b.php?i=mgreen&amp;lang=ru" border="0" width="169" height="126"  /></a> 
<!-- / mibew button -->
<!-- webim button --><!--a href="http://prokwarti.ru/webim/client.php?locale=ru&amp;style=original" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('http://prokwarti.ru/webim/client.php?locale=ru&amp;style=original&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><img src="http://prokwarti.ru/webim/b.php?i=mgreen&amp;lang=ru" border="0" width="169" alt=""/></a--><!-- / webim button -->
                </div>
                <div id="telephone">Звоните по телефону:<br /><b style="font-size: 16px;">+7 (985) 155-17-55</b><br />(многоканальный)<br /><br />или закажите<br/><a href="/about/telephone/">обратный звонок</a><br /><br /><a href="/about/telephone/" id="telephone"><img src="<?=SITE_TEMPLATE_PATH?>/images/telephone.png"></a></div><br />
                <!--ul class="right-menu">
                    <li><a class="otzyvy" href="/about/otzyvy/" title="">Отзывы</a></li>
                    <li><a class="advices" href="/advices/" title="">Полезные советы</a></li>
                    <li><a class="interiers" href="/catalog/interiers/" title="">Интерьеры</a></li>
                </ul-->
                <!--p style="margin: 20px 0; text-align:center;"><a href="http://vk.com/prokwartiru" target="_blank" ><img src="/bitrix/templates/prokwartiru_test/images/vk.png" border="0" width="130" height="26"/></a></p-->
            </div> <!-- sidebar close -->
        </div> <!-- content close -->
    </div> <!-- wrapper close -->
    <div class="clr"></div>
    <div id="footer-outer">
    	<table id="footer_adv">
         <tr>
          <td class="item"><a href="/about/contacts/">Всё в одном месте: обои, плитка, свет, лепнина</a></td>
          <td class="item"><a href="/about/contacts/">Шоу-рум с образцами</a></td>
          <td class="item"><a href="/about/contacts/">Бесплатная консультация</a></td>
          <td class="item"><a href="/about/contacts/">Точный расчет</a></td>
          <td class="item"><a href="/about/discounts/">Скидки <nobr>от объема</nobr></a></td>
          <td class="item"><a href="/about/contacts/">Гарантия подлинности</a></td>
          <td class="item"><a href="/about/delivery/">Быстрая доставка</a></td>
          <td class="item"><a href="/about/contacts/">Возможность покупки от 1&nbsp;рулона или 1&nbsp;метра</a></td>
          <td class="item"><a href="/about/contacts/">Удобный возврат</a></td>
          <td class="item" style="border:none;"><a href="/catalog/plitka/3d-project.php">Подарок от нас: дизайн-проект 3Д по плитке</a></td>
         </tr>
    	</table>
    	<div id="footer">
		<div class="copyright">Интернет-магазин современного интерьера &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Тел.: +7 (985) 155-17-55 (многоканальный) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="mailto:info@prokwarti.ru">info@prokwarti.ru</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy; 2011-2016 Все права защищены.</div>
		<div style="clear:both; font-size:11px; color:grey; padding-top:4px;">Данные, представленные на сайте, не являются публичной офертой</div>
        </div> <!-- footer close -->

<!-- Кнопка Наверх -->
<script type="text/javascript"> 
$(function(){$.fn.scrollToTop=function()
{$(this).hide().removeAttr("href");if($(window).scrollTop()!="0")
{$(this).fadeIn("slow")}var scrollDiv=$(this);
$(window).scroll(function(){
if($(window).scrollTop()=="0"){
$(scrollDiv).fadeOut("slow")}else{$(scrollDiv).fadeIn("slow")}
});$(this).click(function(){$("html, body").animate({scrollTop:0},"slow")})}
});
</script>
<script type="text/javascript"> 
$(function() { 
$("#toTop").scrollToTop(); 
}); 
</script>
<p><a href="#" id="toTop" ><img src="<?=SITE_TEMPLATE_PATH?>/images/up.png" border="0" align="absMiddle"/></a></p>
<!-- Конец Кнопки Наверх -->

<div style="text-align: left; padding: 10px 0; width:900px; margin:0 auto;">

<!-- begin of Top100 code -->
<script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?2644709"></script>
<noscript>
<a href="http://top100.rambler.ru/navi/2644709/"><img src="http://counter.rambler.ru/top100.cnt?2644709" alt="Rambler's Top100" border="0" /></a>
</noscript>
<!-- end of Top100 code -->


<!-- Yandex.Metrika informer -->
<a href="http://metrika.yandex.ru/stat/?id=17962606&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/17962606/1_0_FFFFFFFF_EFEFEFFF_0_uniques"
style="width:80px; height:15px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:17962606,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter17962606 = new Ya.Metrika({id:17962606,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/17962606" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- GoogleAnalytics -->
 <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-46149151-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- /GoogleAnalytics -->

</div>
    </div> <!-- wrapper-outer close -->

</body>
</html>
