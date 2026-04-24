<?php
	if (version_compare(PHP_VERSION, '5.3.3') < 0) {
		echo "Your PHP version is outdated for this website. Please update PHP version to 5.6 or higher.";
		exit();
	}
	if (!function_exists('mb_strlen')) {
		echo "PHP extension \"mbstring\" is required for this website. Please enable it.";
		exit();
	}
	if (!function_exists('json_decode')) {
		echo "PHP extension \"json\" is required for this website. Please enable it.";
		exit();
	}
	if (function_exists('apc_clear_cache')) apc_clear_cache();
	if((isset($_COOKIE['WB_SITE_DEBUG_MODE']) && $_COOKIE['WB_SITE_DEBUG_MODE']) || (isset($_SERVER['HTTP_X_DBG_LOG_ALL_ERRORS']) && $_SERVER['HTTP_X_DBG_LOG_ALL_ERRORS'])) { error_reporting(E_ALL); @ini_set('display_errors', true); }
	if (!@session_id()) @session_start();
	$tz = @date_default_timezone_get(); @date_default_timezone_set($tz ? $tz : 'UTC');
	require_once dirname(__FILE__).'/polyfill.php';
	$pages = array(
		array(
			'id' => 'a188dd97916a009965c17cb5091b1d29',
			'alias' => '',
			'file' => 'a188dd97916a009965c17cb5091b1d29.php',
			'controllers' => array(),
			'type' => 0
		),
		array(
			'id' => 'a188dd97916a02dc5d341a8477c3ea12',
			'alias' => 'About-us',
			'file' => 'a188dd97916a02dc5d341a8477c3ea12.php',
			'controllers' => array(),
			'type' => 0
		),
		array(
			'id' => 'a188dd97916a01fb85848aa7afb9175e',
			'alias' => 'Shop',
			'file' => 'a188dd97916a01fb85848aa7afb9175e.php',
			'controllers' => array(
				'wb_store'
			),
			'type' => 0
		)
	);
	$forms = array(
		'a188dd97916a01fb85848aa7afb9175e' => array(
			'39c5ad3e' => array(
				'email' => '',
				'emailFrom' => 'no-reply@barklyfashion.com',
				'subject' => 'Email from the site',
				'sentMessage' => 'Form was sent.',
				'object' => '{"name":"{{name}} (SKU: {{sku}}) (Price: {{price}}) (Qty: {{qty}})"}',
				'objectRenderer' => 'StoreModule::renderFormObject',
				'loggingHandler' => 'StoreModule::logForm',
				'smtpEnable' => false,
				'smtpHost' => null,
				'smtpPort' => null,
				'smtpEncryption' => null,
				'smtpUsername' => null,
				'smtpPassword' => null,
				'recVersion' => null,
				'recSiteKey' => null,
				'recSecretKey' => null,
				'useGclidCapture' => false,
				'maxFileSizeTotal' => null,
				'postUrl' => '',
				'redirectUrl' => null,
				'webhookUrl' => null,
				'brandId' => '87101',
				'fields' => array(
					array(
						'fidx' => '0',
						'name' => 'Private person / Company',
						'default' => array(),
						'type' => 'wb_store_isCompany',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '1',
						'name' => 'Email',
						'default' => array(),
						'type' => 'wb_store_email',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '2',
						'name' => 'Phone Number',
						'default' => array(),
						'type' => 'wb_store_phone',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '3',
						'name' => 'First Name',
						'default' => array(),
						'type' => 'wb_store_firstName',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '4',
						'name' => 'Last Name',
						'default' => array(),
						'type' => 'wb_store_lastName',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '5',
						'name' => 'Company Name',
						'default' => array(),
						'type' => 'wb_store_companyName',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '6',
						'name' => 'Company Code',
						'default' => array(),
						'type' => 'wb_store_companyCode',
						'enabled' => 1,
						'required' => 0,
						'settings' => array()
					),
					array(
						'fidx' => '7',
						'name' => 'Company TAX/VAT number',
						'default' => array(),
						'type' => 'wb_store_companyVatCode',
						'enabled' => 1,
						'required' => 0,
						'settings' => array()
					),
					array(
						'fidx' => '8',
						'name' => 'Address',
						'default' => array(),
						'type' => 'wb_store_address1',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '9',
						'name' => 'City',
						'default' => array(),
						'type' => 'wb_store_city',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '10',
						'name' => 'Post Code',
						'default' => array(),
						'type' => 'wb_store_postCode',
						'enabled' => 1,
						'required' => 0,
						'settings' => array()
					),
					array(
						'fidx' => '11',
						'name' => 'Country',
						'default' => array(),
						'type' => 'wb_store_countryCode',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '12',
						'name' => 'Region',
						'default' => array(),
						'type' => 'wb_store_region',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					)
				),
				'telegramApiToken' => '',
				'telegramChatId' => '',
				'formSendType' => 'email'
			),
			'fd943534' => array(
				'email' => '',
				'emailFrom' => 'no-reply@barklyfashion.com',
				'subject' => 'Email from the site',
				'sentMessage' => 'Form was sent.',
				'object' => '{"sender_name":"__default__","sender_email":"no-reply@barklyfashion.com"}',
				'objectRenderer' => '',
				'loggingHandler' => '',
				'smtpEnable' => false,
				'smtpHost' => null,
				'smtpPort' => null,
				'smtpEncryption' => null,
				'smtpUsername' => null,
				'smtpPassword' => null,
				'recVersion' => null,
				'recSiteKey' => null,
				'recSecretKey' => null,
				'useGclidCapture' => false,
				'maxFileSizeTotal' => null,
				'postUrl' => '',
				'redirectUrl' => null,
				'webhookUrl' => null,
				'brandId' => '87101',
				'fields' => array(
					array(
						'fidx' => '0',
						'name' => 'Private person / Company',
						'default' => array(),
						'type' => 'wb_store_isCompany',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '1',
						'name' => 'Email',
						'default' => array(),
						'type' => 'wb_store_email',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '2',
						'name' => 'Phone Number',
						'default' => array(),
						'type' => 'wb_store_phone',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '3',
						'name' => 'First Name',
						'default' => array(),
						'type' => 'wb_store_firstName',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '4',
						'name' => 'Last Name',
						'default' => array(),
						'type' => 'wb_store_lastName',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '5',
						'name' => 'Company Name',
						'default' => array(),
						'type' => 'wb_store_companyName',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '6',
						'name' => 'Company Code',
						'default' => array(),
						'type' => 'wb_store_companyCode',
						'enabled' => 1,
						'required' => 0,
						'settings' => array()
					),
					array(
						'fidx' => '7',
						'name' => 'Company TAX/VAT number',
						'default' => array(),
						'type' => 'wb_store_companyVatCode',
						'enabled' => 1,
						'required' => 0,
						'settings' => array()
					),
					array(
						'fidx' => '8',
						'name' => 'Address',
						'default' => array(),
						'type' => 'wb_store_address1',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '9',
						'name' => 'City',
						'default' => array(),
						'type' => 'wb_store_city',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '10',
						'name' => 'Post Code',
						'default' => array(),
						'type' => 'wb_store_postCode',
						'enabled' => 1,
						'required' => 0,
						'settings' => array()
					),
					array(
						'fidx' => '11',
						'name' => 'Country',
						'default' => array(),
						'type' => 'wb_store_countryCode',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					),
					array(
						'fidx' => '12',
						'name' => 'Region',
						'default' => array(),
						'type' => 'wb_store_region',
						'enabled' => 1,
						'required' => 1,
						'settings' => array()
					)
				),
				'telegramApiToken' => '',
				'telegramChatId' => '',
				'formSendType' => 'email'
			)
		)
	);
	$langs = null;
	$def_lang = null;
	$base_lang = 'en';
	$site_id = '0284880f';
	${'sitemapUrls'} = array(
		'https://barklyfashion.com/',
		'https://barklyfashion.com/About-us/',
		'https://barklyfashion.com/Shop/',
		'https://barklyfashion.com/Shop/Jacket1/',
		'https://barklyfashion.com/Shop/Jacket2/',
		'https://barklyfashion.com/Shop/Jacket3/',
		'https://barklyfashion.com/Shop/Tshirt1/'
	);
	${'redirectItems'} = array();
	$websiteUID = 'c8ee9947b73fcbd9fd29486e6ee3c988bfec6243db33c8c4819f859c023f4baecb93f80ef7469635';
	$base_dir = dirname(__FILE__);
	$base_url = '/';
	$user_domain = 'barklyfashion.com';
	$pretty_domain = 'barklyfashion.com';
	$home_page = 'a188dd97916a009965c17cb5091b1d29';
	$mod_rewrite = true;
	$show_comments = false;
	$ga_code = (is_file($ga_code_file = dirname(__FILE__).'/ga_code') ? file_get_contents($ga_code_file) : null);
	require_once dirname(__FILE__).'/src/forms/FormNavigation.php';
	require_once dirname(__FILE__).'/src/forms/FormModuleInquiries.php';
	require_once dirname(__FILE__).'/src/forms/FormModuleInquiriesField.php';
	require_once dirname(__FILE__).'/src/forms/FormModule.php';
	require_once dirname(__FILE__).'/src/forms/FormInquiriesApi.php';
	require_once dirname(__FILE__).'/src/SiteInfo.php';
	require_once dirname(__FILE__).'/src/SiteModule.php';
	require_once dirname(__FILE__).'/functions.inc.php';
	require_once dirname(__FILE__).'/tcpdf/tcpdf_autoconfig.php';
	require_once dirname(__FILE__).'/tcpdf/tcpdf.php';
	require_once dirname(__FILE__).'/src/FontCharMap.php';
	require_once dirname(__FILE__).'/src/store/StoreApi.php';
	require_once dirname(__FILE__).'/src/store/PaymentGateway.php';
	require_once dirname(__FILE__).'/src/store/StoreRegion.php';
	require_once dirname(__FILE__).'/src/store/StoreCountry.php';
	require_once dirname(__FILE__).'/src/store/StoreNavigation.php';
	require_once dirname(__FILE__).'/src/store/StoreData.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleBuyer.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleOrder.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleOrderItemFiles.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleOrderItemCustomField.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleOrderItem.php';
	require_once dirname(__FILE__).'/src/store/StoreCurrency.php';
	require_once dirname(__FILE__).'/src/store/StorePriceOptions.php';
	require_once dirname(__FILE__).'/src/store/StoreCartTotals.php';
	require_once dirname(__FILE__).'/src/store/StoreCoupon.php';
	require_once dirname(__FILE__).'/src/store/StoreModule.php';
	require_once dirname(__FILE__).'/src/store/StoreBillingInfo.php';
	require_once dirname(__FILE__).'/src/store/StoreCartData.php';
	require_once dirname(__FILE__).'/src/store/StoreCartApi.php';
	require_once dirname(__FILE__).'/src/store/StorePaymentApi.php';
	require_once dirname(__FILE__).'/src/store/StoreBaseElement.php';
	require_once dirname(__FILE__).'/src/store/StoreElement.php';
	require_once dirname(__FILE__).'/src/store/StoreCartElement.php';
	require_once dirname(__FILE__).'/src/store/StoreFileDownloadApi.php';
	require_once dirname(__FILE__).'/src/store/StoreInvoice.php';
	require_once dirname(__FILE__).'/src/store/StoreInvoiceApi.php';
	$siteInfo = SiteInfo::build(array('siteId' => $site_id, 'websiteUID' => $websiteUID, 'domain' => $user_domain, 'prettyDomain' => $pretty_domain, 'homePageId' => $home_page, 'baseDir' => $base_dir, 'baseUrl' => $base_url, 'defLang' => $def_lang, 'baseLang' => $base_lang, 'langs' => $langs, 'pages' => $pages, 'forms' => $forms, 'modRewrite' => $mod_rewrite, 'gaCode' => $ga_code, 'gaAnonymizeIp' => false, 'port' => null, 'pathPrefix' => null, 'useTrailingSlashes' => true, 'disableFormSending' => false,));
	$requestInfo = SiteRequestInfo::build(array('requestUri' => getRequestUri($siteInfo->baseUrl),));
	FormModule::init(array(), $siteInfo);
	SiteModule::init(null, $siteInfo);
	StoreModule::init((object) array(
		'storeElementsLangsAndPages' => array(
			'en' => array(
				'a188dd97916a01fb85848aa7afb9175e'
			)
		),
		'defaultStorePageId' => array(
			'' => 'a188dd97916a01fb85848aa7afb9175e',
			'en' => 'a188dd97916a01fb85848aa7afb9175e'
		),
		'hasTableView' => false,
		'hasPrices' => true,
		'gatewayConfig' => array(
			'Paypal' => (object) array(
				'demo' => false
			)
		),
		'billingFormId' => 'fd943534'
	), $siteInfo);
	checkSiteRedirects($siteInfo, $requestInfo, ${'redirectItems'});
	list($page_id, $lang, $urlArgs, $route) = parse_uri($siteInfo, $requestInfo);
	$page404 = $pageMaint = null;
	foreach ($pages as $k => $p) {
		if ($p['type'] === 2) $page404 = $p;
		if ($p['type'] === 3) $pageMaint = $p;
	}
	$preview = false;
	$requestInfo->{'page'} = (isset($pages[$page_id]) ? $pages[$page_id] : null);
	$requestInfo->{'lang'} = $lang;
	$requestInfo->{'urlArgs'} = $urlArgs;
	$requestInfo->{'route'} = $route;
	handleTrailingSlashRedirect($siteInfo, $requestInfo, ["css","dat","fonts","gallery","gallery_gen","js","phpmailer","phpseclib","src"]);
	SiteModule::setLang($requestInfo->{'lang'}, $base_lang);
	SiteModule::initTranslations(array(
		'-' => array(
			'Edit Website' => 'Edit Website',
			'Not found' => 'Not found',
			'This plugin requires upgrade' => 'This plugin requires upgrade',
			'Order ID' => 'Order ID',
			'Invoice document number' => 'Invoice document number',
			'Payment gateway' => 'Payment gateway',
			'Payer (from gateway)' => 'Payer (from gateway)',
			'Billing Information' => 'Billing Information',
			'Delivery Information' => 'Delivery Information',
			'Same as billing information' => 'Same as billing information',
			'Email' => 'Email',
			'Phone Number' => 'Phone Number',
			'Private person' => 'Private person',
			'Company' => 'Company',
			'Company Name' => 'Company Name',
			'Company Code' => 'Company Code',
			'Company TAX/VAT number' => 'Company TAX/VAT number',
			'First Name' => 'First Name',
			'Last Name' => 'Last Name',
			'Address' => 'Address',
			'City' => 'City',
			'Post Code' => 'Post Code',
			'Region' => 'Region',
			'Country Code' => 'Country Code',
			'Country' => 'Country',
			'days' => 'days',
			'Qty' => 'Qty',
			'Price' => 'Price',
			'Price (low to high)' => 'Price (low to high)',
			'Price (high to low)' => 'Price (high to low)',
			'newest first' => 'newest first',
			'Date' => 'Date',
			'The cart is empty' => 'The cart is empty',
			'SKU' => 'SKU',
			'Product description' => 'Product description',
			'Buyer' => 'Buyer',
			'Seller' => 'Seller',
			'Invoice' => 'Invoice',
			'Remove' => 'Remove',
			'Total' => 'Total',
			'Subtotal' => 'Subtotal',
			'Totals' => 'Totals',
			'Back' => 'Back',
			'Previous' => 'Previous',
			'Next' => 'Next',
			'Next Step' => 'Next Step',
			'Checkout' => 'Checkout',
			'Shipping Method' => 'Shipping Method',
			'Shipping amount' => 'Shipping amount',
			'Order Comments' => 'Order Comments',
			'Close' => 'Close',
			'Zoom in/out' => 'Zoom in/out',
			'Add to cart' => 'Add to cart',
			'Inquire' => 'Enquire',
			'Category' => 'Category',
			'Item Name' => 'Item Name',
			'Text search' => 'Text search',
			'From' => 'From',
			'To' => 'To',
			'Created' => 'Created',
			'Modified' => 'Modified',
			'Description' => 'Description',
			'Search' => 'Search',
			'Sort' => 'Sort',
			'Tax' => 'Tax',
			'Shipping Tax' => 'Shipping Tax',
			'Shipping' => 'Shipping',
			'Choose Payment Method' => 'Choose Payment Method',
			'Order with obligation to pay' => 'Order with obligation to pay',
			'Thank you for your purchase.' => 'Thank you for your purchase.',
			'You can download invoice in PDF format by following this link' => 'You can download invoice in PDF format by following this link',
			'You must agree to terms and conditions' => 'You must agree to terms and conditions',
			'Order Details' => 'Order Details',
			'All' => 'All',
			'Total price of items in the cart should be %s or more' => 'Total price of items in the cart should be %s or more',
			'Buy Now' => 'Buy Now',
			'Paid' => 'Paid',
			'Pending' => 'Pending',
			'Complete' => 'Complete',
			'Canceled' => 'Cancelled',
			'Added!' => 'Added!',
			'Payment received for order %s at %s' => 'Payment received for order %s at %s',
			'New order %s at %s' => 'New order %s at %s',
			'Order_payment' => 'Order',
			'An error occurred. Please try again.' => 'An error occurred. Please try again.',
			'No items found' => 'No items found',
			'Payment has been submitted' => 'Payment has been submitted',
			'Payment has been canceled' => 'Payment has been cancelled',
			'Purchase details' => 'Purchase details',
			'Cash on delivery' => 'Cash on delivery',
			'Bank transfer' => 'Bank transfer',
			'Field \'%s\' is required' => 'Field \'%s\' is required',
			'\'%s\' field value is incorrect.' => '\'%s\' field value is incorrect.',
			'Cart contents' => 'Cart contents',
			'Store Notification System' => 'Store Notification System',
			'Download invoice' => 'Download invoice',
			'In stock' => 'In stock',
			'Out of stock' => 'Out of stock',
			'Coupon' => 'Coupon',
			'Apply' => 'Apply',
			'Discount' => 'Discount',
			'Invalid coupon code' => 'Invalid coupon code',
			'This coupon is not applicable' => 'This coupon is not applicable',
			'Search in Descriptions' => 'Search in Descriptions',
			'Form sending failed' => 'Form sending failed',
			'Form was not sent, are you a robot?' => 'Form was not sent, are you a robot?',
			'Please accept cookie consent to submit the form' => 'Please accept cookie consent to submit the form',
			'File %s is too big' => 'File %s is too big',
			'File %s could not be uploaded for sending' => 'File %s could not be uploaded for sending',
			'Total size of attachments must not exceed %s MB' => 'Total size of attachments must not exceed %s MB',
			'Field %s is not present' => 'Field %s is not present',
			'Failed to create a directory for attachments' => 'Failed to create a directory for attachments',
			'Attachments inode on the server is not a directory' => 'Attachments inode on the server is not a directory',
			'Failed to move uploaded file to attachments directory' => 'Failed to move uploaded file to attachments directory',
			'Receiver not specified' => 'Receiver not specified',
			'Form sending from preview is not available' => 'Form sending from preview is not available',
			'Max file size (Mb): %s' => 'Max file size (Mb): %s',
			'Max number of files: 1' => 'Max number of files: 1',
			'You exceed number of files' => 'You exceeded number of files',
			'I\'m not a robot' => 'I\'m not a robot',
			'Captcha is not available in preview' => 'Captcha is not available in preview',
			'Submit' => 'Submit'
		)
	));
	if (!isHttps() && !headers_sent()) {
		header('Status: 301 Moved Permanently');
		header('Location: '.getCurrUrl(false, 'https'), true, 301);
		exit();
	}


