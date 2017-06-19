<?php
    error_reporting(E_ALL);
    if(isset($_POST['uploadExc']))
    {
         if(isset($_FILES['image']))
         {
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
            
            $expensions= array("xsl","xsls","XLSX","xlsx");
            
            if(in_array($file_ext,$expensions)=== false){
               $errors[]="Invalid File ";
            }
            
            if($file_size > 2097152){
               $errors[]='File size must be excately 2 MB';
            }
            
            if(empty($errors)==true)
            {
                /*excel import*/

                        $link = new mysqli('localhost','root','','id172066_db_m140374ca');                
                        
                        $databasetable = "file";


                        set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
                        include 'Classes/PHPExcel/IOFactory.php';

                        // This is the file path to be uploaded.
                        $inputFileName =$_FILES['image']['tmp_name'];

                        try {
                           $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
                        } catch(Exception $e) {
                           die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                        }


                        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                        $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


                        for($i=2;$i<=$arrayCount;$i++)
                        {
                              $userName = trim($allDataInSheet[$i]["A"]);
                              $userMobile = trim($allDataInSheet[$i]["B"]);
                              $c3 = trim($allDataInSheet[$i]["C"]);
                              $c4 = trim($allDataInSheet[$i]["D"]);
                              $c5 = trim($allDataInSheet[$i]["E"]);
                              $c6 = trim($allDataInSheet[$i]["F"]);
                              $c7 = trim($allDataInSheet[$i]["G"]);
                              $c8 = trim($allDataInSheet[$i]["H"]);
                              $c9 = trim($allDataInSheet[$i]["I"]);
                              $c10 = trim($allDataInSheet[$i]["J"]);



                           /*$query = "SELECT name FROM YOUR_TABLE WHERE name = '".$userName."' and email = '".$userMobile."'";
                           $sql = mysql_query($query);
                           $recResult = mysql_fetch_array($sql);
                           $existName = $recResult["name"];*/
                           $k="";
                           if($k=="") {
                              $insertTable= mysqli_query($link,"insert into grand_excel values('".$userName."', '".$userMobile."', '".$c3."', '".$c4."', '".$c5."', '".$c6."', '".$c7."', '".$c8."', '".$c9."', '".$c10."');");

                              if(!$insertTable)
                                    die();
                              
                           } else {
                              $msg = 'Record already exist. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
                           }
                       }
                     

                /*Excel import ends  here*/  

               if (move_uploaded_file($file_tmp,"uploaded_xls_files/".$file_name))
                 header('location:../addSchedule.php?exupload&fileName='.$file_name);
            }else{
                header('location:../addSchedule.php?errexupload');
            }
         }
            
}
   


   /**/

         
         
         
                  // if (file_exists($_FILES["file"]["name"])) {
                  // unlink($_FILES["file"]["name"]);
                  // }
                  // $storagename = "discussdesk.xlsx";
                  // move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
                  // $uploadedStatus = 1;

                 
     

?>

