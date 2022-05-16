<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Media Displayer - E-lolning</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/sharedAdmin.css" />
    <link rel="stylesheet" href="../css/mediaDisplay.css" />
    <link rel="stylesheet" href="../../client/view/css/font-face.css" />
    <link rel="stylesheet" href="../../client/view/css/darkMode.css" />
</head>

<body>
    <?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php"); 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/mediaInterface.php");
    
    ?>
    
    <div class="content">
        <h1>Your medias : </h1>
        <?php 
        showFiles()
        ?>
    </div>
    

    <!-- JS -->
    <script src="../../../../shared/js/jquery.js"></script>
</body>

</html>

<?php

function showFiles(){
    $files = getAllFiles();
    echo "<div class='listContainer'>";
    foreach($files as $file){
        echo "
        <div class='mediaBlock'>
            <img src=".getFilePath($file['content']).">
            <div class='mediaDesc'>".$file['name']."</div>
            <div class='mediaId'>ID : ".$file['id']."</div>
            <div class='formDelete'>
                <form action='deleteMedia' method='post'>
                    <input type='hidden' id='mediaId' name='mediaId' value='".$file['id']."'>
                    <input type='submit' value='delete' class='deleteButton'>
                </form>
            </div>
        </div>";
    }
    echo "</div>";
}
?>


