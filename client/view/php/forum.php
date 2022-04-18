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
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/forum.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/forum.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/userInfo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
  ?>
  
  <div>
    <h1> Forum E-lolning </h1>
    <?php
	date_default_timezone_set("Etc/GMT-2");
    if(isset($_REQUEST["topic"]) && !empty($_REQUEST["topic"]))
    {
		if($_REQUEST["topic"] == "new")
		{
			if(isset($_REQUEST["create"]))
			{
				if(isset($_REQUEST["name"]) && !empty($_REQUEST["name"]))
				{
					// We don't check if user is connected because "new topic" button only appear when the user is connected
					$userID = getUserID($_SESSION[CONST_SESSION_EMAIL]);
					createTopic($_REQUEST["name"],$userID);
				}
				else
				{		
					showCreateTopicForm(array("Missing topic name"));
				}
			}
			else
			{
				showCreateTopicForm();
			}
		}
		else
		{
			$topicID = $_REQUEST["topic"];

			// Is user connected
			if(isset($_SESSION[CONST_SESSION_ISLOGGED])){
                if($_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){
                    
					$userMessage = $_REQUEST["msg"]; 
					$userID = getUserID($_SESSION[CONST_SESSION_EMAIL]);
					// User is trying to add a message
					if(isset($userMessage) && !empty($userMessage)){
						addForumTopicMessage($topicID,$userID,$userMessage);
						var_dump($userMessage);
					}
                }
            }

			// We're inside a topic
			// We show messages from it
			showTopic(getForumTopicInfo($topicID));
		}
    }
    else 
    {
        listTopics(getForumTopics());
    }
	
    ?>
  </div>

    <!-- JS -->
	<script src="../../../../shared/js/jquery.js"></script>
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
		<?php
			// Is user connected
			if(isset($_SESSION[CONST_SESSION_ISLOGGED])){
                if($_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){

					// Yes so he can create new topic
                    echo '<button name="topic" value="new"> New Topic </button>';
                }
            }
		?>
		<table>
		<tbody>
		<?php 
		foreach($topics as $topic)
		{
			echo "<tr> <td> <button name='topic' value='". $topic["id"] ."'> ". $topic["name"]. " </button> </td> </tr>";    
		}
		?>
		</tbody>
		</table>
	</form>
    <?php
}

function showTopic($topic) 
{
	//debug :  $messages as parameter
	?>
    <h2> <?php echo $topic["name"] ?> </h2>
	<div>
		<button id="backBtn"> Back </button>
	</div>
    <table>
    <tbody>
    <?php

	$messages = getForumTopicMessages($topic["id"]);

    foreach($messages as $message)
    {
       showMessage($message);
    }
    ?>
    </tbody>
    </table>
    <?php
	// Is user connected
	if(isset($_SESSION[CONST_SESSION_ISLOGGED])){
		if($_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){
			
			showInputZone($topic["id"]);

		}
	}
}

function showMessage($message)
{
	echo "<tr> <td>";
    //TODO distinct if current user = author
    $author_name = $message["firstname"] . " " . $message["lastname"];
    $date = date('m/d/Y H:i:s', $message["date"]);
    echo "<div id='author'>" . $author_name .  "</div><br /><div id='date'>" . $date ."</div></td> <td class='message'>". $message["content"] . " </td> </tr>";
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

function showCreateTopicForm($errors = array())
{	
	echo "<div id='errorsDiv'>";
	foreach($errors as $e)
	{
		echo "<p> $e </p>";
	}
	echo "</div>";

	?>
	<h2> Create a new topic </h2>
	
	<form id="createTopic" method="post">
		<input name="topic" value="new" hidden />
		<label for="inputName"> Name of Topic : </label>
		<input name="name" type="text" id="inputName"/>
		
		<button id="createTopicBtn" name="create"> Create </button>
	</form>

	<button id="backBtn"> Back </button>
	<?php
}

?>