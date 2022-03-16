<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
  </head>
  <body>
   
  <?php 
    include_once("header.php");
  ?>
  
  <div>
    <h1> Forum </h1>
    <?php 
    if(isset($_GET["topic"]) && !empty($_GET["topic"]))
    {
        showTopic($_GET["topic"]);  //TODO: sanitize input
    }
    else 
    {
        listTopics();
    }
    ?>
  </div>

    <!-- JS -->
    <script src="./src/client/js/shared.js"></script>
  </body>
</html>

<?php

function listTopics() 
{
    ?>
        <form method="get">
            <h2> Topics </h2>
            <table>
            <tbody>
            <?php 
            $topics = array(
                (object) array("id" => 1, "name" => "Sujet 1"),
                (object) array("id" => 2, "name" => "Sujet 2")
            ); //debug, get from bdd    

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

function showTopic($topicId) 
{
    $messages = array(
                (object) array("id" => 1, "content" => "Message 1"),
                (object) array("id" => 2, "content" => "Message 2")
            ); //debug, get from bdd     
    ?>

    <table>
    <tbody>
    <?php
    foreach($messages as $message)
    {
       echo "<tr> <td> {$message->content} </td> </tr>";    
    }
    ?>
    </tbody>
    </table>
    <?php
}

?>