    <?php
 echo $_GET['id'];
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    date_default_timezone_set('Asia/Kolkata');
    if (PHP_SAPI == 'cli')
        die('This example should only be run from a Web Browser');
    require_once 'Classes/PHPExcel.php';
    include_once('../db_connect.php');

    $e = $_COOKIE['id'];
    
    if(isset($_POST['test']))
    {

            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibrary = 'tcpdf';
            $rendererLibraryPath = '' . $rendererLibrary;
            $objPHPExcel = new PHPExcel();
            $inputFile="uploaded_xls_files/".$_GET['filename'];

            $inputFileType = PHPExcel_IOFactory::identify($inputFile);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
            $objPHPExcel->setActiveSheetIndex(0);
            if (!PHPExcel_Settings::setPdfRenderer($rendererName,$rendererLibraryPath))
                die('NOTICE: Please set the $rendererName and $rendererLibraryPath values<br />at the top of this script as appropriate for your directory structure');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
            ob_start();

            header('Content-Type: application/pdf');
            // header('Content-Disposition: attachment;filename="01simple.pdf"');
            // header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            
            //$objWriter->save(str_replace('.php', '.pdf', __FILE__));
            $myPdfData = ob_get_contents();
            ob_end_clean();
            $dir = 'PDFS';
            $file_location =$dir.'/faculty_'.$e.'_generated_pdf_file.pdf';
            //$objWriter->save(str_replace(__FILE__,'.pdf',__FILE__));
            if(file_put_contents($file_location, $myPdfData))
            {
                $sql = "select * from assign where f_id = '$e'";
                $result=mysqli_query($db,$sql) or die("error");
                $cid = mysqli_fetch_assoc($result)['c_id'];
                $new_file_name = 'faculty_'.$e.'_generated_pdf_file.pdf';
                $current_date = date("Y-m-d H:i:s");                                   
                $size = filesize($file_location);

                $fp      = fopen($file_location, 'r');
                $content = fread($fp, filesize($file_location));
                $content = addslashes($content);
                fclose($fp);
                $filetype = mime_content_type($file_location);
                //$file_type = pathinfo($file_location, PATHINFO_EXTENSION);
                $fileid=$_GET['id'];
                $query = "INSERT INTO `file`  VALUES ('$e','$fileid', '$cid', '$size', '$filetype', '$current_date', '$content', '$new_file_name')";
                if(!mysqli_query($db,$query)) die('Not Working Query '); 


                header('location:../addSchedule.php?success=true&updateTime='.$current_date.'&isSubmitted=File is Submitted');

            }else{

                echo 'oops! something went wrong .... Try Again (exupload.php file )';

            }        
    }
    ?>
