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
                        "2000-2499 ���",
                        "����� 2500 ���"
                    ),

                "reference_id" => array (
                        "",
                        "12",
                        "13",
                        "14",
                        "15",
                        "16"
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
              <option value="12" <?if($PRICE_ID=="12"):?>selected<?endif?> >�� 1000 ���</option>
              <option value="13" <?if($PRICE_ID=="13"):?>selected<?endif?> >1000-1499 ���</option>
              <option value="14" <?if($PRICE_ID=="14"):?>selected<?endif?> >1500-1999 ���</option>
              <option value="15" <?if($PRICE_ID=="15"):?>selected<?endif?> >2000-2499 ���</option>
              <option value="16" <?if($PRICE_ID=="16"):?>selected<?endif?> >����� 2500 ���</option>
            </select>
        </td>
        <td style="padding-left: 10px;">�� ��������� �����������:&nbsp;</td>
        <td>
          <?$STRUCTURE_ID=$_REQUEST['STRUCTURE_ID'];?>
            <select onchange="javascript:document.location=document.location.href+'&STRUCTURE_ID='+this.options[this.selectedIndex].value">
              <option value="" <?if($STRUCTURE_ID==""):?>selected<?endif?> >���</option>
              <option value="17" <?if($STRUCTURE_ID=="17"):?>selected<?endif?> >��� ������</option>
              <option value="18" <?if($STRUCTURE_ID=="18"):?>selected<?endif?> >��� ������</option>
              <option value="19" <?if($STRUCTURE_ID=="19"):?>selected<?endif?> >��� ������</option>
              <option value="27" <?if($STRUCTURE_ID=="27"):?>selected<?endif?> >���������</option>
              <option value="20" <?if($STRUCTURE_ID=="20"):?>selected<?endif?> >��� �����</option>
              <option value="29" <?if($STRUCTURE_ID=="29"):?>selected<?endif?> >��� ������</option>
              <option value="30" <?if($STRUCTURE_ID=="30"):?>selected<?endif?> >��� ����</option>
              <option value="32" <?if($STRUCTURE_ID=="32"):?>selected<?endif?> >��� �������</option>
              <option value="31" <?if($STRUCTURE_ID=="31"):?>selected<?endif?> >� ����������</option>
              <option value="21" <?if($STRUCTURE_ID=="21"):?>selected<?endif?> >��� �������</option>
              <option value="28" <?if($STRUCTURE_ID=="28"):?>selected<?endif?> >������</option>
            </select>
        </td>
        <!--td><input type="submit" name="filter" value="�����" style="background-color: #8e8b86; color: white; border: 0px; height: 22px; padding: 0 3px;"></td-->
    </tr>
</table>
</form>
</div>