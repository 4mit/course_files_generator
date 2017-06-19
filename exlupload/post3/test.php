<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Kolkata');
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

require_once 'Classes/PHPExcel.php';

if(isset($_POST['test'])){
	$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
	$rendererLibrary = 'tcpdf';
	$rendererLibraryPath = '' . $rendererLibrary;
	$objPHPExcel = new PHPExcel();
	$inputFile="image/new.xlsx";
	$inputFileType = PHPExcel_IOFactory::identify($inputFile);
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($inputFile);
	$objPHPExcel->setActiveSheetIndex(0);
	if (!PHPExcel_Settings::setPdfRenderer($rendererName,$rendererLibraryPath)){
		die(
			'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
			'<br />' .
			'at the top of this script as appropriate for your directory structure'
		);
	}

	header('Content-Type: application/pdf');
	header('Content-Disposition: attachment;filename="01simple.pdf"');
	header('Cache-Control: max-age=0');
	echo 'fdfdf';
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
	if($objWriter->save('php://output')){
	
	}
}
?>
<html>
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>
   <body> 
   	<h1 align="center">Upload after download </h1>    
      <form action="" method="POST" enctype="multipart/form-data">
         
         <center><button type="submit" name="test" id="de" class="btn btn-danger"/><i class="fa fa-file-pdf-o" aria-hidden="true">&nbsp;</i>Generate PDF</button></center>
         
          <center><button type="button" id="fe" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalNorm"/>Wait Until Download then Upload</button></center>
         
      </form>
      
   
<!-- Modal -->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Upload Downloaded File 
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form role="form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                       <input type="file" name="dsds" id="ee" class="form-control"/>                   
                  </div>  
            </div>           
            
            <div class="modal-footer">
                
                <button type="submit" class="btn btn-danger">Upload</button>
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Cancel
                </button>
                </form>
            </div>
        </div>
    </div>
</div>



   
<script>
	document.getElementById("ee").style.opacity ="0";
	$(".modal").css({
		"border":"0px",
		"boxShadow":"0px 0px 15px"
	});
	
	document.getElementById("fe").style.opacity ="0";	
	document.getElementById("de").addEventListener("click",function(){
	
      	    document.getElementById("ee").style.opacity ="1";
      	    document.getElementById("de").style.opacity ="0";
      	    document.getElementById("fe").style.opacity ="1";	
	
	});
		
	function change(){
		document.getElementById("fe").innerHTML ="Upload Now ";	
	
	}
	
	setInterval(change,10000);

</script>
   </body>
</html>
