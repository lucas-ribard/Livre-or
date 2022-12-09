<?php
        
    //on ouvre et récupere les variables sessions
    session_start();
    $login=$_SESSION['login'];
    $password=$_SESSION['password'];

    // connexion db
    require 'connect_db.php' ;

    //recup toute les données des tableaux d'utilisateur et commentaire si la ligne id et id_utilisateur on la meme valeur  Rangé par date                   
    $sql = "SELECT * FROM utilisateurs INNER JOIN commentaires WHERE utilisateurs.id = commentaires.id_utilisateur ORDER BY date DESC";
    $request = mysqli_query($mysqli,$sql);
    $result = mysqli_fetch_assoc($request);    

    if (!empty($login) ){
        $link="commentaire.php";
        $message= "Ecrire dans le livre d'or";
        } 
        //si l'utilisateur n'est pas connecté
        else{
        $link="connexion.php";
        $message= "connecter vous pour pouvoir écrire dans le livre d'or";
        }


?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Livre d'or</title>
    <link href="CSS/livreor.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
 
</head>

<body>
    <header>
    <!-- espace banniere -->
    <space>&ensp;<br>Le Livre d'or<br>&ensp;</space>
    </header>

    <!-- menu nav -->
    <ul id="nav">
        <li><a href="/Livre-or/index.php">Home</a></li>
        <li><a class="active" href="/Livre-or/Livre-or.php">Le Livre D'or</a></li>
        
       
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
        <div id="livre">
            <table>
                <thead>
                    <tr>
                        <th id="headTab">Posté le :</th>
                        <th colspan="2">Par l'utilisateur</th>
                        <th>Commentaires</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($result !=NULL){      
                    ?>
                    <tr>
                    <?php
                    //recupere la date et la réarange en jour-mois-année    déplacé dans la boucle sinon tout les commentaire ont la date du dernier.
                    $dateOld = $result['date'];
                    $date =  date('d-m-Y', strtotime($dateOld));
                    ?> 
                    <td><?php echo $date?></td>
                    <td><img src="images/icon.png" width="30px">                         
                    <td><?php  echo $result['login'] ?> </td>
                    <td id="com"><?php echo $result['commentaire']?></com></td>
                    </tr>
                    <?php $result = mysqli_fetch_assoc($request);
                                }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="<?php echo $link; ?>">
        <div id="ecrire">
            <?php echo $message; ?>
        </div>
        </a>
    </section>

    <br><br>

   
    
    <footer>
       <strong>Site par Lucas Ribard <br><br>
       Mon Github :&nbsp;&emsp;Mon CV : <br>
        <a href="https://github.com/lucas-ribard"><img src="https://assets.website-files.com/621e25e6223800d0ff68b02a/621e54eb5eb20e268b94164d_GitHub_icon.png" height="70px"></a>&emsp;&emsp;<a href="https://lucas-ribard.students-laplateforme.io/"><img src="https://marvel-b1-cdn.bc0a.com/f00000000264319/www.salsify.com/hubfs/2022/Product%20Icons/Digital-Catalog-Icon-white-01.png" height="70px"></a></strong>
        
    </footer>
</body>


</html>