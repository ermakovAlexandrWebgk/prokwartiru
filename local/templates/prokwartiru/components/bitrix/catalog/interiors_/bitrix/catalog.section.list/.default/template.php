<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
  $fabrika=$_REQUEST["FABRIKA_ID"];
  $section=$_REQUEST["SECTION_ID"];
?>

<!-- Заголовок -->
<?
  if($fabrika) $res = CIBlockElement::GetByID($fabrika); 
  else $res = CIBlockElement::GetByID($section);
  if($ar_res = $res->GetNext())  //echo "<h1>".$ar_res['NAME']."</h1>";
?>

  <!--h1><-?=$arResult["SECTION"]["NAME"]?-></h1-->
  <div class="catalogs-interiers">
  <?foreach($arResult["SECTIONS"] as $arSection):?>
    <!--div class="catalogs-interiers-item"-><a href="<-?=$arSection["SECTION_PAGE_URL"]?->"><nobr><-?=$arSection["NAME"]?-></nobr></a> / </div-->
  <?endforeach?>
  </div>