<?php
   //on ouvre et récupere les variables sessions
   session_start();
   $login=$_SESSION['login'];
   $password=$_SESSION['password'];
  
?>
<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Livre d'or</title>
    <link href="CSS/index.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
 
</head>

<body>
    <header>
    <!-- espace banniere -->
    <space>&ensp;<br>Livre d'or<br>&ensp;</space>
    </header>

    <!-- menu nav -->
    <ul id="nav">
        <li><a class="active"href="/Livre-or/index.php">Home</a></li>
        <li><a href="/Livre-or/Livre-or.php">Le Livre D'or</a></li>
        
       
        <!-- cette partie de menu nav change si l'utilisateur est connecté-->
        <?php 
        //si l'utilisateur est connecté
        if (!empty($login) ){
            echo "<li><a href=",'/Livre-or/profil.php',">Bienvenue ",$login,"</a></li>"; //affiche bienvenu $Utilisateur
            echo "<li><a href=",'/Livre-or/connexion.php',">Se déconnecter</a></li>";      //affiche se déconnecter (envoie a la page de login car il déco automatiquement)
            } 
            //si l'utilisateur n'est pas connecté
            else{
                echo "<li><a href=","/Livre-or/inscription.php",">S'inscrire</a></li>";// affiche s'inscire
                echo "<li><a href=",'/Livre-or/connexion.php',">Se Connecter</a></li>";//affiche se conecter
            }
        ?>
    </ul>
    <!--  fin menu nav -->


    <!-- contenu principal -->
    <br><br>
    <section id="main">
        <div id="Text">
            <h1> Qu'est ce qu'un livre d'or ?</h1>
            Un livre d'or est un livre (ou une page web, ou tout autre support d'écrit) où des personnes inscrivent des félicitations ou des témoignages sur quelque chose (un lieu, un événement).<br>
            <br>
            Dans un hôtel de ville, un restaurant ou un gîte ou lors d'un mariage, un livre d'or peut être rédigé par les clients ou les invités pour qu'ils témoignent de leur passage. Son but principal est de permettre aux visiteurs d'exprimer leur gratitude et leur soutien. Le livre d'or s'oppose au livre de doléances.<br>
            <br>
            Bon nombre de villes ont coutume d'inviter les personnalités en visite officielle à signer leur livre d'or. <br>
        </div>
    </section>
    <br><br>
    
    <footer>
       <strong>Site par Lucas Ribard <br><br>
       Mon Github :&nbsp;&emsp;Mon CV : <br>
        <a href="https://github.com/lucas-ribard"><img src="https://assets.website-files.com/621e25e6223800d0ff68b02a/621e54eb5eb20e268b94164d_GitHub_icon.png" height="70px"></a>&emsp;&emsp;<a href="https://lucas-ribard.students-laplateforme.io/"><img src="https://marvel-b1-cdn.bc0a.com/f00000000264319/www.salsify.com/hubfs/2022/Product%20Icons/Digital-Catalog-Icon-white-01.png" height="70px"></a></strong>
        
        


        
    </footer>
</body>


</html>