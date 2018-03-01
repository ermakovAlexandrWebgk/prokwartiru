<?
/*Version 0.3 2011-04-25*/

/************** OLD ****************/

// AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "BXIBlockAfterSave");
// AddEventHandler("iblock", "OnAfterIBlockElementAdd", "BXIBlockAfterSave");
// AddEventHandler("catalog", "OnPriceAdd", "BXIBlockAfterSave");
// AddEventHandler("catalog", "OnPriceUpdate", "BXIBlockAfterSave");
// function BXIBlockAfterSave($arg1, $arg2 = false)
// {
// $ELEMENT_ID = false;
// 	$IBLOCK_ID = false;
// 	$OFFERS_IBLOCK_ID = false;
// 	$OFFERS_PROPERTY_ID = false;
//
// 	//Check for catalog event
// 	if(is_array($arg2) && $arg2["PRODUCT_ID"] > 0)
// 	{
// 		//Get iblock element
// 		$rsPriceElement = CIBlockElement::GetList(
// 			array(),
// 			array(
// 				"ID" => $arg2["PRODUCT_ID"],
// 			),
// 			false,
// 			false,
// 			array("ID", "IBLOCK_ID")
// 		);
// 		if($arPriceElement = $rsPriceElement->Fetch())
// 		{
// 			$arCatalog = CCatalog::GetByID($arPriceElement["IBLOCK_ID"]);
// 			if(is_array($arCatalog))
// 			{
// 				//Check if it is offers iblock
// 				if($arCatalog["OFFERS"] == "Y")
// 				{
// 					//Find product element
// 					$rsElement = CIBlockElement::GetProperty(
// 						$arPriceElement["IBLOCK_ID"],
// 						$arPriceElement["ID"],
// 						"sort",
// 						"asc",
// 						array("ID" => $arCatalog["SKU_PROPERTY_ID"])
// 					);
// 					$arElement = $rsElement->Fetch();
// 					if($arElement && $arElement["VALUE"] > 0)
// 					{
// 						$ELEMENT_ID = $arElement["VALUE"];
// 						$IBLOCK_ID = $arCatalog["PRODUCT_IBLOCK_ID"];
// 						$OFFERS_IBLOCK_ID = $arCatalog["IBLOCK_ID"];
// 						$OFFERS_PROPERTY_ID = $arCatalog["SKU_PROPERTY_ID"];
// 					}
// 				}
// 				//or iblock wich has offers
// 				elseif($arCatalog["OFFERS_IBLOCK_ID"] > 0)
// 				{
// 					$ELEMENT_ID = $arPriceElement["ID"];
// 					$IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
// 					$OFFERS_IBLOCK_ID = $arCatalog["OFFERS_IBLOCK_ID"];
// 					$OFFERS_PROPERTY_ID = $arCatalog["OFFERS_PROPERTY_ID"];
// 				}
// 				//or it's regular catalog
// 				else
// 				{
// 					$ELEMENT_ID = $arPriceElement["ID"];
// 					$IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
// 					$OFFERS_IBLOCK_ID = false;
// 					$OFFERS_PROPERTY_ID = false;
// 				}
// 			}
// 		}
// 	}
// 	//Check for iblock event
// 	elseif(is_array($arg1) && $arg1["ID"] > 0 && $arg1["IBLOCK_ID"] > 0)
// 	{
// 		//Check if iblock has offers
// 		$arOffers = CIBlockPriceTools::GetOffersIBlock($arg1["IBLOCK_ID"]);
// 		if(is_array($arOffers))
// 		{
// 			$ELEMENT_ID = $arg1["ID"];
// 			$IBLOCK_ID = $arg1["IBLOCK_ID"];
// 			$OFFERS_IBLOCK_ID = $arOffers["OFFERS_IBLOCK_ID"];
// 			$OFFERS_PROPERTY_ID = $arOffers["OFFERS_PROPERTY_ID"];
// 		}
// 	}
//
// 	if($ELEMENT_ID)
// 	{
// 		static $arPropCache = array();
// 		if(!array_key_exists($IBLOCK_ID, $arPropCache))
// 		{
// 			//Check for MINIMAL_PRICE property
// 			$rsProperty = CIBlockProperty::GetByID("MINIMUM_PRICE", $IBLOCK_ID);
// 			$arProperty = $rsProperty->Fetch();
// 			if($arProperty)
// 				$arPropCache[$IBLOCK_ID] = $arProperty["ID"];
// 			else
// 				$arPropCache[$IBLOCK_ID] = false;
// 		}
//
// 		if($arPropCache[$IBLOCK_ID])
// 		{
// 			//Compose elements filter
// 			$arProductID = array($ELEMENT_ID);
// 			if($OFFERS_IBLOCK_ID)
// 			{
// 				$rsOffers = CIBlockElement::GetList(
// 					array(),
// 					array(
// 						"IBLOCK_ID" => $OFFERS_IBLOCK_ID,
// 						"PROPERTY_".$OFFERS_PROPERTY_ID => $ELEMENT_ID,
// 					),
// 					false,
// 					false,
// 					array("ID")
// 				);
// 				while($arOffer = $rsOffers->Fetch())
// 					$arProductID[] = $arOffer["ID"];
// 			}
//
// 			$minPrice = false;
// 			$maxPrice = false;
// 			//Get prices
// 			$rsPrices = CPrice::GetList(
// 				array(),
// 				array(
// 					"BASE" => "Y",
// 					"PRODUCT_ID" => $arProductID,
// 				)
// 			);
// 			while($arPrice = $rsPrices->Fetch())
// 			{
// 				$PRICE = $arPrice["PRICE"];
//
// 				if($minPrice === false || $minPrice > $PRICE)
// 					$minPrice = $PRICE;
//
// 				if($maxPrice === false || $maxPrice < $PRICE)
// 					$maxPrice = $PRICE;
// 			}
//
// 			//Save found minimal price into property
// 			if($minPrice !== false)
// 			{
// 				CIBlockElement::SetPropertyValuesEx(
// 					$ELEMENT_ID,
// 					$IBLOCK_ID,
// 					array(
// 						"MINIMUM_PRICE" => $minPrice,
// 						"MAXIMUM_PRICE" => $maxPrice,
// 					)
// 				);
// 			}
// 		}
// 	}
// }
?>
<?
// Добавление пункта меню в административную панель ambu
// AddEventHandler("main", "OnBuildGlobalMenu", "OnBuildGlobalMenuH");
//
// function OnBuildGlobalMenuH(&$aGlobalMenu, &$aModuleMenu)
// {
//     foreach ($aModuleMenu as $key => $arMenu)
//     {
//      if ($arMenu["parent_menu"] == "global_menu_store")
//      {
//       $aModuleMenu[] = array(
//           "parent_menu" => "global_menu_store",
//           "section" => "panel_admin",
//           "sort" => 1000,  // Сортировка
//           "text" => "Переоценка",  //Название пункта меню
//           "title" => "Переоценка в соответствии с курсом евро",  // Всплывающая подсказка
//           "icon" => "statistic_icon_sites",
//           "page_icon" => "statistic_page_sites",
//           "items_id" => "panel_admin_id",
//           "url" => "/bitrix/admin/price_index.php?lang=ru", //Путь к странице
//           );
// //      $aModuleMenu[] = array(
// //          "parent_menu" => "global_menu_store",
// //          "section" => "panel_admin",
// //          "sort" => 1100,  // Сортировка
// //          "text" => "Выгрузка в Яндекс",  //Название пункта меню
// //          "title" => "Выгрузка каталога на Яндекс Маркет",  // Всплывающая подсказка
// //          "icon" => "statistic_icon_sites",
// //          "page_icon" => "statistic_page_sites",
// //          "items_id" => "panel_admin_id",
// //          "url" => "/bitrix/admin/yandex_index.php?lang=ru", //Путь к странице
// //          );
//       break;
//      }
//
//     }
// }

