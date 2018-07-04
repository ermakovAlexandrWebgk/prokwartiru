<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult))
	return;
?>
<? $SECTION_ID=$_REQUEST["SECTION_ID"];?>
<? $FABRIKA_ID=$_REQUEST["FABRIKA_ID"];?>

<?
if($SECTION_ID) {
  $res = CIBlockSection::GetByID($SECTION_ID);
  if($ar_res = $res->GetNext()) $sectionTOP=$ar_res['IBLOCK_SECTION_ID'];
}
?>
<!--?
if($sectionTOP) {
  $resTOP = CIBlockSection::GetByID($sectionTOP);
  if($ar_resTOP = $resTOP->GetNext()) $sectionNAME=$ar_resTOP['NAME'];
}
//else return;
elseif(!$FABRIKA_ID) return;
?-->
<!--?=$SECTION_ID?-->
<!--?=$sectionTOP?-->
<!--? if($sectionTOP) $SECTION_ID=$sectionTOP; else $SECTION_ID=$SECTION_ID; ?-->
<!--? if(!$sectionTOP) $sectionTOP=$SECTION_ID;?-->
<? if(!$sectionTOP&&$FABRIKA_ID) $sectionTOP=$SECTION_ID; elseif(!$sectionTOP&&!$FABRIKA_ID) return;?>

<div class="menu-type">  
<?
if(CModule::IncludeModule("iblock"))
{
   // если $ID не задан или это не число, тогда 
   // $ID будет =0, выбираем корневые разделы
   //$ID = IntVal($_GET['ID']);
   // выберем папки из информационного блока $BID и раздела $ID
   $items = GetIBlockSectionList(9, $sectionTOP, Array("sort"=>"asc"));
   $menu_text="";
   $first=false;
   while($arItem = $items->GetNext())
   {
     $menu_text=$menu_text."<div class='menu-type-item'>"; 
     if($first) $menu_text=$menu_text." &nbsp;<b>.</b> ";
     $menu_text=$menu_text."<a href='/catalog/interiers/?SECTION_ID=".$arItem['ID']."'";
     if(($arItem['ID']==$SECTION_ID)&&(!$FABRIKA_ID)) $menu_text=$menu_text." class='on'"; 
     $menu_text=$menu_text."><nobr>".$arItem['NAME']."</nobr></a></div>";
     $first=true;
   }
   echo $menu_text;
}
?>
</div>