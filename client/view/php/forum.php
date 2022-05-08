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
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/sanitizeHelper.php");
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
			// Is user connected
			if(isset($_SESSION[CONST_SESSION_ISLOGGED]) && $_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){
				$userID = getUserID($_SESSION[CONST_SESSION_EMAIL]);

				//message option (edit, delete)
				if(isset($_REQUEST["messageId"]) && !empty($_REQUEST["messageId"])){
					if(isset($_REQUEST["delete"])){
						deleteMessage($_REQUEST["messageId"]);

						// We're inside a topic
						// We show messages from it
						showTopic(getForumTopicInfo($topicID));
					}
					else if(isset($_REQUEST["edit"])){
						//edited
						if(isset($_REQUEST["msg"]) && !empty($_REQUEST["msg"])){
							editMessage(sanitizeString($_REQUEST["messageId"]), sanitizeString($_REQUEST["msg"]));

							// We're inside a topic
							// We show messages from it
							showTopic(getForumTopicInfo($topicID));
						}
						else{//want to edit
							showTopic(getForumTopicInfo($topicID), sanitizeString($_REQUEST["messageId"]));
						}
					}
				}
				else{
					//topic options
					if(isset($_REQUEST["delete"])){
						deleteTopic($topicID);

						listTopics();
					}
					else if(isset($_REQUEST["edit"])){
						if(isset($_REQUEST["name"]) && !empty($_REQUEST["name"])){
							editTopic($topicID, sanitizeString($_REQUEST["name"]));

							showTopic(getForumTopicInfo($topicID));
						}
						else{//want to edit
							showEditTopicForm(getForumTopicInfo($topicID));
						}
					}
					else if(isset($_REQUEST["msg"]) && !empty($_REQUEST["msg"])){
						// User is trying to add a message
						$userMessage = sanitizeString($_REQUEST["msg"]); 
						addForumTopicMessage($topicID,$userID,$userMessage);

						// We're inside a topic
						// We show messages from it
						showTopic(getForumTopicInfo($topicID));
					}
					else{
						//just show
						showTopic(getForumTopicInfo($topicID));
					}
				}
            }
			else{
				//just show
				showTopic(getForumTopicInfo($topicID));
			}
		}
    }
    else 
    {
		listTopics();
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

	function listTopics(){
		if(!isset($_REQUEST["searchTxt"]) || empty($_REQUEST["searchTxt"])){
			$searchTxt = "";
		}
		else{
			$searchTxt = sanitizeString($_REQUEST["searchTxt"]);
		}

		$nbPage = getForumTopicNbPages($searchTxt);

		if(!isset($_REQUEST["page"]) || empty($_REQUEST["page"])){
			$page = 0;
		}
		else{
			$page = min(sanitizeString($_REQUEST["page"]), $nbPage);
		}

		if(!isset($_COOKIE["topicsPerPage"]) || empty($_COOKIE["topicsPerPage"])){
			$topicsPerPage = "10";
		}
		else{
			$topicsPerPage = sanitizeString($_COOKIE["topicsPerPage"]);
		}
		
		$topics = getForumTopics($page, $searchTxt);

		?>
		<div class="titleHolder">
			<form> 
				<input hidden name="page" value="<?php echo $page; ?>" />
				<input id="searchTxt" type="text" name="searchTxt" value="<?php echo $searchTxt; ?>" /> <button id="searchBtn"> <?php echo getTranslation(93); ?></button>
			</form>
			<h2> <?php echo getTranslation(23); ?> </h2>
			<div>
				<select id="selectTopicsPerPage">
					<option value="10" <?php echo $topicsPerPage == 10 ? "selected" : "" ?>> 10 </option> 
					<option value="50" <?php echo $topicsPerPage == 50 ? "selected" : "" ?>> 50 </option>
					<option value="100" <?php echo $topicsPerPage == 100 ? "selected" : "" ?>> 100 </option> 
				</select>
				<form class="pageForm">
					<input hidden name="searchTxt" value="<?php echo $searchTxt; ?>" />
					
					<?php
					if($page > 0){
						echo "<button name='page' value=" . ($page - 1) ."><</button>";
					}
					else{
						echo "<button disabled><</button>";
					}
					echo "<span> ". $page ." </span>";

					if($page < $nbPage){
						echo "<button name='page' value=" . ($page + 1) .">></button>";
					}
					else{
						echo "<button disabled>></button>";
					}

					
					?>
				</form>
			</div>
		</div>
		<?php
			// Is user connected
			if(isset($_SESSION[CONST_SESSION_ISLOGGED])){
				if($_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES){

					// Yes so he can create new topic
					echo '<div class="button"><button data-href="new" class="newtopic">';
					echo getTranslation(11); 
					echo '</button></div>';
				}
			}
		?>
		<table id="topicsTable">
		<tbody>
		<tr>
			<td class="tdTitle">
				<?php echo getTranslation(12); ?>
			</td>
			<td class="tdAuthor textCenter">	
				<?php echo getTranslation(13); ?>
			</td>
			<td class="tdMsg textCenter">
				<?php echo getTranslation(14); ?>
			</td>
			<td class="tdViewCount textCenter">
				<?php echo getTranslation(15); ?>
			</td>
			<td class="tdLastMsg textCenter">
				<?php echo getTranslation(16); ?>
			</td>
		</tr>
		<?php 
		foreach($topics as $topic)
		{	
			echo "<tr><td class='tdTitle' data-href='".$topic["id"]."'>".$topic["name"]. "<td class='tdAuthor'>";
			if(
				isset($_SESSION[CONST_SESSION_ISLOGGED]) 
				&& $_SESSION[CONST_SESSION_ISLOGGED] == CONST_SESSION_ISLOGGED_YES 
				&& $topic["author"] == getUserID($_SESSION[CONST_SESSION_EMAIL])
			){
				echo getTranslation(74);
				echo "<form method='get'><input name='topic' value='" . $topic["id"] . "' hidden/><button class='optionBtn' name='edit'>" . getTranslation(75) ."</button>"
				. "<button class='optionBtn' name='delete'>" . getTranslation(76) . "</button></form>";
			}
			else{
				echo $topic["username"];
			}
			
			echo "</div></td><td class='tdMsg textCenter'>";
			$messagesCount = getForumTopicMessageCountInDB($topic["id"]);
			echo $messagesCount . " " . getTranslation(14);
			echo "</td><td class='tdViewCount textCenter'>";
			echo $topic["view_count"];
			echo "</td><td class='tdLastMsg textCenter'>";
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
		<?php
	}

function showTopic($topic, $editedMessage="-1") 
{
	$nbPage = getForumTopicMessagesNbPages($topic["id"]);

	if(!isset($_REQUEST["page"]) || empty($_REQUEST["page"])){
		$page = 0;
	}
	else{
		$page = min(sanitizeString($_REQUEST["page"]), $nbPage);
	}

	if(!isset($_COOKIE["messagesPerPage"]) || empty($_COOKIE["messagesPerPage"])){
		$messagesPerPage = "10";
	}
	else{
		$messagesPerPage = sanitizeString($_COOKIE["messagesPerPage"]);
	}

	?>
    <h2> <?php echo $topic["name"] ?> </h2>
	<div class="button">
		<button id="backBtn" class='inputBtn'> <?php echo getTranslation(17); ?> </button>
	</div>
	<div class="pagesSelectionMessages">
		<select id="selectMessagesPerPage">
			<option value="10" <?php echo $messagesPerPage == 10 ? "selected" : "" ?>> 10 </option> 
			<option value="50" <?php echo $messagesPerPage == 50 ? "selected" : "" ?>> 50 </option>
			<option value="100" <?php echo $messagesPerPage == 100 ? "selected" : "" ?>> 100 </option> 
		</select>
		<form class="pageForm">
			<input hidden name="topic" value="<?php echo $topic["id"]; ?>" />
			<?php
			if($page > 0){
				echo "<button name='page' value=" . ($page - 1) ."><</button>";
			}
			else{
				echo "<button disabled><</button>";
			}
			echo "<span> ". $page ." </span>";

			if($page < $nbPage){
				echo "<button name='page' value=" . ($page + 1) .">></button>";
			}
			else{
				echo "<button disabled>></button>";
			}
			
			?>
		</form>
		</div>
    <table id="topicTable">
    <tbody>
    <?php

	$messages = getForumTopicMessages($topic["id"], $page);
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
		$messageCode = " <td class='message'> <form method='post'><input name='topic' value='". $topicId ."' hidden/><input name='messageId' value='". $message["id"] ."' hidden/><button class='optionBtn' name='edit'>"
			. getTranslation(75) . "</button><button class='optionBtn' name='delete'>". getTranslation(76) ."</button></form>" . wordwrap($message["content"],150,"-</br>\n-",true). " </td> </tr>";
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
					echo "<button id='addAnswerBtn' class='inputBtn' name='edit'>" . getTranslation(75) . "</button>";
					echo "<button type='button' class='inputBtn' data-href=".$topicId.">" . getTranslation(78) . "</button>";
				}
				else{
					echo "<textarea id='msgArea' name='msg' placeholder='". getTranslation(18) ."'></textarea>";
					echo "<input id='addAnswerBtn' class='inputBtn' type='submit' value=".getTranslation(19) ." />";
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
	<button id="backBtn" class="inputBtn"> <?php echo getTranslation(17); ?> </button>
	</div>
	<?php
}

function showEditTopicForm($topic, $errors = array())
{	
	echo "<div id='errorsDiv'>";
	foreach($errors as $e)
	{
		echo "<p> $e </p>";
	}
	echo "</div>";

	?>
	<h2> <?php echo getTranslation(79); ?> </h2>

	<form id="createTopic" method="post">
		<input name="topic" value="<?php echo $topic["id"];?>" hidden />
		<label for="inputName"> <?php echo getTranslation(21); ?> </label>
		<input name="name" type="text" id="inputName" value="<?php echo $topic["name"]; ?>"/>
		<div class="button">
		<button id="createTopicBtn" name="edit"> <?php echo getTranslation(75); ?> </button>
		</div>
	</form>
	<div class="button">
	<button id="backBtn" class="inputBtn"> <?php echo getTranslation(17); ?> </button>
	</div>
	<?php
}

?>