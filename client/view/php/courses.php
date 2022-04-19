<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>courses</title>

  <!-- CSS -->
  <link rel="stylesheet" href="../css/font-face.css" />
  <link rel="stylesheet" href="../css/shared.css" />
  <link rel="stylesheet" href="../css/courses.css" />

  <!-- JS -->
  <script src="../../../../shared/js/jquery.js"></script>
  <script src="../js/shared.js"></script>
</head>

<body>
  <?php
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/courses.php");
  ?>

  <h1>Courses</h1>

  <?php
    showCourses();
  ?>

  <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
</body>

</html>


<!-- PHP FUNCTIONS -->

<?php

/* Prints the list of every courses in the database on the page
*/
function showCourses()
{
  // Only displays for now as a test. TODO : Show courses as link that take the user to the course page.
  $courses = getCourses();
  foreach($courses as $course){
    echo "<div class='course'><coursename>" . $course["name"] . "</coursename> par " . $course["username"] . "<br>Description : " . $course["description"] . "</div>";
  }
}
?>