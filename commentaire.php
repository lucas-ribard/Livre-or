<script>
    //fonction en javascript qui affiche le mot de passe si demandé (https://www.w3schools.com/howto/howto_js_toggle_password.asp)
    function affichPass() {
        var x1 = document.getElementById("password1");  //! important pointe les mots de passe par id (si le mot de passe n'a pas d'id ca ne marchera pas)
        var x2 = document.getElementById("password2");  //ne marche pas avec deux mots de passe qui ont la meme id (qu'un seul sera affiché  (d'apres mes test je connais pas trop javascript))
        //change l'input de 'texte' a  'password' et inversement
        if (x1.type === "password") {
        x1.type = "text";
        x2.type = "text";
        } else {
        x1.type = "password";
        x2.type = "password";
        }
    } 
</script>

<?php
    //on ouvre et récupere les variables sessions
    session_start();
    $loginSession=$_SESSION['login'];
    $passwordSession=$_SESSION['password'];
    // connexion db
    require 'connect_db.php' ;

    //verifie qu'un utilisateur est bien connecté
    if(isset($loginSession) AND isset($passwordSession) ){
        
        if (isset($_POST['ValidCom'])) {//si on appuie sur le bouton
            
            $sql="SELECT `id` FROM `utilisateurs` WHERE `login` = '$loginSession' AND `password` = '$passwordSession'"; 
            $query = $mysqli->query($sql);
            $users=$query->fetch_all();
            //id récupéré par la quete est dans une array dans une array, d'ou la syntaxe "$users[0][0]" resultat var dump : Array ( [0] => Array ( [0] => 4 ) )
            $id_utilisateur=$users[0][0];
            $commentaire=$_POST['message'];
            
            //met la timezone de paris
            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s');

            echo $commentaire,$id_utilisateur,$date;
            $sql = "INSERT INTO `commentaires`(`commentaire`, `id_utilisateur`,`date`) VALUES  ('$commentaire', '$id_utilisateur','$date')";
            if ($mysqli->query($sql) === TRUE) {//si requete réussit
                header('Location:http://localhost/Livre-or/Livre-or.php');
            }
            else{
                $message="<error>Requete échoué</error>";
            }

        }
    }   
    //si l'utilisateur n'est pas connecté
    else{
        header('Location:http://localhost/Livre-or/connexion.php'); //redirigé vers la page connexion.php
    }
        
?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Profil</title>
    <link href="CSS/commentaire.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
 
</head>

<body>
 <!-- menu nav -->

    <ul id="nav">
        <li><a href="/Livre-or/index.php">Home</a></li>
        <li><a class="active" href="/Livre-or/Livre-or.php">Le Livre D'or</a></li>
        
       
        <!-- cette partie de menu nav change si l'utilisateur est connecté-->
        <?php 
        //si l'utilisateur est connecté
        if (!empty($loginSession) ){
            echo "<li><a href=",'/Livre-or/profil.php',">Bienvenue ",$loginSession,"</a></li>"; //affiche bienvenu $Utilisateur
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

    <div id="form"> 
        <div id="box">
            <form action="" method="post">
                <label for="message">Votre Message :</label><br>  <br>
                <textarea rows="5" cols="80" id ="message" name="message"></textarea>
                <input type="checkbox" onclick="affichPass()">Afficher le mot de passe <br>
                <br>
                <input type="submit" name="ValidCom" value="Envoyer votre commentaire"><br>
            </form>
            <?php 
                if (isset($message)){
                    echo $message;  //affiche un message d'erreur si probleme
                }   
            ?>
        </div>
    </div>



</body>


</html>
