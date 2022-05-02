<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Media Manager - E-lolning</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/mediaManager.css" />
    <link rel="stylesheet" href="../css/sharedAdmin.css" />
    <link rel="stylesheet" href="../../client/view/css/font-face.css" />
    <link rel="stylesheet" href="../../client/view/css/darkMode.css" />
</head>

<body>
    <?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php"); 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/controller/mediaManager.php");
    
    ?>
    
    <div class="content">
        <h1>Upload medias :</h1>
        <?php 
        showFiles()
        ?>

        <h1>Upload an image :</h1>
        <form enctype="multipart/form-data" action="#" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
            <input type="file" name="userfile" size=50 />
            <input type="submit" value="Envoyer" />
        </form>

        <?php
        if ( isset($_FILES['userfile']) ){
            uploadFile();
        }
        ?>
    </div>
    

    <!-- JS -->
    <script src="../../../../shared/js/jquery.js"></script>
</body>

</html>

<?php

function showFiles(){
    $files = getAllFiles();
    foreach($files as $file){
        $bits = $file['content'];
        echo '<img src="data:image/png;base64,'.base64_encode($bits).'"/>';
    }
}
?>


