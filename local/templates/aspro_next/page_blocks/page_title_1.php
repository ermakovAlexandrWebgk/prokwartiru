<<<<<<< HEAD
<? /*  <div class="top_inner_block_wrapper maxwidth-theme">
=======
<?/*<div class="top_inner_block_wrapper maxwidth-theme">
>>>>>>> 8ce9b6f88725f3d37b042a1e1a8d8aade0150e2d
    <section class="page-top maxwidth-theme <?CNext::ShowPageProps('TITLE_CLASS');?>">
        <div class="header_row">
            <h1 id="pagetitle"><?$APPLICATION->ShowTitle(false)?></h1>
            <?$p1 = "/catalog/";
            if (strstr($APPLICATION->GetCurDir(), $p1)) {?>
                <div style="dislpay:none;" id="replace_productPageCount"></div>     
            <?}?>
        </div>
        <div class="page-top-main">
            <?=$APPLICATION->ShowViewContent('product_share')?>
            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "next", array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => SITE_ID,
            "SHOW_SUBSECTIONS" => "N"
            ),
            false
            );?>
        </div>
    </section>
</div>
