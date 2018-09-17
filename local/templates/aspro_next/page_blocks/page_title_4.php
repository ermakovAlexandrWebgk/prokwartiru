<<<<<<< HEAD
<? /*  <div class="top_inner_block_wrapper maxwidth-theme">
=======
<?/*<div class="top_inner_block_wrapper maxwidth-theme">
>>>>>>> 8ce9b6f88725f3d37b042a1e1a8d8aade0150e2d
	<div class="page-top-wrapper color v4">
		<section class="page-top maxwidth-theme <?CNext::ShowPageProps('TITLE_CLASS');?>">	
			<div class="row">
				<div class="col-md-12">
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
				</div>
			</div>
		</section>
	</div>
</div>