<?php
require_once '../../assets/plugins/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

ob_start();
include 'print_view.php';
$content = ob_get_clean();
$nombre = "factura_compras.pdf";

$html2pdf = new Html2Pdf ('P', 'A4', 'es');//tipo de papel
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content);
$html2pdf->output($nombre);

?>
