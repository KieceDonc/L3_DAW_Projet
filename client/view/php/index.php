<?php     
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
?>

<!DOCTYPE html>
<html lang="<?php echo getLangCode(); ?>">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/index.css" />
  </head>
  <body>
    <?php 
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");

        if(!file_exists("compteur.txt")){ 
            $compteur=fopen("compteur.txt","r+");
            $hit=1;	
            setcookie("Visite","ok",time()+365*24*3600); // one year
        }
        else{
                $compteur=fopen("compteur.txt","r+");
                $hit=fgets($compteur,255);
                if(empty($_COOKIE["Visite"])){
                    setcookie("Visite","ok",time()+365*24*3600); 
                    $hit++;
                }
        }
        fseek($compteur,0);
        fputs($compteur,$hit);
        fclose($compteur);

        echo '<p id="nbConnection"> '. getTranslation(54) . " " . $hit . '</p>';

        //echo $HTTP_COOKIE_VARS["Visite"];
    ?>

    <div class="infoAboutUs">
        <h1><?php echo getTranslation(55); ?></h1>
        
        <p><?php echo getTranslation(56); ?> <br>
        <?php echo getTranslation(57); ?></p>
   
        <p><?php echo getTranslation(58); ?><br>
        <?php echo getTranslation(59); ?>
        </p>
        
        <p> <?php echo getTranslation(60); ?><br>
        <?php echo getTranslation(61); ?>
        </p>
        
        <p> <?php echo getTranslation(62); ?><br>
        <?php echo getTranslation(63); ?>
        </p>
        
    </div>
    
    <div class="game">
        <img alt="lol image" src="../media/lolImage.png"  />
        <p class="gameAboutUs">
            <?php echo getTranslation(65); ?>
            <?php echo getTranslation(66); ?>
            <?php echo getTranslation(67); ?>
            <?php echo getTranslation(68); ?>
            <?php echo getTranslation(69); ?>
            <?php echo getTranslation(70); ?>
            <?php echo getTranslation(71); ?>
            <?php echo getTranslation(72); ?>
            <?php echo getTranslation(73); ?>
        </p>
    </div>
      
    <div class="us">
        <h2><?php echo getTranslation(64); ?></h2>
        <div class="pdp">
        <figure>
            <img alt="pdp" src="../media/pdpValentin.jpg" > <figcaption> Verstracte Valentin </figcaption>
        </figure>
        <figure>
            <img alt="pdp" src="../media/pdpEvan.png" > <figcaption> Petit Evan </figcaption>
        </figure>
        <figure>
            <img alt="pdp" src="../media/pdpTest.png" > <figcaption> Bertoux Hugo </figcaption>
        </figure>
        <figure>
            <img alt="pdp" src="../media/pdpMaxence.png" > <figcaption> Perion Maxence </figcaption>
        </figure>
        <figure>
            <img alt="pdp" src="../media/pdpTest.png" > <figcaption> Hamidou Nazim </figcaption>
        </figure>
        <figure>
            <img alt="pdp" src="../media/pdpAlexandre.png" > <figcaption> Pinon Alexandre </figcaption>
        </figure>
        </div>
    </div>
      
    <?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/footer.php"); ?>
      
    <!-- JS -->
    <script src="../../../../shared/js/jquery.js"></script>
    <script src="../js/shared.js"></script>
  </body>
</html>