class MenuElement {
	static function setMax($value) {
		self::$maxItems = $value;
	}

	static function render($tree) {
		self::renderItems($tree->{'items'}, 0, $tree->{'type'}, $tree->{'dir'});
	}

	static function renderItems($items, $level, $type, $dir) {
		if (empty($items))
			return;
		self::renderTag("ul", array(
			"class" => $level ? null : $type,
			"dir" => $level ? null : $dir,
		));
		foreach ($items as $item) {
			$liAttrs = array(
				"class" => isset($item->{'class'}) ? $item->{'class'} : null,
				"data-anchor" => isset($item->{'anchor'}) ? $item->{'anchor'} : null,
				"title" => isset($item->{'title'}) ? htmlspecialchars($item->{'title'}) : null,
				"data-wb-anim-entry-time" => isset($item->{'animTime'}) ? $item->{'animTime'} : null,
				"data-wb-anim-entry-delay" => isset($item->{'animDelay'}) ? $item->{'animDelay'} : null,
			);
			$aAttrs = array(
				"href" => isset($item->{'href'}) ? $item->{'href'} : null,
				"target" => isset($item->{'target'}) ? $item->{'target'} : null,
				"data-popup" => isset($item->{'popup'}) ? $item->{'popup'} : null,
			);
			$exceeded = self::$maxItems && isset($item->{'id'}) && $item->{'id'} > self::$maxItems;
			if ($exceeded) {
				$liAttrs["class"] = trim($liAttrs["class"] . " wb-menu-item-exceeded");
				$aAttrs["href"] = 'javascript:void(0)';
				$aAttrs["target"] = null;
				$aAttrs["data-popup"] = null;
				$item->{'icon'} = "star";
				$item->{'iconAlign'} = "left";
				$liAttrs["data-plugin"] = "Menu Items";
			}
			self::renderTag("li", $liAttrs);
			self::renderTag("a", $aAttrs);
			if (isset($item->{'icon'}) && $item->{'iconAlign'} === "left") {
				self::renderIcon($item->{'icon'});
				echo '&nbsp;';
			}
			if ($exceeded) echo '<span>';
			echo $item->{'name'};
			if ($exceeded) echo '</span>';
			if (isset($item->{'icon'}) && $item->{'iconAlign'} === "right") {
				echo '&nbsp;';
				self::renderIcon($item->{'icon'});
			}
			echo '</a>';
			if (isset($item->{'children'}))
				self::renderItems($item->{'children'}, $level + 1, $type, $dir);
			echo '</li>';
		}
		echo '</ul>';
	}

