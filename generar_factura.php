<?php
	require __DIR__.'/vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;

	
	$form_data = json_decode(file_get_contents("php://input"));
	
	$dato_html = $form_data->html;
	$dato_html = str_replace("button","h4",$dato_html);
	
	$html2pdf = new Html2Pdf();
	$html2pdf->writeHTML($dato_html);
	$html2pdf->output();
?>