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
                        "�� 3000 ���",
                        "3000-5000 ���",
                        "5000-10000 ���",
                        "10000-15000 ���",
                        "����� 15000 ���"
                    ),

                "reference_id" => array (
                        "",
                        "1",
                        "2",
                        "3",
                        "4",
                        "5"
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
            echo CForm::GetDropDownField(
                $QUESTION_SID,           // ���������� ������������� �������
                $arDropDown,             // ������ ����������� �������� ������
                $value,                  // �������� ���������� �������� ������
                "class=\"inputselect\""  // ����� ����������� ������
                );            
            ?-->
            <?$PRICE_ID=$_REQUEST['PRICE_ID'];?>
            <select onchange="javascript:document.location=document.location.href+'&PRICE_ID='+this.options[this.selectedIndex].value">
              <option value="" <?if($PRICE_ID==""):?>selected<?endif?> >���</option>
              <option value="1" <?if($PRICE_ID=="1"):?>selected<?endif?> >�� 3000 ���</option>
              <option value="2" <?if($PRICE_ID=="2"):?>selected<?endif?> >3000-5000 ���</option>
              <option value="3" <?if($PRICE_ID=="3"):?>selected<?endif?> >5000-10000 ���</option>
              <option value="4" <?if($PRICE_ID=="4"):?>selected<?endif?> >10000-15000 ���</option>
              <option value="5" <?if($PRICE_ID=="5"):?>selected<?endif?> >����� 15000 ���</option>
            </select>
        </td>
        <!--td><input type="submit" name="filter" value="���������"></td-->
    </tr>
</table>
</form>
</div>