	static $maxItems = 0;

	static function renderIcon($icon) {
		if (empty($icon))
			return;
		if (strpos($icon, "<") !== false)
			echo $icon;
		else {
			self::renderTag('i', array("class" => "fa fa-{$icon}"));
			echo '</i>';
		}
	}

	static function renderTag($tagName, $attributes) {
		echo '<' . $tagName;
		foreach ($attributes as $k => $v)
			if ($v !== null && ($k !== "class" || $v !== ""))
				echo ' ' . $k . '="' . htmlspecialchars($v) . '"';
		echo '>';
	}
}	$requestHandledByModule = false;
	$hr_out = '';
	if (is_callable('FormModule::parseRequest')) { list($m_out, $requestHandled) = call_user_func('FormModule::parseRequest', $requestInfo); $hr_out .= $m_out; $requestHandledByModule = $requestHandledByModule || $requestHandled; }
	if (is_callable('StoreModule::parseRequest')) { list($m_out, $requestHandled) = call_user_func('StoreModule::parseRequest', $requestInfo); $hr_out .= $m_out; $requestHandledByModule = $requestHandledByModule || $requestHandled; }
	$page = $requestInfo->{'page'};
	if (!$requestHandledByModule && !empty($urlArgs)) $page = null;
	if (!$page) {
		if (isSitemapUrl($requestInfo)) genSitemap();
		if ($page404) $page = $page404;
		elseif ($pageMaint) $page = $pageMaint;
	} elseif ($pageMaint) $page = $pageMaint;
	if (!is_null($page)) {
		handleComments($page['id'], $siteInfo);
		if (isset($_POST["wb_form_id"])) handleForms($page['id'], $siteInfo);
	}
	ob_start();
	if ($page) {
		$fl = dirname(__FILE__).'/'.$page['file'];
		$flp = dirname(__FILE__).'/pd.json';
		if (is_file($fl) && is_file($flp)) {
			${'seoTitle'} = $requestInfo->{'title'};
			${'seoDescription'} = $requestInfo->{'description'};
			${'seoKeywords'} = $requestInfo->{'keywords'};
			${'seoImage'} = $requestInfo->{'image'};
			if (isset($_GET['wbPopupMode']) && $_GET['wbPopupMode'] == 1) { $wbPopupMode = true; }
			$pd = @json_decode(@file_get_contents($flp));
			if (!is_object($pd)) die('Data is corrupted');
			$expectedCrc = $pd->{'e'};
			unset($pd->{'e'});
			$crc = sha1('sfh02a35gyhz0a33498g048qt3p048' . json_encode($pd));
			if ($expectedCrc !== $crc) die('Data is corrupted');
			MenuElement::setMax($pd->{'f'});
			ob_start();
			include $fl;
			$out = ob_get_clean();
			$ga_out = '';
			if ($lang && $langs) {
				foreach ($langs as $ln => $default) {
					$pageUri = getPageUri($page['id'], $ln, $siteInfo);
					$out = str_replace('{{lang_'.$ln.'}}', $pageUri, $out);
					$out = str_replace(urlencode('{{lang_'.$ln.'}}'), $pageUri, $out);
				}
			}
			if (is_file($ga_tpl = dirname(__FILE__).'/ga.php')) {
				ob_start(); include $ga_tpl; $ga_out = ob_get_clean();
			}
			$currUrl = getCurrUrl();
			$out = str_replace('<ga-code/>', $ga_out, $out);
			$out = str_replace('{{base_url}}', getBaseUrl(), $out);
			$out = str_replace('{{curr_url}}', $currUrl, $out);
			$out = str_replace('__wb_curr_url__', strpos($currUrl, '?') ? rtrim($currUrl, '/') : $currUrl, $out);
			$out = str_replace('{{hr_out}}', $hr_out, $out);
			if (!empty($pd->a)) {
			    $smallPlugins = array (
  'Line' => 0,
  'Button' => 1,
  'Menu' => 2,
  'Languages' => 3,
  'StoreCart' => 4,
  'BookmarksShare' => 5,
  'FacebookLike' => 6,
  '2checkout' => 7,
  '7_connect' => 8,
  'alipay' => 9,
  'assist' => 10,
  'bank_transfer' => 11,
  'baokim' => 12,
  'bepaid' => 13,
  'braintree' => 14,
  'BuyNow' => 15,
  'cash_on_delivery' => 16,
  'click' => 17,
  'coinpayments' => 18,
  'dragonpay' => 19,
  'easypay' => 20,
  'effect' => 21,
  'epaybg' => 22,
  'epayco' => 23,
  'epsilon' => 24,
  'expresspay' => 25,
  'gestpay' => 26,
  'getbutton' => 27,
  'gplus_badge' => 28,
  'gplus_like' => 29,
  'hipay' => 30,
  'yandex_kassa' => 31,
  'ideal_payment' => 32,
  'iyzico' => 33,
  'klama' => 34,
  'libelula' => 35,
  'linepay' => 36,
  'liqpay' => 37,
  'mellat' => 38,
  'mercado' => 39,
  'mobilpay' => 40,
  'mollie' => 41,
  'mpesa' => 42,
  'odnoklassniki_share' => 43,
  'olark' => 44,
  'pagseguro' => 45,
  'payfast' => 46,
  'paytr' => 47,
  'paytrail' => 48,
  'payu' => 49,
  'payumoney' => 50,
  'platron' => 51,
  'qiwi' => 52,
  'qiwi_kz' => 53,
  'redsys' => 54,
  'robokassa' => 55,
  'skrill' => 56,
  'smartarget' => 57,
  'stripe' => 58,
  'tawkto' => 59,
  'vkontakte_comment' => 60,
  'vkontakte_like' => 61,
  'webmoney_button' => 62,
  'webmoney_widget' => 63,
  'webpay' => 64,
  'wp' => 65,
  'zopim' => 66,
  'pinterest' => 67,
  'pagopar' => 68,
  'cmi' => 69,
);
				$preg_clb = function($m) use($pd, $smallPlugins) {
			        if (
			            (empty($pd->{'a'}) || (isset($pd->{'a'}->{$m[1]}) && $pd->{'a'}->{$m[1]}))
			            && (empty($pd->{'b'}) || !isset($pd->{'b'}->{$m[1]}) || !$pd->{'b'}->{$m[1]})
					) return $m[0];
					$featureName = $pluginId = $m[1];
					$isMenuItem = $featureName === 'Menu Items'; if ($isMenuItem) $pluginId = 'Menu';
					$r = substr($m[0], 0, -1);
					$outside = isset($smallPlugins[$pluginId]);
					$parentCss = $outside ? 'overflow:visible;' : '';
					$linkCss = $outside ? 'right:-3px;top:-3px;transform:translate(0,-100%);' : 'right:0;top:0;';
					$linkCss .= 'font: normal 14px &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;';
					$link = empty($pd->{'d'}) ? '' : (' href="' . htmlspecialchars($pd->{'d'}) . '" target="_blank" onclick="event.stopPropagation();event.returnValue=true;return true;"');
					$minPlan = isset($pd->{'c'}->{$pluginId}[0]) ? $pd->{'c'}->{$pluginId}[0] : 'Business';
					$link = str_replace('__MIN_PLAN__', rawurlencode($minPlan), $link);
					$link = str_replace('__PLAN_FEATURE__', rawurlencode(isset($pd->{'c'}->{$featureName}[1]) ? $pd->{'c'}->{$featureName}[1] : $featureName), $link);
					$link = str_replace('__UTM_CAMPAIGN__', rawurlencode('plugin-' . strtolower(str_replace('_', '-', $pluginId))), $link);
					$link = str_replace('__UTM_CONTENT__', rawurlencode($_SERVER['HTTP_HOST']), $link);
					$r .= ' style="outline: 3px solid #ff7600;'.$parentCss.'" >';
					$linkText = ($isMenuItem ? '' : '<i class="fa fa-star"></i>&nbsp;') . htmlspecialchars(\SiteModule::__('This plugin requires upgrade'));
					$r .= '<a'.$link.' style="position:absolute;'.$linkCss.'z-index:1;border:1px solid #FFF;background:#ff7600;color:#FFF;padding:4px;text-decoration:none;">'.$linkText.'</a>';
					$r .= '<a'.$link.' style="position:absolute;left:0;top:0;right:0;bottom:0;z-index:1;display:block;"></a>';
					return $r;
				};
				$prev_out = $out;
				$out = preg_replace_callback('#<[^>]+data-plugin="([^"]+)"[^>]*>#isu', $preg_clb, $prev_out);
				if ($out === null && in_array(preg_last_error(), array(PREG_BAD_UTF8_ERROR, PREG_BAD_UTF8_OFFSET_ERROR))) {
					$out = preg_replace_callback('#<[^>]+data-plugin="([^"]+)"[^>]*>#is', $preg_clb, $prev_out);
				}
				$prev_out = null;
		    	if (
			        !((empty($pd->{'a'}) || (isset($pd->{'a'}->{'Form'}) && $pd->{'a'}->{'Form'}))
			        && (empty($pd->{'b'}) || !isset($pd->{'b'}->{'Form'}) || !$pd->{'b'}->{'Form'}))
			    ) $out = preg_replace('/<input type="hidden" name="wb_form_(id|uuid)"[^>]*>/isuU', '', $out);
			}
			header('Content-type: text/html; charset=utf-8', true, $page['type'] === 2 ? 404 : ($page['type'] === 3 ? 503 : 0) );
			echo $out;
		}
	} else {
		header("Content-type: text/html; charset=utf-8", true, 404);
		if (is_file(dirname(__FILE__).'/../../error_docs/not_found.html')) {
			include dirname(__FILE__).'/../../error_docs/not_found.html';
		} else if (is_file(dirname(__FILE__).'/404.html')) {
			include dirname(__FILE__).'/404.html';
		} else {
			echo "<!DOCTYPE html>\n";
			echo "<html>\n";
			echo "<head>\n";
			echo "<title>404 \SiteModule::__('Not found')</title>\n";
			echo "</head>\n";
			echo "<body>\n";
			echo "404 \SiteModule::__('Not found')\n";
			echo "</body>\n";
			echo "</html>";
		}
	}
	ob_end_flush();

?>