/************** NEW ****************/

AddEventHandler("currency", "CurrencyFormat", "myFormat");
function myFormat($fSum, $strCurrency)
{
	if ($strCurrency == "RUB") {
		return number_format ( $fSum, 0, '.', ' ' ).' р';
	}
}

function arshow($array, $adminCheck = true){
    global $USER;
    $USER = new Cuser;
    if ($adminCheck) {
        if (!$USER->IsAdmin()) {
            return false;
        }
    }
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}

//Выборка чпу-ссылок из модуля sotbit seo по id раздела
function GetSeoLinks($sectionId)
{
    GLOBAL $DB;
    $arSeoLinks = array();
    $dbResult = $DB->Query("SELECT * FROM `b_sotbit_seometa_chpu` WHERE `ACTIVE` = 'Y' AND `section_id`=".intval($sectionId));
    while ($row = $dbResult->Fetch())
    {
        $row["PROPERTIES"] = unserialize($row["PROPERTIES"]);
        $dbSubResults = $DB->Query("SELECT `NAME` FROM `b_sotbit_seometa` WHERE `ID`=".$row["CONDITION_ID"])->Fetch();
        $row["CONDITION"] = $dbSubResults["NAME"];
        $arSeoLinks[] = $row;
    }
    return $arSeoLinks;
}
/*

$arSeoLn = GetSeoLinks($arResult["VARIABLES"]["SECTION_ID"]);

foreach($arSeoLn as $seoLn)
{
	$arSeoLinks[$seoLn["NAME"]] = $seoLn["NEW_URL"];

	// if(strpos($seoLn["CONDITION"], "/привязка") !== FALSE && $seoLn["REAL_URL"] == $APPLICATION->GetCurPage(false))
	// {
	// 	$arSeoLinks = false;
	// 	break;
	// }
	// if(strpos($seoLn["CONDITION"], "/бренд") !== FALSE && $seoLn["REAL_URL"] == $APPLICATION->GetCurPage(false))
	// {
	// 	$vendor = $seoLn["NEW_URL"];
	// 	$vendor_code = Cutil::translit($seoLn["PROPERTIES"]["PROIZVODITEL"][0], "ru");
	// 	$arSeoLinks = false;
	// 	break;
	// }
	// if(strpos($seoLn["CONDITION"], "/верх") !== FALSE && $seoLn["REAL_URL"] != $APPLICATION->GetCurPage(false))
	// {
	// 	$arSeoLinks[$seoLn["NAME"]] = $seoLn["NEW_URL"];
	// }
}
?>

<div class="often_seek">
<span>Часто ищут:</span>
<?foreach($arSeoLinks as $name => $link):?>
<a href="<?=$link?>"><?=$name?></a>
<?endforeach?>
</div>

*/
?>
