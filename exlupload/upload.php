<?php
    error_reporting(~E_NOTICE);
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
            

            $expensions= array("xls","xlsx","XLSX","XLS");
            
            if(in_array($file_ext,$expensions)=== false){
               $errors[]="Invalid File ";
            }
            
            if($file_size > 9097152){
               $errors[]='File size must be excately 2 MB';
            }
            
            if(empty($errors)==true)
            {
                /*excel import*/

                        $link = new mysqli('localhost','root','','id172066_db_m140374ca');
                         $facultyId = $_COOKIE['id'];     
                         //echo $facultyId;

                         $course_id = "SELECT `c_id` FROM `assign` WHERE `f_id` = '".$facultyId."'"; 
                         $query1=$link->query($course_id);       
                         $result = $query1 -> fetch_assoc();

                        set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
                        include 'Classes/PHPExcel/IOFactory.php';
                        // This is the file path to be uploaded.
                        $inputFileName =$_FILES['image']['tmp_name'];
                        try {
                           $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
                        } catch(Exception $e) {
                           die('Error loading file "'.pathinf44o($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                        }
                        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                        $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
                        

                        if($file_name=="student.xlsx" || $file_name=="student.xls")
                        {
                             
                             echo $arrayCount;
                              for($i=2;$i<=$arrayCount;$i++)
                              {
                                    $userName = trim($allDataInSheet[$i]["A"]);
                                    $userMobile = trim($allDataInSheet[$i]["B"]);
                                 
                                 $k="";
                                 if($k=="")
                                 {
                                 
                        $sql = "INSERT INTO `student` (`sub_id`, `s_id`, `sname`) VALUES ('".$result['c_id']."', '$userName', '$userMobile')";
                                    //$insertTable= mysqli_query($link,"INSERT INTO `student` (`sid`, `sname`) VALUES ('".$userName."', '".$userMobile."')");
                                    //$newQuery = "INSERT INTO `marks` (`sub_id`, `sid`, `t1`, `t2`, `a1`, `a2`, `fe`) VALUES ('cs3004', 'm150478ca', '23', '23', '23', '23', '23');";
                                    $insertTable= mysqli_query($link,$sql);  
                                    
                                 }else{
                                    
                                    $msg = 'Record already exist. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
                                 }
                             } 
                        }

                        else if($file_name=="end_sem.xls" || $file_name=="end_sem.xlsx")
                        {
                              for($i=2;$i<=$arrayCount;$i++)
                              {
                                    $userName   =trim($allDataInSheet[$i]["A"]);
                                    $userMobile =trim($allDataInSheet[$i]["B"]);
                                    $c3         =trim($allDataInSheet[$i]["C"]);
                                    $c4         =trim($allDataInSheet[$i]["D"]);
                                    $c5         =trim($allDataInSheet[$i]["E"]);
                                    $c6         =trim($allDataInSheet[$i]["F"]);
                                    

                                
                                 $k="";
                                 if($k=="")
                                 {
                                  
                                    $insertTable= mysqli_query($link,"INSERT INTO `marks` VALUES ('".$result['c_id']."','".$userName."', '".$userMobile."','".$c3."','".$c4."','".$c5."','".$c6."')");

                                    if(!$insertTable)
                                          die();
                                    
                                 } else {
                                    $msg = 'Record already exist. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
                                 }
                             }
                        }else{
                          echo 'Please follow naming convention ...';
                          die();
                        }
                /*Excel import ends  here*/  

               if (move_uploaded_file($file_tmp,"uploaded_xls_files/".$file_name))
                 header('location:../addSchedule.php?exupload&fileName='.$file_name);
            }else{
                header('location:../addSchedule.php?errexupload');
            }
         }          
} 
?>

