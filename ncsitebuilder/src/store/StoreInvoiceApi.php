<?php

class StoreInvoiceApi {
	protected $viewPath;

	public function __construct() {
		$this->viewPath = dirname(__FILE__).'/view';
	}

	/**
	 * @param StoreNavigation $request
	 * @return no-return
	 */
	public function process(StoreNavigation $request) {
		$invoiceHash = $request->getArg(1);

		$order = StoreModuleOrder::findByHash($invoiceHash);
		$valid = $order && $order->getInvoiceDocumentNumber();
		if( $valid ) {
			foreach( $order->getItems() as $item ) {
				if( !($item instanceof StoreModuleOrderItem) ) {
					$valid = false;
					break;
				}
			}
		}

		if( !$valid ) {
			@header("Connection: close", true, 404);
			exit;
		}

		if( $order->getLang() ) {
			$request->lang = $order->getLang();
			SiteModule::setLang($request->lang);
		}

		$pdf = new StoreInvoice();

		$pdf->SetCreator("TCPDF");
		$pdf->SetAuthor("");
		$pdf->SetTitle(StoreModule::__('Invoice') . " " . $order->getInvoiceDocumentNumber());
		$pdf->SetSubject(StoreModule::__('Invoice') . " " . $order->getInvoiceDocumentNumber());
		// $invoice->SetKeywords('TCPDF, PDF, example, test, guide');

		ob_start();

		$invoiceLogo = StoreData::getInvoiceLogo();
		$logoImage = null;
		if ($invoiceLogo) {
			$logoImage = __DIR__.'/../../'.$invoiceLogo;
			$documentRoot = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : null;
			if ($documentRoot && mb_strpos($logoImage, $documentRoot) === false
					&& mb_strpos($logoImage, '/public_html/') !== false
					&& mb_strpos($documentRoot, '/private_html/') !== false) {
				// TCPDF library can modify image path if beginning of image path
				// doesn't match DOCUMENT_ROOT. However, it fixes it improperly.
				// Therefore we try to fix it at once at this place.
				// Specifically, this issue was detected on DirectAdmin, which has
				// public_html and private_html folders, where private_html is a symlink to public_html.
				$logoImage2 = str_replace('/public_html/', '/private_html/', $logoImage);
				if (is_file($logoImage2)) {
					$logoImage = $logoImage2;
				}
			}
			if (!is_file($logoImage)) {
				$logoImage = null;
			}
		}
		$logoImageAlign = $invoiceLogo ? StoreData::getLogoAlign() : '';

		$this->renderView($this->viewPath.'/invoice.pdf.php', array(
			"pdf" => $pdf,
			"order" => $order,
			"invoiceTitlePhrase" => StoreData::getInvoiceTitlePhrase(),
			"invoiceTextBeginning" => StoreData::getInvoiceTextBeginning(),
			"invoiceTextEnding" => StoreData::getInvoiceTextEnding(),
			"sellerCompanyInfo" => StoreData::getCompanyInfo(),
			"logoImage" => $logoImage,
			"logoImageAlign" => $logoImageAlign,
			"formattedDate" => StoreData::getFormattedDate($order->getDateTime())
		));
		if (function_exists('ini_set')) @ini_set("display_errors", false);

		$html = ob_get_clean();

		$pdf->AddPage();

		$er = @error_reporting();
		@error_reporting($er & ~E_NOTICE);
		$pdf->writeHTML($html);

		$signImage = StoreData::getSignImage();
		if ($signImage) {
			$signImage = dirname(dirname(__DIR__)) . '/' . $signImage;
			$align = StoreData::getSignImageAlign();
			$align = $align === 'left' ? 'L' : ($align === 'right' ? 'R' : 'C');

			list(, $image_h) = getimagesize($signImage);
			$height = StoreData::getSignImageHeight();
			$height = min($image_h, $height);

			$pdf->Image($signImage, '', '', '', $pdf->pixelsToUnits($height), '', '', '', false, 300, $align, false, false, 0, 'CM');
		}

		@error_reporting($er);
		$pdf->lastPage();
		$pdf->endPage();
		$pdf->Close();

		$invoiceFileNumber = (string)$order->getInvoiceDocumentNumber();
		if( extension_loaded("intl") && class_exists("Transliterator") )
			$invoiceFileNumber = Transliterator::create('Any-Latin;Latin-ASCII')->transliterate($invoiceFileNumber);
		$invoiceFileNumber = preg_replace("#[^a-z0-9_\\-]#isu", "_", mb_strtolower($invoiceFileNumber, "utf-8"));

		StoreModule::respondWithPDF($pdf, "invoice_" . $invoiceFileNumber . ".pdf"); // ends with exit()
	}

	/**
	 * Render template.
	 * @param string $templatePath path to template file.
	 * @param array $vars associative array with template variable values.
	 */
	protected function renderView($templatePath, $vars) {
		extract($vars);
		require $templatePath;
	}
}
