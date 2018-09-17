<?  
    //обработчики для синхронизации колекций с псевдотоварами коллекций
    //разделы
    AddEventHandler("iblock", "OnAfterIBlockSectionAdd", array("CollectionsHandlers", "checkSectionOnAdd"));
    AddEventHandler("iblock", "OnAfterIBlockSectionUpdate", array("CollectionsHandlers", "checkSectionOnUpdate"));
    AddEventHandler("iblock", "OnBeforeIBlockSectionDelete", array("CollectionsHandlers", "checkSectionOnDelete"));
    //товары
    AddEventHandler("iblock", "OnAfterIblockElementAdd", array("CollectionsHandlers", "checkProduct"));
    AddEventHandler("iblock", "OnAfterIblockElementUpdate", array("CollectionsHandlers", "checkProduct"));
    /**
    * класс для работы с коллекциями
   */
    class CollectionsHandlers {

        /**
        * добавление новой коллекции и связанного товара
        */
        function checkSectionOnAdd(&$arFields) {
            $section = CollectionsHandlers::checkSection($arFields["ID"]);
            //создаем связанный товар для коллекции
            if ($section) {
                CollectionsHandlers::createLinkedItem($section);    
            }                                       
        }

        /**
        * обновление коллекции и связанного товара
        */
        function checkSectionOnUpdate(&$arFields) {
            $section = CollectionsHandlers::checkSection($arFields["ID"]);
            if ($section) {
                //если еще нет связанного товара по каким то причинам, создаем его
                if (!$section["LINKED_ITEM"]["ID"]) {
                    CollectionsHandlers::createLinkedItem($section);    
                } else { //иначе - обновляем
                    CollectionsHandlers::updateLinkedItem($section);
                }

            }
        }

        /**
        * удаление коллекции и связанного товара
        * 
        */
        function checkSectionOnDelete($id) {
            $section = CollectionsHandlers::checkSection($id); 
            //если есть связанный товар - удаляем его тоже
            if ($section["LINKED_ITEM"]["ID"]) {
                CIBlockElement::Delete($section["LINKED_ITEM"]["ID"]);    
            }
        }
        
        
        /**
        * добавление/обновление товара в коллекции
        */
        function checkProduct(&$arFields) {
            $itemData = CIBlockElement::getList(array(), array("ID" => $arFields["ID"]), false, false, array("IBLOCK_SECTION_ID"))->GetNext();
            //тригерим событие обновление раздела-родителя товара, чтобы перенести нужную информацию в псевдотовары
            $arSection = array("ID" => $itemData["IBLOCK_SECTION_ID"]);
            CollectionsHandlers::checkSectionOnUpdate($arSection);    
        }   


        /**
        * проверка информации для текущего раздела, с которым происходит изменение
        */
        function checkSection($id) {
            $result = false;
            $id = intval($id);

            if (empty($id)) {
                return $result;
            }
            
            $select = array("ID", "NAME", "CODE", "SECTION_PAGE_URL", "PICTURE", "ACTIVE");
            //проверяем, на каком уровне текущий раздел и не является ли он разделом "коллекции_"
            $section = CIBlockSection::getList(array(), array("IBLOCK_ID" => WORK_CATALOG_ID, "ID" => $id, "DEPTH_LEVEL" => 3), false, $select)->GetNext();
            if ($section["ID"] && !substr_count($section["CODE"], "collections_")) {
                //получаем ID раздела-родителя верхнего уровня
                $sectionUrlItems = explode("/", $section["SECTION_PAGE_URL"]);                     
                $topParentCode = $sectionUrlItems[2];
                //получаем информамцию о родителе верхнего уровня
                $topParent = CIBlockSection::getList(array(), array("CODE" => $topParentCode, "IBLOCK_ID" => WORK_CATALOG_ID), false, $select)->GetNext();
                $section["TOP_PARENT"] = $topParent;

                //получаем информацию о разделе "коллекции" внутри родителя верхнего уровня
                $collectionsSection = CIBlockSection::getList(array(), array("CODE" => "collections_" . $topParentCode, "IBLOCK_ID" => WORK_CATALOG_ID), false, $select)->GetNext();
                $section["COLLECTIONS"] = $collectionsSection;

                //связанный псевдотовар
                $itemSelect = array("ID", "NAME", "CODE", "PROPERTY_FABRIKA", "PROPERTY_COUNTRY");
                $linkedItem = CIBLockElement::GetList(array(), array("IBLOCK_ID" => WORK_CATALOG_ID, "SECTION_ID" => $section["COLLECTIONS"], "XML_ID" => $section["ID"]), false, false, $itemSelect)->GetNext();
                $section["LINKED_ITEM"] = $linkedItem; 
                
                $result = $section;                      
            }
            
            return $result;
        }
        
        /**
        * создание связанного псевдотовара
        * 
        * @param mixed $arSection
        */
        private function createLinkedItem($arSection) { 
            if (empty($arSection)) {
                return false;
            }    
            
            //проверяем дочерние элементы раздела, чтобы получить из них значения свойств "страна" и "бренд"
            $childItemsSelect = array("ID", "PROPERTY_BRAND", "PROPERTY_COUNTRY");
            $childItems = CIBlockElement::GetList(array(), array("SECTION_ID" => $arSection["ID"], "!PROPERTY_BRAND" => false, "!PROPERTY_COUNTRY" => false, "ACTIVE" => array("Y", "N")), false, array("nTopCount" => 1), $childItemsSelect)->GetNext();
                        
            if ($arSection["COLLECTIONS"]["ID"]) {
                $el = new CIBlockElement;

                $PROP = array();
                $PROP["COLLECTION_URL"] = $arSection["SECTION_PAGE_URL"];
                
                if ($childItems["PROPERTY_BRAND_ENUM_ID"] && $childItems["PROPERTY_COUNTRY_ENUM_ID"]) {
                    $PROP["BRAND"] = $childItems["PROPERTY_BRAND_ENUM_ID"];    
                    $PROP["COUNTRY"] = $childItems["PROPERTY_COUNTRY_ENUM_ID"];    
                }
              
                $arLoadProductArray = Array(
                    "IBLOCK_SECTION_ID" => $arSection["COLLECTIONS"]["ID"],          // элемент лежит в корне раздела
                    "IBLOCK_ID"      => WORK_CATALOG_ID,
                    "PROPERTY_VALUES"=> $PROP,
                    "NAME"           => $arSection["NAME"],
                    "ACTIVE"         => "N",            // активен
                    "PREVIEW_PICTURE" => CFile::MakeFileArray($arSection["PICTURE"]),
                    "DETAIL_PICTURE" => CFile::MakeFileArray($arSection["PICTURE"]),
                    "XML_ID" => $arSection["ID"],
                    "CODE" => $arSection["CODE"] . rand(0, 9)
                );                      
            
                //добавляем связанный товар
                $el->Add($arLoadProductArray);
            }
            
        }
        
        
        /**
        * обновление связанного псевдотовара
        * 
        * @param mixed $arSection
        */
        private function updateLinkedItem($arSection) {
            if (empty($arSection) || empty($arSection["LINKED_ITEM"]["ID"])) {
                return false;
            }    
            
            //проверяем дочерние элементы раздела, чтобы получить из них значения свойств "страна" и "бренд"
            $childItemsSelect = array("ID", "PROPERTY_BRAND", "PROPERTY_COUNTRY");
            $childItems = CIBlockElement::GetList(array(), array("SECTION_ID" => $arSection["ID"], "!PROPERTY_BRAND" => false, "!PROPERTY_COUNTRY" => false, "ACTIVE" => array("Y", "N")), false, array("nTopCount" => 1), $childItemsSelect)->GetNext();
                        
            if ($arSection["COLLECTIONS"]["ID"]) {
                $el = new CIBlockElement;

                $PROP = array();
                $PROP["COLLECTION_URL"] = $arSection["SECTION_PAGE_URL"];
                
                if ($childItems["PROPERTY_BRAND_ENUM_ID"] && $childItems["PROPERTY_COUNTRY_ENUM_ID"]) {
                    $PROP["BRAND"] = $childItems["PROPERTY_BRAND_ENUM_ID"];    
                    $PROP["COUNTRY"] = $childItems["PROPERTY_COUNTRY_ENUM_ID"];    
                }
              
                $arLoadProductArray = Array(
                    "PROPERTY_VALUES" => $PROP,
                    "NAME" => $arSection["NAME"],                             
                    "ACTIVE" => $arSection["ACTIVE"],         
                    "PREVIEW_PICTURE" => CFile::MakeFileArray($arSection["PICTURE"]),
                    "DETAIL_PICTURE" => CFile::MakeFileArray($arSection["PICTURE"]),
                );                      
            
                //обновляем связанный товар
                $el->Update($arSection["LINKED_ITEM"]["ID"], $arLoadProductArray);
            }
        }    
        
        
    }