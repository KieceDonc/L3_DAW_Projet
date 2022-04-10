<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning Forum</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/forum.css" />
  </head>
  <body>
   
  <?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/mysqli.php");
	$mysqli = getMysqli();
  ?>
  
  <div>
    <h1> Forum </h1>
    <?php
	date_default_timezone_set("Etc/GMT-2");
    if(isset($_GET["topic"]) && !empty($_GET["topic"]))
    {
        if(isset($_POST["msg"]) && !empty($_POST["msg"]))
		{
			addAnswer($_POST["msg"]);	//TODO: sanitize input
		}
        //TODO: sanitize input
		$requete = "SELECT * FROM topics WHERE id=" . $_GET["topic"] . ";";
		$result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
		$topic = $result->fetch_row(); 
        showTopic($topic, $messages); 
    }
    else 
    {
		$requete = "SELECT * FROM topics;";
		$result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
		$topics = $result->fetch_assoc(); 
	
        listTopics($topics);
    }
	
	closeMysqli($mysqli);
    ?>
  </div>

    <!-- JS -->
	<script src="../js/jquery.js"></script>
    <script src="../js/shared.js"></script>
	<script src="../js/forum.js"></script>
  </body>
</html>

<?php

function listTopics($topics) 
{
    ?>
	<form method="get">
		<h2> Topics </h2>
		<table>
		<tbody>
		<?php 
		foreach($topics as $topic)
		{
			echo "<tr> <td> <button name='topic' value='{$topic->id}'> {$topic->name} </button> </td> </tr>";    
		}
		?>
		</tbody>
		</table>
	</form>
    <?php
}

function showTopic($topic, $messages) 
{
	//debug :  $messages as parameter
	?>
	<div>
		<button id="backBtn"> Back </button>
	</div>
    <h2> <?php echo $topic->name ?> </h2>
    <table>
    <tbody>
    <?php
	$requete = "SELECT * FROM topics_posts WHERE topic=". $topic->id .";";
	$result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
	$topics = $result->fetch_assoc(); 
    foreach($messages as $message)
    {
       showMessage($message);
    }
    ?>
    </tbody>
    </table>
    <?php
    //TODO: show only if logged ?
    showInputZone($topic->id);
}

function showMessage($message)
{
	echo "<tr> <td>";
    //TODO distinct if current user = author
    $author = $message->author;
    $date = date('m/d/Y H:i:s', $message->date);
    echo $author . "<br /> $date </td> <td> {$message->content} </td> </tr>";
}

function showInputZone($topicId) 
{
    ?>
    <form method="post">
        <div id="containerInputZone">
	        <input hidden name="topic" value="<?php echo $topicId ?>" />
            <textarea id="msgArea" name="msg" placeholder="Type your reply..."></textarea>
            <input id="addAnswerBtn" type="submit" value="Answer" />
        </div>
    </form>
    <?php
}

function addAnswer($msg)
{
	//TODO sanitize inputs
	$mysqli->query("INSERT INTO topics_posts(author, date, content, topic) VALUES (5,".time().", ".$msg.", ". $_GET["topic"].")");
}

?>