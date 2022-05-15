<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
?>

<!DOCTYPE html>
<html lang="<?php echo getLangCode(); ?>">

<head>
  <meta charset="UTF-8" />
  <title>E-lolning <?php echo getTranslation(3); ?></title>

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

  <h1><?php echo getTranslation(3); ?></h1>
  <?php if(isset($_SESSION[CONST_SESSION_ISLOGGED])){
				if($_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){

					echo "<a href='/doQuiz?id=53'>Click here for Welcome quiz</a>";
				}
			}
  ?>
  </br>
  <?php
  showCourses();
  ?>

  <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
</body>

</html>


<!-- PHP FUNCTIONS -->

<?php

/* Prints the list of every courses from the database on the page
*/
function showCourses()
{
  $courses = getCourses();
  foreach ($courses as $course) {
    addcourse($course);
  }
}

// Adds a course on the page, including a link redirecting towards its homepage. Passes the id of the course as an argument through the URL.
function addCourse($course)
{
  echo  "<div class='course'>
          <div class='coursename'><a href='/coursehome?id=" . $course["id"] . "' class='courselink'>" . $course["name"] . "</a></div>
          <div class='author'>" . getTranslation(80) . " " . $course["username"] . "</div>
          <div class='description'>" . $course["description"] . "</div>
        </div>";
}
?>