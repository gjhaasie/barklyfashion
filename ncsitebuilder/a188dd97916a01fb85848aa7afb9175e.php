<?php /* WARNING: this Shop page has surgical retail-redesign edits (body.bf-luxury + bf-shop-listing|bf-shop-pdp class, route-detection, conditional hero, PDP contact CTA injected as sibling of the Store element near line 238). Re-saving from the Network Solutions site builder UI WILL wipe these edits. Co-edit homepage-redesign.css, homepage-luxury.css, and shop-redesign.css alongside any structural change. */ ?>
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
					<meta name="description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "BarklyFashion - Pawsitively Elegant Attire For Dogs", ENT_QUOTES, 'UTF-8'); ?>" />
			<meta name="keywords" content="<?php echo htmlspecialchars((isset($seoKeywords) && $seoKeywords !== "") ? $seoKeywords : "premium dog apparel,dog clothing,stylish dog outfits,pet fashion,dog jackets and sweaters,high-quality dog apparel,dog fashion accessories,dog apparel deals,Barkly Fashion,fashionable dog wear", ENT_QUOTES, 'UTF-8'); ?>" />
				<meta property="og:site_name" content="BarklyFashion">
	
	<!-- Facebook Open Graph -->
		<meta property="og:title" content="<?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "BarklyFashion", ENT_QUOTES, 'UTF-8'); ?>" />
			<meta property="og:description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "BarklyFashion - Pawsitively Elegant Attire For Dogs", ENT_QUOTES, 'UTF-8'); ?>" />
			<meta property="og:image" content="<?php echo htmlspecialchars((isset($seoImage) && $seoImage !== "") ? "{{base_url}}".$seoImage : "{{base_url}}gallery_gen/5991a234d557bc4b2fa836a84c3598c3_fit.jpg", ENT_QUOTES, 'UTF-8'); ?>" />
			<meta property="og:type" content="article" />
			<meta property="og:url" content="{{curr_url}}" />
		<!-- Facebook Open Graph end -->

		<meta name="generator" content="Website Builder" />
			<script src="js/common-bundle.js?ts=20250816001332" type="text/javascript"></script>
	<script src="js/a188dd97916a01fb85848aa7afb9175e-bundle.js?ts=20250816001332" type="text/javascript"></script>
	<link href="css/common-bundle.css?ts=20250816001332" rel="stylesheet" type="text/css" />
	<?php /* fix: removed legacy Open Sans / Source Sans Pro / Playfair Display Google Fonts — Shop is now Inter only via shop-redesign.css */ ?>
	<link href="css/a188dd97916a01fb85848aa7afb9175e-bundle.css?ts=20250816001332" rel="stylesheet" type="text/css" id="wb-page-stylesheet" />
	<link rel="stylesheet" href="css/homepage-redesign.css?ts=20260430warm" type="text/css">
	<link rel="stylesheet" href="css/homepage-luxury.css?ts=20260430warm" type="text/css">
	<link rel="stylesheet" href="css/shop-redesign.css?ts=20260430warm" type="text/css">
	<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,300;1,400&family=Inter:wght@300;400;500&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,300;1,400&family=Inter:wght@300;400;500&display=swap" media="print" onload="this.media='all';this.onload=null">
	<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,300;1,400&family=Inter:wght@300;400;500&display=swap"></noscript>
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


