    <div class="top_inner_block_wrapper maxwidth-theme">
        <div class="page-top-wrapper grey">
            <section class="page-top maxwidth-theme  <?CNext::ShowPageProps('TITLE_CLASS');?>">
                <div class="header_row">
                    <h1 id="pagetitle"><?$APPLICATION->ShowTitle(false)?></h1>
                        <span style="dislpay:none;" id="replace_productPageCount"></span>		
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
</div>