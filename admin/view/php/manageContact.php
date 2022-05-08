<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard - E-lolning</title>

  <!-- CSS -->
  <link rel="stylesheet" href="../css/manageContact.css" />
  <link rel="stylesheet" href="../css/sharedAdmin.css" />
  <link rel="stylesheet" href="../../client/view/css/font-face.css" />
  <link rel="stylesheet" href="../../client/view/css/darkMode.css" />
</head>

<body>
    <?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/view/php/header.php"); 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/controller/manageContact.php"); 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/sanitizeHelper.php");
    
    if(getAdminID($_SESSION[CONST_SESSION_EMAIL]) == 1){
        if(isset($_REQUEST['del']))
        {
            if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
                $id = sanitizeString($_REQUEST['id']);
                deleteContact($id);
            }
            else{
                clearContacts();
            }
        }
        
        printPageContact();
    }
    else{
        printNotAllowed();
    }
    ?>
   
    <!-- JS -->
    <script src="../../../../shared/js/jquery.js"></script>
</body>

</html>
<?php
function printPageContact(){
    ?>
    <div class="content">
        <form method="post">
            <button name="del"> <?php echo getTranslation(105); ?> </button>
        </form>
    
        <?php
        $contacts = getContacts();
        echo "<table><thead><th>". getTranslation(100) . "</th><th>". getTranslation(85) ."</th><th>". getTranslation(101) ."</th><th>".
        getTranslation(102)."</th><th>". getTranslation(103) ."</th><th>".getTranslation(104) ."</th></thead><tbody>";
        foreach($contacts as $row) {
            echo "<tr>";
                echo "<td>". $row["name"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>"; 
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["subject"] . "</td>";
                echo "<td>" . $row["question"] . "</td>";
                echo "<td> <form method='post'> <input hidden name='id' value='". $row["id"] ."' /> <button name='del'>". getTranslation(76) .
                "</button> <button type='button' onclick=\"location.href='mailto:". $row["email"] ."?subject=". $row["subject"] ."';\"/>". getTranslation(106) ."</button> </form></td>";
            echo "</tr>";
        }
        echo "</tbody></table></div>";
}

function printNotAllowed(){
    ?>

    <div class="content">
        <p> <?php echo getTranslation(99); ?> </p>
    </div>

    <?php
}