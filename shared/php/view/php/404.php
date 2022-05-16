<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="/shared/php/view/css/404.css"/>
  </head>
  <body>
  <?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/language.php");
  ?>
    <div class="container">
      <h1><?php echo getTranslation(156); ?></h1>
    </div>
    <h3><?php echo getTranslation(157); ?></h3>
    <p><?php echo getTranslation(158); ?></p>
    <a href="/"><?php echo getTranslation(159); ?></a>
    
  </body>
</html>