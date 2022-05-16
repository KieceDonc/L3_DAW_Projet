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
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
  ?>
	<div class="content">
    <h1> <?php echo getTranslation(135) ?> </h1>
    <?php 
    showCourses(); ?>
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
    echo "<p> " . getTranslation(133) . "<a href='/admin/courseBuilder'>".getTranslation(134).  "</a></p>";
  }
  else{
    // Only displays for now as a test. TODO : Show courses as link that take the user to the course page.
    foreach($courses as $course){
      echo "<div class='courses'><span class='courseName'>" . $course["name"] . "</span></div>";
    }
  }
}

?>