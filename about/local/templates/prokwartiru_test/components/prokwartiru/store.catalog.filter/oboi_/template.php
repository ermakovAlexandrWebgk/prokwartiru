<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="filter">
<?
/*******************************************
       �������������� ����������
*******************************************/
// ��������� ������
CModule::IncludeModule("form");

//$RESULT_ID = 12; // ID ����������

// ���� ���� ������ ������ "���������" ��
if (strlen($_REQUEST["filter"])>0)
{
    // ���������� ������ ��������� � �����
    $arrVALUES = $_REQUEST; 
}
else
{
    // ���������� ���� ������ �� ������ �� ����������
    $arrVALUES = CFormResult::GetDataByIDForHTML($RESULT_ID); 
}
?>

<form action="" method="get">
<?
foreach($arResult["ITEMS"] as $arItem)
	if(array_key_exists("HIDDEN", $arItem))
		echo $arItem["INPUT"];
?>
<table>
    <tr>
        <td>��������� �� ����:&nbsp;</td>
        <td><!--?

            // ���������� ������������� �������
            $QUESTION_SID = "PRICE"; 

            // ������ ����������� �������� ����������� ������
            $arDropDown = array (

                "reference" => array (
                        "���",
                        "�� 1000 ���",
                        "1000-1499 ���",
                        "1500-1999 ���",
                        "2000-2999 ���",
                        "����� 3000 ���"
                    ),

                "reference_id" => array (
                        "",
                        "6",
                        "7",
                        "8",
                        "9",
                        "10"
                    ),

                "param" => array (
                        //"not_answer class=\"inputselect\"", // �� �������� �������
                        "checked", // �������� �� ���������
                        "",
                        "",
                        "",
                        "",
                        ""
                    )
            );

            // ������� ������� �������� ����������� ������
            $value = CForm::GetDropDownValue($QUESTION_SID, $arDropDown, $arrVALUES);

            // ������� ���������� ������
            //echo CForm::GetDropDownField(
            //    $QUESTION_SID,           // ���������� ������������� �������
            //    $arDropDown,             // ������ ����������� �������� ������
            //    $value,                  // �������� ���������� �������� ������
            //    "class=\"inputselect\""  // ����� ����������� ������
            //    );            
            ?-->
            <?$PRICE_ID=$_REQUEST['PRICE_ID'];?>
            <select onchange="javascript:document.location=document.location.href+'&PRICE_ID='+this.options[this.selectedIndex].value">
              <option value="" <?if($PRICE_ID==""):?>selected<?endif?> >���</option>
              <option value="6" <?if($PRICE_ID=="6"):?>selected<?endif?> >�� 1000 ���</option>
              <option value="7" <?if($PRICE_ID=="7"):?>selected<?endif?> >1000-1499 ���</option>
              <option value="8" <?if($PRICE_ID=="8"):?>selected<?endif?> >1500-1999 ���</option>
              <option value="9" <?if($PRICE_ID=="9"):?>selected<?endif?> >2000-2999 ���</option>
              <option value="10" <?if($PRICE_ID=="10"):?>selected<?endif?> >����� 3000 ���</option>
            </select>
        </td>
        <!--td><input type="submit" name="filter" value="�����" style="background-color: #8e8b86; color: white; border: 0px; height: 22px; padding: 0 3px;"></td-->
    </tr>
</table>
</form>
</div>
<!--? $arFilterDopt=Array('UF_PRICE' => "6");?-->
