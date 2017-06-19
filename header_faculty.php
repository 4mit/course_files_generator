<!DOCTYPE html>
  <?php
  include_once('chkfaculty.php');
  include_once('passwordChangeWindow.php');
  include_once('db_connect.php');
  include_once('css_js.php');
  
  $id = $_COOKIE['id'];

      
  $result = $db->query("select * from faculty where f_id like '$id'");
  $nname = $result->fetch_assoc();
  $name =  $nname['name'];
  //echo $name;
  ?>


  <!--  
-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-slide-dropdown">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Course File Generator</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-slide-dropdown">
        <ul class="nav navbar-nav">
            <li class="active"><a href="faculty.php">Home</a></li>
             

              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Upload<span class="caret"></span></a>
                <ul class="dropdown-menu">       
                  <li><a href="addSchedule.php">File</a></li>
                
                  <li><a href="upload_course.php">Course Outcome</a></li>
                </ul>
              </li>


              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Course File<span class="caret"></span></a>
                <ul class="dropdown-menu">       
                  <li><a href="PDFMerger/fpdf/tuto3.php">Generate Course File</a></li>
                  <li><a href="fac_upload/execel.php">Generate PO Attainment</a></li>
                  <li role="separator" class="divider"></li>
                  <!--<li><a href="download.php">Download Course File</a></li>-->
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile<span class="caret"></span></a>
                <ul class="dropdown-menu">       
                  <li><a href="showProfile.php">View profile</a></li>
                  <li role="separator" class="divider"></li>
              <li><a href="newEditProfile.php">Edit profile</a></li>
                </ul>
              </li>
          
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#Sign1" data-toggle="modal" >Change Password</a></li>
              <li><a>Logged in as <?php echo ucwords($name); ?></a></li>
              <li><a href = "logout.php">Logout</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- -->

  