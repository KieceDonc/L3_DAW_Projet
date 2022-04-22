<?php
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
?>

<!DOCTYPE html>
<html lang="<?php echo getLangCode(); ?>">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning <?php echo getTranslation(2); ?></title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/forum.css" />
  </head>
  <body>
   
  <?php 
  	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/model/forum.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/controller/forum.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
  ?>
  
  <div>
    <h1> <?php echo getTranslation(2); ?> E-lolning </h1>
    <?php
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
			$editedMessage = "-1";
			// Is user connected
			if(isset($_SESSION[CONST_SESSION_ISLOGGED])){
                if($_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){
									
					$userID = getUserID($_SESSION[CONST_SESSION_EMAIL]);

					//message option (edit, delete)
					if(isset($_REQUEST["messageId"])){
						if(isset($_REQUEST["delete"])){
							//TODO more checks, if logged user is the author of the message
							deleteMessage($_REQUEST["messageId"]);
						}
						else if(isset($_REQUEST["edit"])){//TODO sanitize inputs
							//edited
							if(isset($_REQUEST["msg"]) && !empty($_REQUEST["msg"])){
								editMessage($_REQUEST["messageId"], $_REQUEST["msg"]);
							}
							else{//want to edit
								$editedMessage = $_REQUEST["messageId"];
							}
						}
					}
					else{
						// User is trying to add a message
						if(isset($_REQUEST["msg"]) && !empty($_REQUEST["msg"])){
							//TODO sanitize input
							$userMessage = $_REQUEST["msg"]; 
							addForumTopicMessage($topicID,$userID,$userMessage);
						}
					}
                }
            }

			// We're inside a topic
			// We show messages from it
			showTopic(getForumTopicInfo($topicID), $editedMessage);
		}
    }
    else 
    {
        listTopics(getForumTopics());
    }
	
    ?>
  </div>

  <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
  
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
		<h2> <?php echo getTranslation(23); ?> </h2>
		<?php
			// Is user connected
			if(isset($_SESSION[CONST_SESSION_ISLOGGED])){
                if($_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){

					// Yes so he can create new topic
                    echo '<div class="button"><button name="topic" value="new" class="newtopic">';
					echo getTranslation(11); 
					echo '</button></div>';
                }
            }
		?>
		<table id="topicsTable">
		<tbody>
		<tr>
			<td style="width: 80%;padding-left: 50px;">
				<div class="topicsTableHideExtra">
					<?php echo getTranslation(12); ?>
				</div>
			</td>
			<td style="min-width: 400px;max-width: 400px;">
				<div class="topicsTableHideExtra" class="topicsTableTextCenter">
					<?php echo getTranslation(13); ?>
				</div>
			</td>
			<td style="min-width: 175px;" class="topicsTableTextCenter">
				<?php echo getTranslation(14); ?>
			</td>
			<td style="min-width: 125px;" class="topicsTableTextCenter">
				<?php echo getTranslation(15); ?>
			</td>
			<td style="min-width: 125px;" class="topicsTableTextCenter">
				<?php echo getTranslation(16); ?>
			</td>
		</tr>
		<?php 
		foreach($topics as $topic)
		{
			echo "<tr ><tr><td style='width: 80%;padding-left: 50px;'><div data-href='".$topic["id"]."' class='topicsTableHideExtra'>";
			echo $topic["name"];
			echo "</div></td><td style='min-width: 400px;max-width: 400px;'><div class='topicsTableHideExtra' class='topicsTableTextCenter'>";
			echo $topic["username"];
			echo "</div></td><td style='min-width: 175px;' class='topicsTableTextCenter'>";
			$messagesCount = getForumTopicMessageCountInDB($topic["id"]);
			echo $messagesCount . " " . getTranslation(14);
			echo "</td><td style='min-width: 125px;' class='topicsTableTextCenter'>";
			echo $topic["view_count"];
			echo "</td><td style='min-width: 125px;' class='topicsTableTextCenter'>";
			if($messagesCount != 0) {
				$date = date('d/m/Y H:i:s', getForumTopicLastMessageDate($topic["id"]));
				echo $date;
			}
			echo "</td></tr>";
			// echo "<tr class = 'rowtopic'> <td> <button name='topic' value='". $topic["id"] ."' class='topicbutton'> ". $topic["name"]. " </button> </td> </tr>";
		}
		?>
		</tbody>
		</table>
	</form>
    <?php
}

