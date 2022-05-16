<?php 
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
	session_start();
	
	if(!isset($_SESSION[CONST_SESSION_ISLOGGED]) || $_SESSION[CONST_SESSION_ISLOGGED] != CONST_SESSION_ISLOGGED_YES){
		header("Location:/login?callback=".$_SERVER['REQUEST_URI']);
		die;
	}

	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
?>

<nav>
	<h1><a href="/" class="brand">E-lolning</a></h1>
	<ul>
		<?php 
			$path = explode("/",$_SERVER['REQUEST_URI']); 
			$filename = str_replace(".php", "", $path[count($path) - 1]);
			$pos = strpos($filename, "?");
			if($pos != false)
				$filename = substr($filename, 0, $pos); 
		?>
		<li <?php if($filename == "profile") echo "class='selected'";?>><a href="profile"> <?php echo getTranslation(5); ?> </a></li>
		<li <?php if($filename == "courses") echo "class='selected'";?>><a href="courses"> <?php echo getTranslation(135); ?> </a></li>
		<li <?php if($filename == "courseBuilder") echo "class='selected'";?>><a href="courseBuilder"> <?php echo getTranslation(136); ?> </a></li>
		<li <?php if($filename == "mediaUpload") echo "class='selected'";?>><a href="mediaUpload"> <?php echo getTranslation(137); ?> </a></li>
		<li <?php if($filename == "mediaDisplay") echo "class='selected'";?>><a href="mediaDisplay"> <?php echo getTranslation(138); ?> </a></li>
		<?php 
				if(getAdminID($_SESSION[CONST_SESSION_EMAIL]) == 1)
				{
					if($filename == "manageContact"){
						echo "<li class='selected'>";
					}
					else{
						echo "<li>";
					}
					
					echo '<a href="manageContact"> '. getTranslation(139) .'</a></li>';
				}
		?>
	</ul>
</nav>
<div class="content">
	<header>
		<p class = "Welcome">
		<?php echo getTranslation(140); ?> <?php echo getDBUserName($_SESSION[CONST_SESSION_EMAIL]); ?> ! <br />
		<p>
	</header>
</div>