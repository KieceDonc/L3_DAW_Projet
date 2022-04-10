<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/aboutUs.css" />
    <link rel="stylesheet" href="../css/index.css" />
  </head>
  <body>
    <?php 
        require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");

        if(!file_exists("compteur.txt")){ 
            $compteur=fopen("compteur.txt","w");
            $hit=1;	
            setcookie("Visite","ok",time()+365*24*3600); // 1 an
        }
        else{
                $compteur=fopen("compteur.txt","r+");
                $hit=fgets($compteur,255);
                if(empty($_COOKIE["Visite"])){
                    setcookie("Visite","ok",time()+365*24*3600); // 1 an
                    $hit++;
                }
        }
        fseek($compteur,0);
        fputs($compteur,$hit);
        fclose($compteur);

        echo " Nombre de visiteur (1 ans maximum)" . $hit . " !! <br><br> ";

        echo $HTTP_COOKIE_VARS["Visite"];
    ?>
      
    <div class="infoAboutUs">
    Informations général sur l'entreprise
        Qu’est-ce qui vous a motivé à lancer votre entreprise?
        Quelles sont vos valeurs d’entreprise? (offrir le meilleur service possible, importance de la satisfaction de chaque client, souci environnemental, qualité des produits, etc.)
        Quelle est la motivation derrière la création de votre entreprise ainsi que pour la continuation de son développement?
        De quelle façon votre entreprise permet-elle de faire une différence positive auprès de sa clientèle ou de son milieu?
        Ce que l'on peut faire chez nous...
        
    Qui sommes nous ? 
        Nous somme un groupe de 6 jeunes étudiant en licence informatique réalisant un projet WEB. 
    Que propose notre site ?
        Nous proposons un site de e-learning, en effet ce site permet de crée et participer a des cours sur le sujet de League Of Legend. Les cours 
    </div>
    
    <div class="game">
        <img alt="lol image" src="../src/lolImage.png"  />
        <gameAboutUs>
        Le jeu LOL
            League of Legends (abrégé LoL) est un jeu vidéo sorti en 2009 de type arène de bataille en ligne, free-to-play, développé et édité par Riot Games sur Windows et Mac OS.

            Le mode principal du jeu voit s'affronter deux équipes de 5 joueurs en temps réel dans des parties d'une durée d'environ une demi-heure, chaque équipe occupant et défendant sa propre base sur la carte. Chacun des dix joueurs contrôle un personnage à part entière parmi les plus de 150 qui sont proposés. Ces personnages, connus sous le nom de « champions » dans le jeu, disposent de compétences uniques et d'un style de jeu qui leur est propre. Ils gagnent en puissance au fil de la partie en amassant des points d'expérience ainsi qu'en achetant des objets, dans le but de battre l'équipe adverse. L'objectif d'une partie est de détruire le « Nexus » ennemi, une large structure située au centre de chaque base. D'autres modes de jeu, généralement moins compétitifs et se basant quasiment toujours sur le mode principal, sont également présents — à l'exception de Teamfight Tactics, un auto battler sorti en 2019 sans grand rapport avec le mode principal et qui dispose de sa propre communauté.

            Initialement inspiré de Defense of the Ancients, un ancien mod de Warcraft III, le jeu est publié le 27 octobre 2009 et adopte dès sa sortie un modèle économique « freemium ». Il est souvent considéré comme le jeu vidéo ayant la plus large scène compétitive au monde, ses compétitions étant internationales et réunissant d'importantes audiences. Le Championnat du monde de League of Legends 2019 (en), par exemple, réunissait plus de 44 millions de spectateurs simultanés lors de ses pics de popularité, en novembre 2019.

            League of Legends a reçu des critiques généralement positives de la critique, gagnant des prix pour son accessibilité, le design de ses personnages et sa compétitivité. En juillet 2012, il était le premier jeu vidéo sur ordinateur en nombre d'heures jouées en Europe et aux États-Unis. Son importante popularité a conduit à la création de produits dérivés tels que des clips musicaux, des bandes dessinées, des nouvelles, des figurines, et d'une série d'animation nommée Arcane.

            Le succès du jeu a également donné naissance à plusieurs autres jeux vidéo situés dans le même univers, tels que Legends of Runeterra, un jeu de cartes à collectionner, Ruined King: A League of Legends Story, un jeu de rôle au tour par tour, et League of Legends: Wild Rift, une adaptation sur mobile et console de LoL.

          </gameAboutUs>
      </div>
      
      <div class="us">
          <h2>Fondateurs</h2>
          <div class="pdp"> 
              <div id="infoPdp">
                <img alt="pdp" src="../media/pdpTest.png" > <p>Vestracte Valentin</p>
              </div>
              <div id="infoPdp">
                <img alt="pdp" src="../media/pdpTest.png" > <p>Petit Evan</p> 
              </div>
              <div id="infoPdp">
                <img alt="pdp" src="../media/pdpTest.png" > <p>Bertoux Hugo</p> 
              </div>
              <div id="infoPdp">    
                <img alt="pdp" src="../media/pdpMaxence.png" > <p>Perion Maxence</p>
              </div>
              <div id="infoPdp">    
                <img alt="pdp" src="../media/pdpTest.png" > <p>Mohamed Nazim</p>
              </div>
              <div id="infoPdp">
                <img alt="pdp" src="../media/pdpTest.png" > <p>Pinon Alexandre</p> 
              </div>
          </div>
      </div>
      
    
    <!-- JS -->
    <script src="../js/jquery.js"></script>
    <script src="../js/shared.js"></script>
  </body>
</html>