function showTopic($topic, $editedMessage) 
{
	//debug :  $messages as parameter
	?>
    <h2> <?php echo $topic["name"] ?> </h2>
	<div class="button">
		<button id="backBtn"> <?php echo getTranslation(17); ?> </button>
	</div>
    <table>
    <tbody>
    <?php

	$messages = getForumTopicMessagesInDB($topic["id"]);
	$currentMessage = "";

    foreach($messages as $message)
    {
		if($message["id"] == $editedMessage){
			showEditedMessage($message);
			$currentMessage = $message["content"];
		}
		else{
			showMessage($message, $topic["id"]);
		}
    }

	updateTopicViewCountInDB($topic["id"]);
    ?>
    </tbody>
    </table>
    <?php
	// Is user connected
	if(isset($_SESSION[CONST_SESSION_ISLOGGED])){
		if($_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){
			
			showInputZone($topic["id"], $editedMessage, $currentMessage);

		}
	}
}

function showMessage($message, $topicId)
{
	echo "<tr> <td>";

	if(
		isset($_SESSION[CONST_SESSION_ISLOGGED]) 
		&& $_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES 
		&& $message["author"] == getUserID($_SESSION[CONST_SESSION_EMAIL])
	){
		$author_name = getTranslation(74);
		$messageCode = " <td class='message'> <form method='post'><input name='topic' value='". $topicId ."' hidden/><input name='messageId' value='". $message["id"] ."' hidden/><button name='edit'>"
			. getTranslation(75) . "</button><button name='delete'>". getTranslation(76) ."</button></form>" . wordwrap($message["content"],150,"-</br>\n-",true). " </td> </tr>";
	}
	else{
		$author_name = $message["username"];
		$messageCode = " <td class='message'>". wordwrap($message["content"],150,"-</br>\n-",true). " </td> </tr>";
	}
    $date = date('d/m/Y H:i:s', $message["date"]);
    echo "<div id='author'>" . $author_name .  "</div><br /><div id='date'>" . $date ."</div></td>";
	echo $messageCode;
}

function showEditedMessage($message) {
	echo "<tr> <td>";

	if(
		isset($_SESSION[CONST_SESSION_ISLOGGED]) 
		&& $_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES 
		&& $message["author"] == getUserID($_SESSION[CONST_SESSION_EMAIL])
	){
		$author_name = getTranslation(74);
	}
	else{
		$author_name = $message["username"];
	}
    $date = date('d/m/Y H:i:s', $message["date"]);
    echo "<div id='author'>" . $author_name .  "</div><br /><div id='date'>" . $date ."</div></td>";
	echo " <td class='message'> " . getTranslation(77) . " </td> </tr>";
}

function showInputZone($topicId, $editedMessage, $currentMessage) 
{
    ?>
    <form method="post">
        <div id="containerInputZone">
	        <input hidden name="topic" value="<?php echo $topicId ?>" />
			<?php
				if($editedMessage != "-1"){
					echo "<textarea id='msgArea' name='msg' placeholder='". getTranslation(18) ."'>" . $currentMessage . "</textarea>";
					echo "<input name='messageId' value='". $editedMessage ."' hidden/>";
					echo "<button id='addAnswerBtn' name='edit'>" . getTranslation(75) . "</button>";
					echo "<button>" . getTranslation(78) . "</button>";
				}
				else{
					echo "<textarea id='msgArea' name='msg' placeholder='". getTranslation(18) ."'></textarea>";
					echo "<input id='addAnswerBtn' type='submit' value=".getTranslation(19) ." />";
				}
			?>
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
	<h2> <?php echo getTranslation(20); ?> </h2>

	<form id="createTopic" method="post">
		<input name="topic" value="new" hidden />
		<label for="inputName"> <?php echo getTranslation(21); ?> </label>
		<input name="name" type="text" id="inputName"/>
		<div class="button">
		<button id="createTopicBtn" name="create"> <?php echo getTranslation(22); ?> </button>
		</div>
	</form>
	<div class="button">
	<button id="backBtn"> <?php echo getTranslation(17); ?> </button>
	</div>
	<?php
}

?>