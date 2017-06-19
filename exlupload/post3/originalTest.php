<?php


/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once 'Classes/PHPExcel.php';


//	Change these values to select the Rendering library that you wish to use
//		and its directory location on your server
$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
//$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
//$rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
$rendererLibrary = 'tcpdf';
//$rendererLibrary = 'mPDF.php';
//$rendererLibrary = 'domPDF0.6.0beta3';
$rendererLibraryPath = '' . $rendererLibrary;

//echo $rendererLibraryPath;
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

/*
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PDF Test Document")
							 ->setSubject("PDF Test Document")
							 ->setDescription("Test document for PDF, generated using PHP classes.")
							 ->setKeywords("pdf php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'ssss');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->getActiveSheet()->setShowGridLines(false);
*/
 //If used external excel file 
$inputFile="new.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($inputFile);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFile);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


if (!PHPExcel_Settings::setPdfRenderer(
		$rendererName,
		$rendererLibraryPath
	)) {
	die(
		'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
		'<br />' .
		'at the top of this script as appropriate for your directory structure'
	);
}


// Redirect output to a client’s web browser (PDF)
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename="01simple.pdf"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save('php://output');
exit;
