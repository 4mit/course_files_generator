<?php
include 'PDFMerger/PDFMerger.php';

$pdf = new PDFMerger;

$pdf->addPDF('samplepdfs/one.pdf', '1')
	->addPDF('samplepdfs/two.pdf', '1')
	//->addPDF('samplepdfs/three.pdf', 'all')
	->merge('file', 'samplepdfs/TEST2.pdf');
	
	//REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
	//You do not need to give a file path for browser, string, or download - just the name.
?>