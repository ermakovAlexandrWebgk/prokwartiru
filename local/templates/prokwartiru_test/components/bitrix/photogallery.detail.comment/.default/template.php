<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>
<div id="photo_comments">
<?

if ($arParams["COMMENTS_TYPE"] == "blog"):
$APPLICATION->IncludeComponent(
	"bitrix:blog.post.comment",
	"",
	Array(
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"COMMENTS_COUNT" => $arParams["COMMENTS_COUNT"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"BLOG_URL" => $arParams["BLOG_URL"],
		"ID" => $arResult["COMMENT_ID"],
		"PATH_TO_USER" => $arParams["PATH_TO_USER"],
		"PATH_TO_BLOG" => $arParams["PATH_TO_BLOG"],
		"PATH_TO_POST" => $arResult["ELEMENT"]["~DETAIL_PAGE_URL"],
		"SIMPLE_COMMENT" => "Y"
	),
	($this->__component->__parent ? $this->__component->__parent : $component),
	array("HIDE_ICONS" => "Y"));
?><style>
div.blog-line{
	display: none;}
table.blog-table-post-comment th{
	font-size: 100%; }
table.blog-table-post-comment td{
	font-size: 100%; }
table.blog-table-post-comment-table th, table.blog-table-post-comment-table td{
	font-size: 100%;}
table.blog-table-post-comment-table a{
	text-decoration: none;
	curor:default;}
table.blog-comment-form th, table.blog-comment-form td{
	font-size: 100%;}
.blogButton {
	font-size: 100%;}
.blog-comment-text {font-size:100%;}
</style><?
else:
$APPLICATION->IncludeComponent(
	"bitrix:forum.topic.reviews",
	"",
	Array(
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"MESSAGES_PER_PAGE" => $arParams["COMMENTS_COUNT"],
		"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
		"PREORDER" => $arParams["PREORDER"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"FORUM_ID" => $arParams["FORUM_ID"],
		"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
		"URL_TEMPLATES_PROFILE_VIEW" => $arParams["URL_TEMPLATES_PROFILE_VIEW"],
		"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
		"ELEMENT_ID" => $arParams["ELEMENT_ID"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"POST_FIRST_MESSAGE" => $arParams["POST_FIRST_MESSAGE"]
	),
	($this->__component->__parent ? $this->__component->__parent : $component),
	array("HIDE_ICONS" => "Y")
);
endif;
?>
</div>
<?