<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript">
			</script>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "BarklyFashion", ENT_QUOTES, 'UTF-8'); ?></title>
	<base href="{{base_url}}" />
	<?php echo isset($sitemapUrls) ? (generateCanonicalUrl($sitemapUrls)."\n") : ""; ?>	
	
						<meta name="viewport" content="width=device-width, initial-scale=1" />
					<meta name="description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "Barkly is a small house making coats, sweaters, and bandanas for dogs by hand, in small numbers. Every piece is numbered.", ENT_QUOTES, 'UTF-8'); ?>" />
			<meta name="keywords" content="<?php echo htmlspecialchars((isset($seoKeywords) && $seoKeywords !== "") ? $seoKeywords : "handmade dog clothing,small batch dog coats,numbered dog apparel,hand-sewn dog sweaters,ready-to-wear for dogs", ENT_QUOTES, 'UTF-8'); ?>" />
				<meta property="og:site_name" content="BarklyFashion">
	
	<!-- Facebook Open Graph -->
		<meta property="og:title" content="<?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "BarklyFashion", ENT_QUOTES, 'UTF-8'); ?>" />
			<meta property="og:description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "Barkly is a small house making coats, sweaters, and bandanas for dogs by hand, in small numbers. Every piece is numbered.", ENT_QUOTES, 'UTF-8'); ?>" />
			<meta property="og:image" content="<?php echo htmlspecialchars((isset($seoImage) && $seoImage !== "") ? "{{base_url}}".$seoImage : "{{base_url}}gallery_gen/5991a234d557bc4b2fa836a84c3598c3_fit.jpg", ENT_QUOTES, 'UTF-8'); ?>" />
			<meta property="og:type" content="article" />
			<meta property="og:url" content="{{curr_url}}" />
		<!-- Facebook Open Graph end -->

		<meta name="generator" content="Website Builder" />
			<script src="js/common-bundle.js?ts=20250816001332" type="text/javascript"></script>
	<script src="js/a188dd97916a02dc5d341a8477c3ea12-bundle.js?ts=20250816001332" type="text/javascript"></script>
	<link href="css/common-bundle.css?ts=20250816001332" rel="stylesheet" type="text/css" />
	<link href="css/a188dd97916a02dc5d341a8477c3ea12-bundle.css?ts=20250816001332" rel="stylesheet" type="text/css" id="wb-page-stylesheet" />
	<?php /* About Us inherits the luxury design system from the homepage. */ ?>
	<link rel="stylesheet" href="css/homepage-redesign.css?ts=20260430warm" type="text/css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,300;1,400&family=Inter:wght@300;400;500&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,300;1,400&family=Inter:wght@300;400;500&display=swap" media="print" onload="this.media='all';this.onload=null">
	<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,300;1,400&family=Inter:wght@300;400;500&display=swap"></noscript>
	<link rel="stylesheet" href="css/homepage-luxury.css?ts=20260430warm" type="text/css">
	<ga-code/><meta name="msvalidate.01" content="D05EFC1E04EBD851B3BBC04C41CA6680" /><link rel="apple-touch-icon" type="image/png" sizes="120x120" href="gallery/favicons/favicon-120x120.png"><link rel="icon" type="image/png" sizes="120x120" href="gallery/favicons/favicon-120x120.png"><link rel="apple-touch-icon" type="image/png" sizes="152x152" href="gallery/favicons/favicon-152x152.png"><link rel="icon" type="image/png" sizes="152x152" href="gallery/favicons/favicon-152x152.png"><link rel="apple-touch-icon" type="image/png" sizes="180x180" href="gallery/favicons/favicon-180x180.png"><link rel="icon" type="image/png" sizes="180x180" href="gallery/favicons/favicon-180x180.png"><link rel="icon" type="image/png" sizes="192x192" href="gallery/favicons/favicon-192x192.png"><link rel="apple-touch-icon" type="image/png" sizes="60x60" href="gallery/favicons/favicon-60x60.png"><link rel="icon" type="image/png" sizes="60x60" href="gallery/favicons/favicon-60x60.png"><link rel="apple-touch-icon" type="image/png" sizes="76x76" href="gallery/favicons/favicon-76x76.png"><link rel="icon" type="image/png" sizes="76x76" href="gallery/favicons/favicon-76x76.png"><link rel="icon" type="image/png" href="gallery/favicons/favicon.png"><meta name="google-site-verification" content="" />
	<script type="text/javascript">
	window.useTrailingSlashes = true;
	window.disableRightClick = false;
	window.currLang = 'en';
