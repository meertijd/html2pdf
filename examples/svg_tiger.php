<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 */
require_once dirname(__FILE__).'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

// get the HTML
ob_start();
require dirname(__FILE__).'/res/svg_tiger.php';
$content = ob_get_clean();

// convert to PDF
try {
    $html2pdf = new Html2Pdf('L', 'A4', 'fr');
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('svg_tiger.pdf');
} catch (Html2PdfException $e) {
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
