<?php 

    namespace Webgk\Main;
    use Webgk\Main\Tools;
    use Webgk\Main\Hlblock\Prototype;
    use Webgk\Main\Logger;
    use \Webgk\Main\Iblock\Prototype as IblockPrototype;
    
    class User {

        function isQuestionnaireRecordExist ($userId) {
            $phoneNumber = "";
            $iblockObj = IblockPrototype::getInstanceByCode('questionnaire');
            $questionnaireIblockId = $iblockObj->getId();
            $userInfo = \CUser::GetByID($userId);
            while ($arUser = $userInfo -> Fetch()) {
                $phoneNumber = $arUser["PERSONAL_PHONE"];
            }
            $existedRecord = false;
            if ($phoneNumber) {
                $questionnaireRecords = \CIBlockElement::GetList(array(), array("IBLOCK_ID" => $questionnaireIblockId, "PROPERTY_PHONE_NUMBER" => $phoneNumber), false, false, array("ID", "PROPERTY_PHONE_NUMBER"));
                if ($questionnaireRecords -> SelectedRowsCount() > 0) {
                    $existedRecord = true;
                }    
            }
            return $existedRecord;
        }
}