</script>
		
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<![endif]-->

		<script type="text/javascript">
		$(function () {
<?php $wb_form_send_success = popSessionOrGlobalVar("wb_form_send_success"); ?>
<?php if (($wb_form_send_state = popSessionOrGlobalVar("wb_form_send_state"))) { ?>
	<?php if (($wb_form_popup_mode = popSessionOrGlobalVar("wb_form_popup_mode")) && (isset($wbPopupMode) && $wbPopupMode)) { ?>
		if (window !== window.parent && window.parent.postMessage) {
			var data = {
				event: "wb_contact_form_sent",
				data: {
					state: "<?php echo str_replace('"', '\"', $wb_form_send_state); ?>",
					type: "<?php echo $wb_form_send_success ? "success" : "danger"; ?>"
				}
			};
			window.parent.postMessage(data, "<?php echo str_replace('"', '\"', popSessionOrGlobalVar("wb_target_origin")); ?>");
		}
	<?php $wb_form_send_success = false; $wb_form_send_state = null; $wb_form_popup_mode = false; ?>
	<?php } else { ?>
		wb_show_alert("<?php echo str_replace(array('"', "\r", "\n"), array('\"', "", "<br/>"), $wb_form_send_state); ?>", "<?php echo $wb_form_send_success ? "success" : "danger"; ?>");
	<?php } ?>
<?php } ?>
});    </script>
</head>


