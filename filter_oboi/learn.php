<?php                                           
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?> 
<div style="height: 200px; width: 200px; background-color: red;" id="div">
    <span id="someOneText" class="spanText" style="color:white;border: black;"></span>
</div>




                   
<script type="">
$(window).on("load", function() {
        var string = $("#someOneText").text();
        $("#div").animate({'margin-left':'300px'}, 1000, function(){
        $(this).css({'display':'none'});
        });
});
      

</script>
 
