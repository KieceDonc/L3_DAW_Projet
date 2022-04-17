<nav>
	<h1> E-lolning </h1>
	<ul>
		<?php $path = explode("/",$_SERVER['REQUEST_URI']); $filename = str_replace(".php", "", $path[count($path) - 1]);?>
		<li <?php if($filename == "profile") echo "class='selected'";?>><a href="profile.php"> Profile </a></li>
		<li <?php if($filename == "courses") echo "class='selected'";?>><a href="courses.php"> Your courses </a></li>
		<li <?php if($filename == "courseBuilder") echo "class='selected'";?>><a href="courseBuilder.php"> Create a new course </a></li>
	</ul>
</nav>
<div class="content">
	<header>
	Welcome User 
	</header>
</div>