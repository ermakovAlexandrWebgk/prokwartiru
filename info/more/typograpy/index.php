<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("����������");
?>
<h2>��������� H2</h2>
<p>��������-������� � ����, ��������� �������� � ���������. ��������� ������������� ������������ ����� �� �������, ������� ������ ������ � �������� ������ � ���� ��������.&nbsp;</p>
<blockquote>������������ ������� � ������� ������� ���-���������. ����� ��� ���������� ������ ����������������� ����������� �������� ��������� �������������� ��������� �� ���������� ��������. 	</blockquote> 
<h3>��������� H3</h3>
<p><i>������, � ���� ������ ������� ���� ����������, ��������� �������� ����������� ������ ����������� �������� ����������� �������, ��� � ������ ���������� ��������.</i></p>
<h4>������������� ������ H4</h4>
<ul>
	<li>� ��������-���������, ������������ �� ��������� �������, ����� ������� ������������ ��������� ���������� � ������� �������.</li>
	<li>����� ����, ���������� �����, � ������� ����� ����������� �� ��������, ����������� �����, Jabber ��� ICQ.</li>
</ul>
<h5>������������ ������ H5</h5>
<ol>
	<li>� ��������-���������, ������������ �� ��������� �������, ����� ������� ������������ ��������� ���������� � ������� �������.</li>
	<li>����� ����, ���������� �����, � ������� ����� ����������� �� ��������, ����������� �����, Jabber ��� ICQ.</li>
</ol>
<hr class="long"/>
<h5>�������</h5>
<table class="colored_table">
	<thead>
		<tr>
			<td>#</td>
			<td>First Name</td>
			<td>Last Name</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>Tim</td>
			<td>Tors</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Denis</td>
			<td>Loner</td>
		</tr>
	</tbody>
</table>
<hr class="long"/>

<div class="view_sale_block">
	<div class="count_d_block">
		<span class="active_to hidden">30.10.2017</span>
		<div class="title"><?=GetMessage("UNTIL_AKC");?></div>
		<span class="countdown values"></span>
	</div>
	<div class="quantity_block">
		<div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
		<div class="values">
			<span class="item">
				<span>10</span>
				<div class="text"><?=GetMessage("TITLE_QUANTITY");?></div>
			</span>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>