<?php
// fix: PHP 5.3-compatible isset() (matches index.php baseline) instead of `??` (PHP 7+); regex anchored at path start so `/MyShop/` etc. don't match
$bfRequestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$isShopListing = (bool) preg_match('#(^|/)Shop/?(\?.*)?$#', $bfRequestUri);
$shopBodyClass = $isShopListing ? 'bf-shop-listing' : 'bf-shop-pdp';
?>
<body class="site site-lang-en bf-luxury <?php echo $shopBodyClass; ?><?php if (isset($wbPopupMode) && $wbPopupMode) echo ' popup-mode'; ?> " <?php ?>><div id="wb_root" class="root wb-layout-vertical"><div class="wb_sbg"></div><div id="wb_header_a188dd97916a01fb85848aa7afb9175e" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf31dc9641cf0f785c94b9" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a198956ddd7300c5dfc42c66946f0eea" class="wb_element wb_element_picture" data-plugin="Picture" title=""><div class="wb_picture_wrap"><div class="wb-picture-wrapper"><img loading="eager" width="60" height="60" alt="Barkly logo" src="gallery_gen/5991a234d557bc4b2fa836a84c3598c3_170x170_fit.jpg?ts=1755292416"></div></div></div><div id="a18b71462858008053b32ebb5435d29c" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a18b7146781600f5a489f1f8c34a45df" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h4 class="wb-stl-pagetitle">BARKLY</h4>
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
			'class' => '',
			'children' => array()
		),
		(object) array(
			'id' => 3,
			'href' => 'Shop/',
			'name' => 'Shop',
			'class' => 'wb_this_page_menu_item active',
			'children' => array()
		)
	)
)); ?><div class="clearfix"></div></div></div></div></div></div></div></div><div id="wb_main_a188dd97916a01fb85848aa7afb9175e" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf0e03ffaaf8616cac2abc" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><?php if ($isShopListing): ?><div id="a188dd977fcf0f7a0b03ad26ccae7624" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h1 class="wb-stl-heading1 bf-shop-h1">The Shop</h1>
<p class="bf-shop-subhead">A first look at pieces we're making. Nothing is shipping yet, but leave your email and we'll tell you when it is.</p>
</div><?php endif; ?><div id="a188dd977fcf11be6f1c55d09510b0ac" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd977fcf12e64376ac1a9c64f330" class="wb_element wb_element_picture" data-plugin="Picture" title=""><div class="wb_picture_wrap"><div class="wb-picture-wrapper"><img loading="lazy" alt="" src="gallery/IMG_0314.jpg?ts=1755292416"></div></div></div><div id="a188dd977fcf1389e7f8a5d3a205f8fc" class="wb_element wb_element_picture" data-plugin="Picture" title=""><div class="wb_picture_wrap"><div class="wb-picture-wrapper"><img loading="lazy" alt="" src="gallery/IMG_0320.jpg?ts=1755292416"></div></div></div><div id="a188dd977fcf144645af9cac3ee9d2b1" class="wb_element wb_element_picture" data-plugin="Picture" title=""><div class="wb_picture_wrap"><div class="wb-picture-wrapper"><img loading="lazy" alt="" src="gallery/IMG_9072.jpg?ts=1755292416"></div></div></div></div></div><div id="a188dd977fcf157d59d3babd94038204" class="wb_element wb-prevent-layout-click" data-plugin="Store"><div class="wb-store wb-mob-store wb-tab-store"><a name="wbs1" class="wb_anchor"></a><?php StoreElement::render(StoreModule::$storeNav, (object) array(
	'id' => 'a188dd977fcf157d59d3babd94038204',
	'anchor' => 'wbs1',
	'disableAnchorNav' => false,
	'hasPaymentGateways' => true,
	'hasForm' => false,
	'hasBillingForm' => true,
	'billingFields' => array(
		(object) array(
			'enabled' => true,
			'required' => true,
			'type' => 'wb_store_isCompany',
			'name' => 'Private person / Company',
			'showFor' => 'both'
		),
		(object) array(
			'enabled' => true,
			'required' => true,
			'type' => 'wb_store_email',
			'name' => 'Email',
			'showFor' => 'both'
		),
		(object) array(
			'enabled' => true,
			'required' => true,
			'type' => 'wb_store_phone',
			'name' => 'Phone Number',
			'showFor' => 'both'
		),
		(object) array(
			'enabled' => true,
			'required' => true,
			'type' => 'wb_store_firstName',
			'name' => 'First Name',
			'showFor' => 'personal'
		),
		(object) array(
			'enabled' => true,
			'required' => true,
			'type' => 'wb_store_lastName',
			'name' => 'Last Name',
			'showFor' => 'personal'
		),
		(object) array(
			'enabled' => true,
			'required' => true,
			'type' => 'wb_store_companyName',
			'name' => 'Company Name',
			'showFor' => 'company'
		),
		(object) array(
			'enabled' => true,
			'required' => false,
			'type' => 'wb_store_companyCode',
			'name' => 'Company Code',
			'showFor' => 'company'
		),
		(object) array(
			'enabled' => true,
			'required' => false,
			'type' => 'wb_store_companyVatCode',
			'name' => 'Company TAX/VAT number',
			'showFor' => 'company'
		),
		(object) array(
			'enabled' => true,
			'required' => true,
			'type' => 'wb_store_address1',
			'name' => 'Address',
			'showFor' => 'both'
		),
		(object) array(
			'enabled' => true,
			'required' => true,
			'type' => 'wb_store_city',
			'name' => 'City',
			'showFor' => 'both'
		),
		(object) array(
			'enabled' => true,
			'required' => false,
			'type' => 'wb_store_postCode',
			'name' => 'Post Code',
			'showFor' => 'both'
		),
		(object) array(
			'enabled' => true,
			'required' => true,
			'type' => 'wb_store_countryCode',
			'name' => 'Country',
			'showFor' => 'both'
		),
		(object) array(
			'enabled' => true,
			'required' => true,
			'type' => 'wb_store_region',
			'name' => 'Region',
			'showFor' => 'both'
		)
	),
	'hasCart' => false,
	'thumbWidth' => 250,
	'thumbHeight' => 250,
	'thumbAutoCrop' => true,
	'imageWidth' => 320,
	'imageHeight' => 320,
	'filterPosition' => 'top',
	'defaultSort' => null,
	'animationEffectItems' => null,
	'showAddToCartInList' => false,
	'showBuyNowInList' => false,
	'storeShowAddToCartText' => null,
	'storeShowBuyNowText' => null,
	'showTextFilter' => true,
	'showPriceFilter' => true,
	'showProductFilter' => true,
	'showSorting' => true,
	'showViewSwitch' => true,
	'showDiscountLabel' => false,
	'showPriceFrom' => true,
	'imageBorderWidth' => 2,
	'imageBorderHeight' => 2,
	'itemsPerPage' => 6,
	'category' => 0,
	'visibility' => array(
		'tv' => true,
		'tablet' => true,
		'desktop' => true,
		'phone' => true
	),
	'tag' => 'p'
)); ?></div></div><?php /* WARNING: surgical PDP contact CTA — sibling of the Store element, gated by !$isShopListing. Posts to FormSubmit.co (free relay, no backend) which forwards to amir.akp1@gmail.com. First submission requires Amir to click a one-time verification email from FormSubmit. AJAX path uses /ajax/{email} JSON endpoint; no-JS fallback uses native POST + _next redirect to ?notified=1. Inline JS below relocates this node into .wb-store-properties so it sits in the right meta column under the price. Re-saving from the site builder UI WILL wipe this block. */ ?><?php if (!$isShopListing):
	$bfPdpPath = parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '', PHP_URL_PATH);
	$bfPdpSlug = basename(rtrim((string) $bfPdpPath, '/'));
	// strip slug to [A-Za-z0-9_-] so attacker-fabricated paths cannot reflect arbitrary content into Amir's email subject / product field
	$bfPdpSlugClean = preg_replace('/[^A-Za-z0-9_-]/', '', $bfPdpSlug);
	$bfPdpName = ($bfPdpSlugClean !== null && $bfPdpSlugClean !== '') ? $bfPdpSlugClean : 'this piece';
	$bfPdpNameSafe = htmlspecialchars($bfPdpName, ENT_QUOTES, 'UTF-8');
	$bfPdpScheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
	// allowlist Host header so a forged Host can't turn the FormSubmit `_next` redirect into an open-redirect to attacker.com
	$bfPdpHostRaw = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
	$bfPdpAllowedHosts = array('barklyfashion.com', 'www.barklyfashion.com', 'localhost', 'localhost:8000', '127.0.0.1', '127.0.0.1:8000');
	$bfPdpHost = in_array($bfPdpHostRaw, $bfPdpAllowedHosts, true) ? $bfPdpHostRaw : 'www.barklyfashion.com';
	$bfPdpReturn = $bfPdpScheme . '://' . $bfPdpHost . $bfPdpPath . '?notified=1';
	$bfPdpReturnSafe = htmlspecialchars($bfPdpReturn, ENT_QUOTES, 'UTF-8');
	$bfPdpSubjectSafe = htmlspecialchars('Barkly enquiry: ' . $bfPdpName, ENT_QUOTES, 'UTF-8');
	$bfPdpProductAttr = htmlspecialchars($bfPdpName, ENT_QUOTES, 'UTF-8');
	$bfPdpSubjectAttr = htmlspecialchars('Barkly enquiry: ' . $bfPdpName, ENT_QUOTES, 'UTF-8');
	$bfPdpNotified = isset($_GET['notified']) && $_GET['notified'] === '1';
