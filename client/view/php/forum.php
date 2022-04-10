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
    $topics = array(
            (object) array("id" => 1, "name" => "Sujet 1"),
            (object) array("id" => 2, "name" => "Sujet 2")
        ); //debug, get from bdd    
	
	$messages = array(
			(object) array("id" => 1, "author"=> "Author 1", "date"=>"1646334563", "content" => "Message 1"),
			(object) array("id" => 2, "author"=> "Author 2", "date"=>"1649606653", "content" => "Message 2")
		); //debug, get from bdd     
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
		$topic = $topics[array_search($_GET["topic"], array_column($topics, "id"))]; //get topic
        showTopic($topic, $messages); 
    }
    else 
    {
        listTopics($topics);
    }
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
    echo "<tr> <td> {$message->content} </td> </tr>";    
}

function showInputZone($topicId) {
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
	//TODO: insert in BDD
	global $messages;
	$messages[] = (object) array("id" => 3, "author"=> "Author 2", "date"=>time(), "content" => $msg);	//debug
}

?>