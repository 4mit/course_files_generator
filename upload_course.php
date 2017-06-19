<?php $facultyId = $_COOKIE['id'];

if(isset($_GET['jkl']))
            {

                echo '<div class="alert alert-danger alert-dismissable fade in" id="notic_update">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Great ..! File is Uploaded Successfully
                      </div>';

            }

?>

<html>
<head>
<title>Download File From MySQL</title>
<meta http-equiv="Content-Type" content="text/html charset=iso-8859-1">
<style>
    tr:nth-child(even) {background: #CCC}
    tr:nth-child(odd) {background-color: rgba(36, 138, 138, 0.4) }
    th{background-color: rgba(36, 37, 138, 0.4)}

    table{box-shadow:0px 0px 7px #030000}
    body{
      
    }
  </style>

<?php
    include_once('chkfaculty.php');
    include_once('db_connect.php');
    include_once('css_js.php');
    include_once('header_faculty.php');
?>  
  </head>

<body>

<div class="row">
  <div class="container">
        
    <div class="col-sm-11 col-md-11">
          
  
     <table class="table table-hover">
         <caption><center><b>Course Files</b></center>.</caption>
         <thead>
         <tr>
           <th>COs</th>
           <th>CO Name</th>
           <th></th>
           <th></th>
          
         </tr>
         </thead>



         <?php
               include_once('db_connect.php');
               $facultyId = $_COOKIE['id'];

               $result1 = mysqli_query($db,"SELECT `c_id` FROM `assign` WHERE `f_id`='$facultyId'");

               $row = mysqli_fetch_assoc($result1);
               $cid = $row['c_id'];
               //echo $cid;
                
               
               $result = mysqli_query($db,"SELECT `co_id`, `name`, `status`  FROM `course_outcome` WHERE `sub_id`='$cid'");
                
               while($row2 = mysqli_fetch_assoc($result))
               {

                    echo '<tr style="padding-top:90px;">
                          <td>'.$row2['co_id'].'</td>
                          <td>'.$row2['name'].'</td>
                          <td>';

                           if($row2['status']=='y'){
                                echo 'File Submitted<td></tr>';  
                           }else{

                               echo '<form method="post" enctype="multipart/form-data" action="fac_upload/upload.php?co_id='.$row2['co_id'].'&fid='.$facultyId.'">
                                  <input name="image" type="file" id="userfile">  
                                  <td>';                                  
                                  echo '<button name="uploadExc" type="submit" class="box btn btn-info" id="upload"> upload excel </button></td> 
                                </form></td></tr>';                                               

                           } 
              }
              
          ?>
    </table>  
</div>
</div>
</div>


<script>

  $('button#save-data').click(function()
  {       
      $(this).remove();
  });


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