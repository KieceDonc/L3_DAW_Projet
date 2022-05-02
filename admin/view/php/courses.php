<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Dashboard - E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/coursesAdmin.css" />
	  <link rel="stylesheet" href="../css/sharedAdmin.css" />
    <link rel="stylesheet" href="../../client/view/css/font-face.css" />
    <link rel="stylesheet" href="../../client/view/css/darkMode.css" />
  </head>
  <body>
	<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/controller/courses.php");
  ?>
	<div class="content">
    <h1> Your courses </h1>
    <?php ini_set('display_errors', 1);showCourses(); ?>
	</div>

<!-- JS -->
	<script src="../../../../shared/js/jquery.js"></script>
	<script src="../js/courses.js"></script>
  </body>
</html>

<?php 

function showCourses(){
  $courses = getCourses();

  if(count($courses) == 0){
    echo "<p> You didn't create a course yet. To do so, please see <a href='/admin/courseBuilder'> course builder page </a></p>";
  }
  else{
    // Only displays for now as a test. TODO : Show courses as link that take the user to the course page.
    foreach($courses as $course){
      echo "<div class='courses'><span class='courseName'>" . $course["name"] . "</span></div>";
    }
  }
}

?>