?><?php /* data-bf-product / data-bf-subject hold the cleaned slug + subject for JSON body use, separate from the HTML-context-escaped hidden inputs that the no-JS native POST relies on. Both values are derived from the [A-Za-z0-9_-]-stripped slug so htmlspecialchars is a no-op today, but the data-attr path stays correct if the slug allowlist is ever loosened. */ ?><div class="bf-pdp-contact" role="complementary" aria-label="Enquire about this piece" data-bf-pdp-contact data-bf-product="<?php echo $bfPdpProductAttr; ?>" data-bf-subject="<?php echo $bfPdpSubjectAttr; ?>">
<?php if ($bfPdpNotified): ?>
	<p class="bf-pdp-contact-success">Noted. We'll be in touch the moment this piece is ready to wear.</p>
<?php else: ?>
	<p class="bf-pdp-contact-lede">Leave your email, and we'll write to you the moment this piece is ready to wear.</p>
	<form class="bf-pdp-contact-form" action="https://formsubmit.co/amir.akp1@gmail.com" method="POST">
		<?php /* honeypot first so naive bots fill it before reaching the real email field; hidden meta fields adjacent to honeypot; visible inputs and submit last */ ?>
		<input type="text" name="_honey" value="" tabindex="-1" autocomplete="off" style="display:none" aria-hidden="true" />
		<input type="hidden" name="product" value="<?php echo $bfPdpNameSafe; ?>" />
		<input type="hidden" name="_subject" value="<?php echo $bfPdpSubjectSafe; ?>" />
		<input type="hidden" name="_template" value="table" />
		<?php /* _captcha=true protects the no-JS native POST path. AJAX path drops it (reCAPTCHA can't render via JSON). */ ?>
		<input type="hidden" name="_captcha" value="true" />
		<input type="hidden" name="_next" value="<?php echo $bfPdpReturnSafe; ?>" />
		<label class="bf-pdp-contact-input-wrap">
			<span class="bf-pdp-contact-input-label">Email address</span>
			<input type="email" name="email" class="bf-pdp-contact-input" placeholder="your email address" required autocomplete="email" />
		</label>
		<button type="submit" class="bf-pdp-contact-btn">Notify me</button>
		<p class="bf-pdp-contact-error" aria-live="polite" hidden></p>
		<p class="bf-pdp-contact-privacy">We'll only use your email to write to you about this piece. Submissions are processed by <a href="https://formsubmit.co/privacy-policy" target="_blank" rel="noopener noreferrer">FormSubmit</a>.</p>
	</form>
	<div class="bf-pdp-modal" role="dialog" aria-modal="true" aria-labelledby="bf-pdp-modal-title" aria-hidden="true" hidden>
		<div class="bf-pdp-modal-backdrop" data-bf-pdp-modal-dismiss></div>
		<div class="bf-pdp-modal-card" role="document">
			<button type="button" class="bf-pdp-modal-close" aria-label="Close" data-bf-pdp-modal-dismiss>&times;</button>
			<h2 class="bf-pdp-modal-title" id="bf-pdp-modal-title">Noted, with thanks.</h2>
			<p class="bf-pdp-modal-body">Your email is with us. We'll write to you the moment this piece is ready to wear &mdash; nothing more, nothing less.</p>
		</div>
	</div>