<body class="site site-lang-en bf-luxury<?php if (isset($wbPopupMode) && $wbPopupMode) echo ' popup-mode'; ?> " <?php ?>><div id="wb_root" class="root wb-layout-vertical"><div class="wb_sbg"></div><div id="wb_header_a188dd97916a02dc5d341a8477c3ea12" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf31dc9641cf0f785c94b9" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a198956ddd7300c5dfc42c66946f0eea" class="wb_element wb_element_picture" data-plugin="Picture" title=""><div class="wb_picture_wrap"><div class="wb-picture-wrapper"><img loading="lazy" alt="" src="gallery_gen/5991a234d557bc4b2fa836a84c3598c3_170x170_fit.jpg?ts=1755292416"></div></div></div><div id="a18b71462858008053b32ebb5435d29c" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a18b7146781600f5a489f1f8c34a45df" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h4 class="wb-stl-pagetitle">BARKLY</h4>
</div></div></div><div id="a18b677059e700d263ff5e4e3e3d1949" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd977fcf339c1e61edf0f5ebf373" class="wb_element wb-menu wb-prevent-layout-click wb-menu-mobile" data-plugin="Menu"><a class="btn btn-default btn-collapser"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><?php MenuElement::render((object) array(
	'type' => 'hmenu',
	'dir' => 'ltr',
	'items' => array(
		(object) array(
			'id' => 1,
			'href' => '{{base_url}}',
			'name' => 'Home',
			'class' => '',
			'children' => array()
		),
		(object) array(
			'id' => 2,
			'href' => 'About-us/',
			'name' => 'About us',
			'class' => 'wb_this_page_menu_item active',
			'children' => array()
		),
		(object) array(
			'id' => 3,
			'href' => 'Shop/',
			'name' => 'Shop',
			'class' => '',
			'children' => array()
		)
	)
)); ?><div class="clearfix"></div></div></div></div></div></div></div></div><div id="wb_main_a188dd97916a02dc5d341a8477c3ea12" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf0248ea6b62e89768c0f5" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf03303004ad3b87787568" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h1 class="wb-stl-heading1" style="text-align: left;">Made for the dogs we walk.</h1>
</div><div id="a188dd977fcf041726e6c836a033acf5" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a198ab2eed9f0030e3fae0fd2f3c0820" class="wb_element wb-prevent-layout-click" data-plugin="instagram_video"><iframe id="a198ab2eed9f0030e3fae0fd2f3c0820_instagram_video" src="https://www.instagram.com/p/DFx_nkyyPQ4/embed" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div><div id="a188dd977fcf06a35aeeedb300e96446" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf0750c24e084ca7a036f2" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal" style="text-align: left;">Barkly is a small house. Each coat, sweater, and bandana is hand-cut from end-of-roll fabrics, sewn one piece at a time, and numbered before it leaves the workroom. We make a small number of pieces each season. When they’re gone, they’re gone.</p>
<p class="wb-stl-normal" style="text-align: left;">No two pieces are exactly alike. The fabric runs out before we do.</p>
</div><div id="a188dd977fcf083f63308fdfdd2b203e" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf0931ef3f581968661969" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h2 class="wb-stl-heading2" style="text-align: left;">On fabric, fit, and the dogs in the photos.</h2>
</div><div id="a188dd977fcf0a3de0a228903d03054d" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal" style="text-align: left;">We choose fabrics that hold up to wet grass, dirt paths, and the back seats of cars. Wools that sit well on the shoulders. Cottons soft enough to nap in. Hardware that doesn’t catch on a coat or a leash.</p>
<p class="wb-stl-normal" style="text-align: left;">Every piece is fitted on a real dog before it’s cut for the next. The dogs in our photos are friends. There are no model dogs, just the ones who happen to live nearby.</p>
</div></div></div></div></div></div></div></div></div></div></div><div id="wb_footer_a188dd97916a02dc5d341a8477c3ea12" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf404c2a958d6632b1bc23" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf41b76c596a7ea3835ef0" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd977fcf42771b16abc7d7896e2e" class="wb_element wb_element_picture" data-plugin="Picture" title=""><div class="wb_picture_wrap" style="height: 100%"><div class="wb-picture-wrapper" style="overflow: visible; display: flex"><a href="https://www.instagram.com/barklyfashion/" target="_blank" rel="noopener noreferrer" aria-label="Barkly on Instagram"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="40" height="auto" viewBox="0 0 1793.982 1793.982" style="direction: ltr; color:#ffffff"><text x="129.501415" y="1537.02" font-size="1792" fill="currentColor" style='font-family: "FontAwesome"'></text></svg></a></div></div></div></div></div><div id="a188dd977fcf45da6fc492493c28b5b1" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal" style="text-align: center;"><span style="color:rgba(255,255,255,1);"><a class="bf-instagram-follow" href="https://www.instagram.com/barklyfashion/" target="_blank" rel="noopener noreferrer">Follow @barklyfashion</a></span></p><p class="bf-copyright">&copy; <?php echo date('Y'); ?> Barkly. All rights reserved.</p></div></div></div><div id="wb_footer_c" class="wb_element" data-plugin="WB_Footer" style="text-align: center; width: 100%;"><div class="wb_footer"></div><script type="text/javascript">
			$(function() {
				var footer = $(".wb_footer");
				var html = (footer.html() + "").replace(/^\s+|\s+$/g, "");
				if (!html) {
					footer.parent().remove();
					footer = $("#footer, #footer .wb_cont_inner");
					footer.css({height: ""});
				}
			});
			</script></div></div></div><script type="text/javascript">$(function() { wb_require(["store/js/StoreCartElement"], function(app) {});})</script>
<div class="wb_pswp" tabindex="-1" role="dialog" aria-hidden="true">
</div>
</div>{{hr_out}}</body>
</html>
