<?php
require_once('fpdf16/fpdf.php');
require_once('FPDI_1.3.1/fpdi.php');

class concat_pdf extends FPDI {

	var $files = array();
	
	function setFiles($files){
		$this->files = $files;
	}
	
	function addFile($file){
		$this->files []= $file;
	}
	
	function concat(){
		foreach($this->files as $file){
			$pagecount = $this->setSourceFile($file);
			for ($i = 1; $i <= $pagecount; $i++){
				$tplidx = $this->ImportPage($i);
				$s = $this->getTemplatesize($tplidx);
				$this->AddPage('P', array($s['w'], $s['h']));
				$this->useTemplate($tplidx);
			}
		}
	}

}

$pdf = new concat_pdf();

// set some files (in this case just one)
$pdf->setFiles(array('pdfs/lorem.pdf'));
// add another file
$pdf->addFile('pdfs/ipsum.pdf');
// concatenate the files
$pdf->concat();

// return the new pdf as a download
$pdf->Output('newpdf.pdf', 'D');

?>
