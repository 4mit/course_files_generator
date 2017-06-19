<!DOCTYPE html>
  <?php
  //include_once('login.php');
  include_once('db_connect.php');
  include_once('css_js.php');
   include_once('passwordChangeWindowAdmin.php');
  ?>
  <nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Course File Generator</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="fullcalendar\index.php">Schedule</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">ADD<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="addcourse.php">Course</a></li>
          <li role="separator" class="divider"></li>
                 <!-- <li class="dropdown-header">Nav header</li> -->
          <li><a href="addfaculty.php">Faculty</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="adddepartment.php">Department</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">View<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="courseDetails.php">Course</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="temp.php">Faculty</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="assignedDetails.php">Assigned Courses</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="viewDepartment.php">Department</a></li>
        </ul>
      </li>
      <li><a href="assign.php">Assign</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		  <li><a href="#Sign2" data-toggle="modal" >Change Password</a></li>
        <li><a>Logged in as ADMIN</a></li>
        <li><a href = "logout.php">Logout</a></li>
      </ul>
  </div>
</nav>
  




