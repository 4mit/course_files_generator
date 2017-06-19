<?php
    error_reporting(E_ALL);
    if(isset($_POST['uploadExc']))
    {

         $link = new mysqli('localhost','root','','id172066_db_m140374ca');                  
                        
         if(isset($_FILES['image']))
         {
                $errors= array();
                $file_name = $_FILES['image']['name'];

                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];//$_FILES['image']['name']
                $file_ext=pathinfo($file_name, PATHINFO_EXTENSION);
                $co_id = $_GET['co_id'];
                $fid = $_GET['fid']; 
                  

                 $sqll =  "SELECT `c_id` FROM `assign` WHERE f_id ='$fid'";
                 $result  = mysqli_query($link,$sqll);                 
                 $row =mysqli_fetch_assoc($result);
                 
                 $sub_id =    $row['c_id'];
                          

                $expensions= array("xls","xlsx","XLSX","XLS");

                if(in_array($file_ext,$expensions)=== false){
                   $errors[]="Invalid File ";
                }
                
                if($file_size > 2097152){
                   $errors[]='File size must be excately 2 MB';
                }
                
                if(empty($errors)==true)
                {
                    /*excel import*/

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
                            

                            if($file_name=="course_file.xlsx" || $file_name=="course_file.xls")
                            {
                                  for($i=1;$i<=$arrayCount;$i++)
                                  {
                                        $student_id = trim($allDataInSheet[$i]["A"]);
                                        $t1 = trim($allDataInSheet[$i]["B"]);

                                        $t2 = trim($allDataInSheet[$i]["C"]);
                                        $a1 = trim($allDataInSheet[$i]["D"]);
                                        $a2 = trim($allDataInSheet[$i]["E"]);
                                        $fe = trim($allDataInSheet[$i]["F"]);
                                        

                                     $k="";
                                     if($k=="")
                                     {
                                      
                                        $newQuery = "INSERT INTO `outcome`  VALUES ('$sub_id', '$student_id','$co_id', '$t1', '$t2', '$a1', '$a2', '$fe')";
                                        mysqli_query($link,$newQuery);
                                        header('location:../upload_course.php?uploaded');    
                                        
                                     }else{
                                        
                                        $msg = 'Record already exist. <div style="Padding:20px 0 0 0;"><a href="">Back</a></div>';
                                     }
                                  } 
                               
                               $newQuery = "UPDATE `course_outcome` SET `status` = 'y' WHERE `sub_id` = '$sub_id' AND `co_id` = '$co_id'";
                               if(!mysqli_query($link,$newQuery)){ echo 'die00'; die();}                      
                            }
                   move_uploaded_file($file_tmp,"uploaded_xls_files/".$file_name);
                  
                }else{
                  var_dump($errors);
                }
        }              
} 
?>

