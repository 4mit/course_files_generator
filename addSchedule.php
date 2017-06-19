<!DOCTYPE html>
<html>
<head>
<style>
    tr:nth-child(even) {background: #CCC}
    tr:nth-child(odd) {background-color: rgba(36, 138, 138, 0.4); }
    th{background-color: rgba(36, 37, 138, 0.4);}

    table{box-shadow:0px 0px 7px #030000;}
    body{

    }
</style>
</head>
<body>
<div class="container">
<?php
    error_reporting(~E_NOTICE);
    include_once('chkfaculty.php');
    include_once('db_connect.php');
    include_once('css_js.php');
    include_once('header_faculty.php');
    
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12" style="border-radius: 25px;">
            <?php
            if(isset($_GET['download'])){
                echo "<script>location.href='./faculty.php';</script>";
                
            }
            if(isset($_GET['exupload']))
            {

                echo '<div class="alert alert-danger alert-dismissable fade in" id="notic_update">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Great ..! File is Uploaded Successfully
                      </div>';

            }
            date_default_timezone_set('Asia/calcutta');

            $facultyId = $_COOKIE['id'];
            $eventID  = array();
            $eventFileType  = array();

            function get_eventId($facultyId)
            {
                //echo 'get_eventId'.$facultyId;
                $conn  =  new mysqli("localhost","root","","id172066_db_m140374ca");						
                $sql =  "SELECT * FROM `calendar`";
                $result  = $conn->query($sql);

                $d = array();
                while($events  = $result->fetch_assoc())
                {
                    $d[] =  $events['id'];

                    $type[]  = $events['ftype'];

                }				

                echo '<table class="table" style="overflow-y:scroll">
                        <thead>
                            <tr>
                                <th>TITLE</th>
                                <th>FILE TYPE</th>
                                <th>DATE </th>
                                <th>UPLOAD</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';



                        for($r = 0 ;$r<count($d) ;$r++)
                         {
                                $sqll =  "SELECT * FROM `file` WHERE s_id ='".$d[$r]."' AND f_id='".$facultyId."'";
                                $result  = $conn->query($sqll);					

                                if($result->num_rows>0)
                                {

                                    $queryForTitle = "SELECT `title`, `ftype`, `startdate`, `enddate` FROM `calendar` WHERE id='".$d[$r]."'";	
                                    $extra  = $conn->query($queryForTitle);


                                    while($title_obt  = $extra->fetch_assoc())
                                    {
                                            echo   '<tr><td>'.$title_obt['title'].'</td>
                                                    <td>'.$title_obt['ftype'].'</td>
                                                    <td>'.$title_obt['startdate'].'</td>
                                                    <td>File Submitted</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td></tr>';													
                                    }
                                }else{

                                    $rr = "SELECT ftype,title FROM `calendar` WHERE id ='".$d[$r]."'";
                                    $result2 = $conn->query($rr);

                                    while($result22 = $result2->fetch_assoc())
                                    {

                                        if($result22['ftype'] ==".pdf")
                                        {

                                            echo '<tr>
                                                    <td>'.$result22['title'].'</td>
                                                    <td>.pdf</td>
                                                    <td>....</td>
                                                    <td>
                                                        <form method="post" enctype="multipart/form-data" action="upload.php?sid='.$d[$r].'">				
                                                        <input name="userfile" type="file" id="userfile" class="form-control"> 

                                                    </td>
                                                    <td>
                                                        <button name="upload" type="submit" class="box btn btn-info" id="upload" value=" Upload PDF">
                                                            
                                                            upload pdf
                                                        </button>
                                                        </form>
                                                    </td>
                                                    <td>......</td>
                                                    <td>......</td>
                                                </tr>';
                                                        
                                        }else{
                                                
                                                echo '<tr id="excelrow"><td>'.$result22['title'].'</td><td>.xls</td>';
                                                //if($_GET['success']!=true){                                                      
                                                
                                                
                                                echo '<td>
                                                        <form method="post" enctype="multipart/form-data" action="exlupload/upload.php">
                                                            <input name="image" type="file" id="userfile">   
                                                      </td>

                                                      <td>
                                                            <button name="uploadExc" type="submit" class="box btn btn-info" id="upload">
                                                                upload excel
                                                            </button></td>
                                                        </form>

                                                      </td>

                                                      <td>
                                                         <form action="exlupload/test.php?filename='.$_GET['fileName'].'&id='.$d[$r].'" method="POST" enctype="multipart/form-data">
                                                             <button type="submit" name="test" id="dede" class="btn btn-danger"/>
                                                                convert to pdf
                                                             </button>
                                                      </td>
                                                      <td>                
                                                         </form>
                                                </td><td>----</div>';                                           
                                            }
                                        }
                                    }	
                            }	// for loop ends here .......	
                                }
                            get_eventId($facultyId);

                            ?>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Modal 
          -->
<script>

    setTimeout(function(){
      
      $('#notic_update').slideUp('slow',function(){
        $('#notic_update').remove();
      });
    }, 3000);
    
    $(".modal").css({
        "border":"0px",
        "boxShadow":"0px 0px 15px"
    });

     $("#fe").hide();
     $("button#fef").hide();

     </script>


</body>
</html>
