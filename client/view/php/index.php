<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/index.css" />
  </head>
  <body>
    <header class="site-header">
      <div class="wrapper site-header__wrapper">
        <div class="site-header__start">
          <a href="#" class="brand">E-lolning</a>
        </div>
        <div class="site-header__middle">
          <nav class="nav">
            <ul class="nav__wrapper">
                <li class="nav__item">
                    <a href="#">Home</a>
                </li>
                <li class="nav__item">
                    <a href="#">About us</a>
                </li>
                <li class="nav__item">
                    <a href="#">Contact</a>
                </li>
            </ul>
          </nav>
        </div>
        <div class="site-header__end">
        <?php
          session_start();
          
          $Sign_in_up = '<a id="header-button" href="./login.php">Sign in/up</a>';
          
          if(isset($_SESSION['loginResult'])){
            if($_SESSION['loginResult'] == 'ACCEPTED'){
              echo '<a id="header-button" href="#">'.$_SESSION['email'].'</a>';
            }else{
              echo $Sign_in_up;
            }
          }else{
            echo $Sign_in_up;
          }
        ?>
        </div>
      </div>
    </header>

    <!-- JS -->
    <script src="../js/shared.js"></script>
  </body>
</html>