<?php endif; ?>
</div>
<script>
// Block-relocator: move the contact widget into .wb-store-properties (right meta column).
(function(){
	var observer = null;
	function bfMoveContact(){
		var src = document.querySelector('[data-bf-pdp-contact]');
		var dest = document.querySelector('.wb-store-properties');
		if (src && dest && src.parentNode !== dest) {
			src.classList.add('bf-pdp-contact--inline');
			dest.appendChild(src);
		}
	}
	function bfInit(){
		bfMoveContact();
		if (typeof MutationObserver !== 'undefined') {
			var target = document.querySelector('.wb-store-details') || document.body;
			if (target) {
				observer = new MutationObserver(bfMoveContact);
				observer.observe(target, { childList: true, subtree: true });
				setTimeout(function(){ if (observer) { observer.disconnect(); observer = null; } }, 5000);
			}
		}
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', bfInit);
	} else {
		bfInit();
	}
})();

// AJAX submit + modal. Native POST fallback survives if this script never runs (form action/method/_next still go to FormSubmit's redirect flow which the ?notified=1 PHP branch handles).
// Note: AJAX path drops _captcha because reCAPTCHA cannot render via a JSON request. Spam defense on the AJAX path is the _honey honeypot + FormSubmit's per-recipient rate limiting; the no-JS native POST path keeps _captcha=true.
(function(){
	function init(){
		var root = document.querySelector('[data-bf-pdp-contact]');
		if (!root) return;
		var form = root.querySelector('.bf-pdp-contact-form');
		var modal = document.querySelector('.bf-pdp-modal');
		if (!form || !modal) return;
		var btn = form.querySelector('.bf-pdp-contact-btn');
		var emailInput = form.querySelector('input[name="email"]');
		var honeyInput = form.querySelector('input[name="_honey"]');
		var errEl = form.querySelector('.bf-pdp-contact-error');
		var dismissEls = modal.querySelectorAll('[data-bf-pdp-modal-dismiss]');
		var closeBtn = modal.querySelector('.bf-pdp-modal-close');
		var lastFocus = null;
		var hideTimer = null;

		function setError(msg){
			if (!errEl) return;
			if (msg) {
				errEl.textContent = msg;
				errEl.removeAttribute('hidden');
			} else {
				errEl.textContent = '';
				errEl.setAttribute('hidden', '');
			}
		}
		function focusables(){
			return modal.querySelectorAll('button, [href], input:not([type="hidden"]), [tabindex]:not([tabindex="-1"])');
		}
		function trap(e){
			if (e.key === 'Escape') { closeModal(); return; }
			if (e.key !== 'Tab') return;
			var f = focusables();
			if (!f.length) { e.preventDefault(); return; }
			if (f.length === 1) { e.preventDefault(); f[0].focus(); return; }
			var first = f[0], last = f[f.length - 1];
			if (e.shiftKey && document.activeElement === first) { last.focus(); e.preventDefault(); }
			else if (!e.shiftKey && document.activeElement === last) { first.focus(); e.preventDefault(); }
		}
		function openModal(){
			lastFocus = document.activeElement;
			if (hideTimer) { clearTimeout(hideTimer); hideTimer = null; }
			if (modal.parentNode !== document.body) document.body.appendChild(modal);
			modal.removeAttribute('hidden');
			requestAnimationFrame(function(){ modal.classList.add('is-open'); });
			modal.setAttribute('aria-hidden', 'false');
			document.addEventListener('keydown', trap);
			if (closeBtn && closeBtn.focus) closeBtn.focus();
		}
		function closeModal(){
			modal.classList.remove('is-open');
			modal.setAttribute('aria-hidden', 'true');
			document.removeEventListener('keydown', trap);
			hideTimer = setTimeout(function(){ modal.setAttribute('hidden', ''); hideTimer = null; }, 250);
			if (lastFocus && lastFocus.focus) try { lastFocus.focus(); } catch (e) {}
		}
		for (var i = 0; i < dismissEls.length; i++) {
			dismissEls[i].addEventListener('click', function(e){
				e.preventDefault();
				closeModal();
			});
		}

		form.addEventListener('submit', function(e){
			if (honeyInput && honeyInput.value) {
				e.preventDefault();
				openModal();
				return;
			}
			if (typeof fetch !== 'function') return;
			e.preventDefault();
			setError('');
			var email = emailInput && emailInput.value ? emailInput.value.trim() : '';
			if (!email) {
				setError('Please enter a valid email address.');
				if (emailInput) emailInput.focus();
				return;
			}
			var product = root.getAttribute('data-bf-product') || (form.querySelector('input[name="product"]') || {}).value || '';
			var subject = root.getAttribute('data-bf-subject') || (form.querySelector('input[name="_subject"]') || {}).value || ('Barkly enquiry: ' + product);
			if (!btn.dataset.originalLabel) btn.dataset.originalLabel = btn.textContent;
			btn.disabled = true;
			btn.textContent = 'Sending';
			form.classList.add('is-loading');

			fetch('https://formsubmit.co/ajax/amir.akp1@gmail.com', {
				method: 'POST',
				headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
				body: JSON.stringify({
					email: email,
					product: product,
					_subject: subject
				})
			}).then(function(r){
				return r.json().then(function(j){ return { ok: r.ok, body: j }; });
			}).then(function(res){
				form.classList.remove('is-loading');
				var body = res.body || {};
				var success = String(body.success).toLowerCase() === 'true';
				// FormSubmit's activation-pending response is treated as success: the submission is held by the relay and delivers after the recipient clicks the one-time activation link.
				var msg = (body.message || '').toLowerCase();
				var activationPending = msg.indexOf('activation') !== -1 || msg.indexOf('activate') !== -1;
				if (res.ok && (success || activationPending)) {
					form.reset();
					openModal();
				} else {
					btn.disabled = false;
					btn.textContent = btn.dataset.originalLabel;
					setError(body.message || 'Something went amiss. Please try again.');
				}
			}).catch(function(){
				form.classList.remove('is-loading');
				btn.disabled = false;
				btn.textContent = btn.dataset.originalLabel;
				setError("Couldn't reach our mail relay. Please try again in a moment.");
			});
		});
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
</script>
<?php endif; ?></div></div></div></div><div id="wb_footer_a188dd97916a01fb85848aa7afb9175e" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf404c2a958d6632b1bc23" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd977fcf41b76c596a7ea3835ef0" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd977fcf42771b16abc7d7896e2e" class="wb_element wb_element_picture" data-plugin="Picture" title=""><div class="wb_picture_wrap" style="height: 100%"><div class="wb-picture-wrapper" style="overflow: visible; display: flex"><a href="https://www.instagram.com/barklyfashion/" target="_blank" rel="noopener noreferrer" aria-label="Barkly on Instagram"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="40" height="auto" viewBox="0 0 1793.982 1793.982" style="direction: ltr; color:#ffffff"><text x="129.501415" y="1537.02" font-size="1792" fill="currentColor" style='font-family: "FontAwesome"'></text></svg></a></div></div></div></div></div><div id="a188dd977fcf45da6fc492493c28b5b1" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal" style="text-align: center;"><span style="color:rgba(255,255,255,1);"><a class="bf-instagram-follow" href="https://www.instagram.com/barklyfashion/" target="_blank" rel="noopener noreferrer">Follow @barklyfashion</a></span></p><p class="bf-copyright">&copy; <?php echo date('Y'); ?> Barkly. All rights reserved.</p></div></div></div><div id="wb_footer_c" class="wb_element" data-plugin="WB_Footer" style="text-align: center; width: 100%;"><div class="wb_footer"></div><script type="text/javascript">
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
