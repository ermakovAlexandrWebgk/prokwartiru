<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
/*******************************************
       �������������� ����������
*******************************************/

$RESULT_ID = 12; // ID ����������

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
        <td>�������� ���:</td>
        <td><?

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
            echo CForm::GetDropDownField(
                $QUESTION_SID,           // ���������� ������������� �������
                $arDropDown,             // ������ ����������� �������� ������
                $value,                  // �������� ���������� �������� ������
                "class=\"inputselect\""  // ����� ����������� ������
                );            
            ?></td>
        <td>
<!--input type="submit" name="filter" value="���������"-->
<input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" />
        </td>
    </tr>
</table>
</form>