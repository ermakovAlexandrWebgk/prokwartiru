<?

    namespace Webgk\Main\Xml;
    use Webgk\Main\Tools;
    use Webgk\Main\Import;
    use Webgk\Main\Hlblock\Prototype as HlblockPrototype;
    use Webgk\Main\Logger;

    /**
    * класс для импорта xml
    */
    class parser {

        const DEFAULT_IMPORT_FOLDER = "/upload/1c_catalog/"; //папка для импортируемых xml файлов по умолчанию
        const DEFAULT_SITE_ID = "s1"; //идентификатор сайта по умолчанию
        const DEFAULT_OUT_FILE_ACTION = "N"; //что делать с элементами, которых нет в выгрузке (N - ничего)
        const IBLOCK_TYPE_ID = "catalog_1c"; //тип инфоблока по умолчанию    
        const HL_BLOCK_PROCESSING_ID = "FileProcessing";   
        const XML_FORMAT = ".xml"; 
        const IMPORT_INTERVAL = 0;


        /**
        * функция для проверки наличия файлов импорта
        */
        function checkImportFiles() {
            $result = Tools::scanFileDir(self::DEFAULT_IMPORT_FOLDER);
            return $result;
        }


        /**
        * функция для проверки текущих процессов импорта
        * 
        */
        function checkCurrentImport() {

            $result = false;

            //получаем текущие файлы, которые обрабатываются
            $filesProcessingHl = HlblockPrototype::getInstance(self::HL_BLOCK_PROCESSING_ID); 
            $resultData = $filesProcessingHl->getElements(array(
                "select" => array("*"),
                "filter" => array(),
                "cacheTime" => 0
            )); 

            if (!empty($resultData)) {                    
                foreach ($resultData as $file) {
                    //если обрабатывается хотя бы один файл из папки xml - заканчиваем проверку
                    if (substr_count($file["UF_FILE_PATH"], self::DEFAULT_IMPORT_FOLDER)) {
                        $result = true;   
                        break;
                    }    
                }
            }
            return $result;  
        }


        /**
        * функция для получения следующего файла для импотра
        * 
        */
        function getNextXmlFile() {

            $result = false;

            //проверяем наличие файлов импорта
            $files = self::checkImportFiles();
            if (!empty($files)) {
                foreach ($files as $file) {
                    //если файл - xml
                    if (substr($file["PATH"], -4) == self::XML_FORMAT) {
                        $result = $file["NAME"]; 
                        break;   
                    }
                }
            }           

            return $result;
        }

        /**
        * импорт xml файла
        * 
        * @param mixed $file
        */
        function importFile($file) {                

            global $DB;
            $result = array();
            $result["update"] = 0; //обновлено
            $result["add"] = 0; //добавлено
            $result["checked"] = 0; //обработано всего
            $result["count_errors"] = 0;

            $start_time = time();

            if (empty($file) || !\CModule::IncludeModule("iblock")) {
                $result["error"] .= "Файл не найден; \n";
                $result["count_errors"]++;
                return $result;
            }   

            $fullFilePath = self::DEFAULT_IMPORT_FOLDER . $file; //полный путь до файла                 

            //проверяем, не обрабатывается ли файл в данный момент
            if (Import::checkFileProcessing($fullFilePath)) {
                $result["error"] .= "Файл уже обрабатывается; \n";
                $result["count_errors"]++;
                return $result;
            } else {
                Import::addFileProcessing($fullFilePath); 
            } 

            //////////ОБРАБОТКА ФАЙЛА////////// 
            //код взят из файла /bitrix/modules/iblock/admin/iblock_xml_import.php      
            
            
            $arParams = array(
                "USE_CRC" => \COption::GetOptionString("catalog", "1C_USE_CRC", "Y"),
                "PREVIEW" => true,
                "DETAIL" => true,
                "USE_OFFERS" => \COption::GetOptionString("catalog", "1C_USE_OFFERS", "N"),
                "FORCE_OFFERS" => \COption::GetOptionString("catalog", "1C_USE_OFFERS", "N"), 
                "USE_IBLOCK_TYPE_ID" => \COption::GetOptionString("catalog", "1C_USE_IBLOCK_TYPE_ID", "N"),  
                "TRANSLIT_ON_ADD" => \COption::GetOptionString("catalog", "1C_TRANSLIT_ON_ADD", "Y"),
                "TRANSLIT_ON_UPDATE" => \COption::GetOptionString("catalog", "1C_TRANSLIT_ON_UPDATE", "Y"),  
                "SKIP_ROOT_SECTION" => \COption::GetOptionString("catalog", "1C_SKIP_ROOT_SECTION", "N"),
                "DISABLE_CHANGE_PRICE_NAME" => \COption::GetOptionString("catalog", "1C_DISABLE_CHANGE_PRICE_NAME")
            );

            if (isset($arParams["TRANSLIT_REPLACE_CHAR"]) && strlen($arParams["TRANSLIT_REPLACE_CHAR"]) > 0)
                $replaceChar = substr($arParams["TRANSLIT_REPLACE_CHAR"], 0, 1);
            else
                $replaceChar = '_';

            $arParams["TRANSLIT_MAX_LEN"] = intval($arParams["TRANSLIT_MAX_LEN"]);
            if ($arParams["TRANSLIT_MAX_LEN"] <= 0)
                $arParams["TRANSLIT_MAX_LEN"] = 100;
            if (!array_key_exists("TRANSLIT_CHANGE_CASE", $arParams))
                $arParams["TRANSLIT_CHANGE_CASE"] = 'L'; // 'L' - toLower, 'U' - toUpper, false - do not change
            if (!array_key_exists("TRANSLIT_REPLACE_SPACE", $arParams))
                $arParams["TRANSLIT_REPLACE_SPACE"] = $replaceChar;
            if (!array_key_exists("TRANSLIT_REPLACE_OTHER", $arParams))
                $arParams["TRANSLIT_REPLACE_OTHER"] = $replaceChar;
            $arParams["TRANSLIT_DELETE_REPEAT_REPLACE"] = $arParams["TRANSLIT_DELETE_REPEAT_REPLACE"] !== "N";

            $arTranslitParams = array(
                "max_len" => $arParams["TRANSLIT_MAX_LEN"],
                "change_case" => $arParams["TRANSLIT_CHANGE_CASE"],
                "replace_space" => $arParams["TRANSLIT_REPLACE_SPACE"],
                "replace_other" => $arParams["TRANSLIT_REPLACE_OTHER"],
                "delete_repeat_replace" => $arParams["TRANSLIT_DELETE_REPEAT_REPLACE"],
            );
            

            $NS = array(
                "STEP" => 0,
                "IBLOCK_TYPE" => self::IBLOCK_TYPE_ID, //тип инфоблока
                "LID" => self::DEFAULT_SITE_ID,
                "URL_DATA_FILE" => $fullFilePath,
                "ACTION" => self::DEFAULT_OUT_FILE_ACTION,
                "PREVIEW" => true, //
            );

            $ABS_FILE_NAME = $_SERVER["DOCUMENT_ROOT"] . $fullFilePath;
            $WORK_DIR_NAME = substr($ABS_FILE_NAME, 0, strrpos($ABS_FILE_NAME, "/")+1);

            $obXMLFile = new \CIBlockXMLFile;             

            //шаг 1 //проверка файла
            $_SESSION["BX_CML2_IMPORT"] = array(
                "SECTION_MAP" => false,
                "PRICES_MAP" => false,
            );

            \CIBlockXMLFile::DropTemporaryTables();
            if(\CIBlockCMLImport::CheckIfFileIsCML($ABS_FILE_NAME)) {
                $NS["STEP"]++;
            } else {
                $arErrors[] = "IBLOCK_CML2_WRONG_FILE_ERROR";
            }  

            //шаг 2 //создание временных таблиц
            if ($NS["STEP"] == 1) {
                if(\CIBlockXMLFile::CreateTemporaryTables()) {
                    $NS["STEP"]++;
                } else {
                    $arErrors[] = "IBLOCK_CML2_TABLE_CREATE_ERROR";
                }
            }        

            //шаг 3 //чтение файла во временные таблицы
            if ($NS["STEP"] == 2) {
                if(file_exists($ABS_FILE_NAME) && is_file($ABS_FILE_NAME) && ($fp = fopen($ABS_FILE_NAME, "rb"))) {
                    if($obXMLFile->ReadXMLToDatabase($fp, $NS, self::IMPORT_INTERVAL)) {
                        $NS["STEP"]++;
                    }
                    fclose($fp);
                } else {
                    $arErrors[] = "IBLOCK_CML2_FILE_ERROR";
                }
            }  


            //шаг 4 //индексация временных таблиц
            if ($NS["STEP"] == 3) {
                if(\CIBlockXMLFile::IndexTemporaryTables()) {
                    $NS["STEP"]++;
                } else {
                    $arErrors[] = "IBLOCK_CML2_INDEX_ERROR";
                }       
            }

            //шаг 5 //импотр разделов
            if ($NS["STEP"] == 4) {
                $obCatalog = new \CIBlockCMLImport;
                $obCatalog->Init($NS, $WORK_DIR_NAME, true, $NS["PREVIEW"], false, true);
                $resultImport = $obCatalog->ImportMetaData(array(1, 2), $NS["IBLOCK_TYPE"], $NS["LID"]);
                if($resultImport === true) {
                    $resultImport = $obCatalog->ImportSections();
                    //деактивация разделов
                    if($resultImport === true) {
                        $obCatalog->DeactivateSections("A");
                    }                    
                }                

                if($resultImport === true) {
                    $NS["STEP"]++;
                } else {
                    $arErrors[] = $resultImport;
                }
            }

            //шаг 6 //импорт элементов
            if ($NS["STEP"] == 5) {
                if(($NS["DONE"]["ALL"] <= 0) && $NS["XML_ELEMENTS_PARENT"]) {
                    $rs = $DB->Query("select count(*) C from b_xml_tree where PARENT_ID = ".intval($NS["XML_ELEMENTS_PARENT"]));
                    $ar = $rs->Fetch();
                    $NS["DONE"]["ALL"] = $ar["C"];
                }

                $obCatalog = new \CIBlockCMLImport;
                
                $obCatalog->Init($NS, $WORK_DIR_NAME, true, $NS["PREVIEW"], false, true);   
                
                $obCatalog->ReadCatalogData($_SESSION["BX_CML2_IMPORT"]["SECTION_MAP"], $_SESSION["BX_CML2_IMPORT"]["PRICES_MAP"]);
                $resultImport = $obCatalog->ImportElements($start_time, self::IMPORT_INTERVAL);                        

                $counter = 0;
                foreach($resultImport as $key=>$value) {
                    $NS["DONE"][$key] += $value;
                    $counter+=$value;
                }

                $result["add"] = $resultImport["ADD"];
                $result["update"] = $resultImport["UPD"];
                $result["add"] = $resultImport["ADD"];   

                if(!$counter)
                    $NS["STEP"]++;
            }                                                

            //шаг 7 // удаляем файл импорта
            unlink($_SERVER["DOCUMENT_ROOT"] . $fullFilePath); 


            if (!empty($arErrors)) {
                $result["error"] .= implode("; ", $arErrors);
                $result["count_errors"]++;
            }        

            ////////////КОНЕЦ ОБРАБОТКИ/////////////////    

            //удаляем файл из таблицы
            Import::deleteFileProcessing($fullFilePath);   

            return $result;  


        }


        /**
        * функция выполнения импорта
        * 
        */
        function doImportXml() {

            //проверяем, что в данный момент не выполняется импорт
            if (!self::checkCurrentImport()) { 
                //получаем следующий файл для импорта 
                $nextFile = self::getNextXmlFile();

                if ($nextFile) {

                    $logger = new Logger("Logger");
                    $logger->StartLog(__FUNCTION__);

                    //выполняем импорт
                    $result = self::ImportFile($nextFile);
                    $result["file"] = self::DEFAULT_IMPORT_FOLDER . $nextFile;  

                    $logger->count = $result["update"] + $result["add"];
                    $logger->count_errors = $result["count_errors"];

                    $logger->comment .= print_r($result, true);
                    $logger->EndLog();  
                }

            } 

            return "\\Webgk\\Main\\Xml\\Parser::doImportXml();";

        } 

        /**
        * функция для очистки директории импотра. Удаляется папка import_files, если в директории нет xml файлов
        * 
        */
        function clearImportDir() {

            //получаем следующий файл для импорта 
            $nextFile = self::getNextXmlFile(); 

            if (!$nextFile) { //если нет файлов для импорта

                //проверяем наличие папки для картинок
                $dirData = self::checkImportFiles();  

                //если в папке импотрта только директория для картинок
                if (count($dirData) == 1 && $dirData[0]["NAME"] == "import_files") {

                    $logger = new Logger("Logger");
                    $logger->StartLog(__FUNCTION__);

                    $result["dir"] = $dirData[0]["PATH"];                     

                    //сканируем содержимое директории с файлами картинок
                    $dirFiles = Tools::scanFileDir($dirData[0]["FULL_PATH"]); 
                    if (!empty($dirFiles)) {
                        $result["delete"] = 0;
                        //поочередно удаляем все файлы
                        foreach ($dirFiles as $file) {
                            unlink($file["FULL_PATH"]);
                            $result["delete"]++;
                        }
                    }

                    $logger->count = $result["delete"];
                    
                    $logger->comment .= print_r($result, true);
                    $logger->EndLog();    
                }
            }


            return "\\Webgk\\Main\\Xml\\Parser::clearImportDir();";

        }       



}