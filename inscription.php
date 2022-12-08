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
    //on ouvre et récupere les variables sessions (pour regarder si un utilisateur est déja connecté)
    session_start();
    $loginSession=$_SESSION['login'];
    $passwordSession=$_SESSION['password'];

    // connexion;
    require 'connect_db.php' ;
    
    //recup les infos de la base de donné
    $sql = "SELECT * FROM `utilisateurs`";
    $query = $mysqli->query($sql);
    $users=$query->fetch_all();

    //recup les valeurs du formulaire
    $login=$_POST["login"];
    $password1=$_POST["password1"];
    $password2=$_POST["password2"];
        
    //on vérifie que les champs sont bien remplit 
    if(isset($login) and isset($password1)){
        //on verifie que les deux mots de passes sont identiques
        if($password1===$password2){
            
            $loginDispo=false;
            foreach($users as $user){
                if($_POST['login'] == $user[1]){
                    $message="<br><error>Cet Utilisateur existe déja</error><br>"; //login existe deja
                    break;  //sort de la boucle (sinon il crée quand meme l'utilisateur)
                }
                else{
                    $loginDispo = true;
                }
            }
            //si l'user est dispo
            if($loginDispo === true){

                //la requete sql
                $sql = "INSERT INTO `utilisateurs`(`login`, `password`) VALUES ('$login','$password1')"; //ajoute login password dans db
                if ($mysqli->query($sql) === TRUE) {//si requete réussit
                    header('Location:http://localhost/Livre-or/connexion.php'); //redirigé vers la page de connexion
                }
            }
                
            
        }
        else{//les deux mots de passe ne sont pas identiques
            $message="<br><error>Les deux Mots De Passes ne sont pas identiques</error><br>";
        }
        
    }
    //ferme la connection
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Insciption</title>
    <link href="CSS/connexion.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
 
</head>

<body>
  <!-- menu nav -->
  <ul id="nav">
        <li><a href="/Livre-or/index.php">Home</a></li>
        <li><a href="/Livre-or/Livre-or.php">Le Livre D'or</a></li>
        <li><a class="active" href="/Livre-or/inscription.php">S'inscrire</a></li>
       <!-- cette partie de menu nav change si l'utilisateur est connecté-->
        <?php 
        //si l'utilisateur est connecté
        if (!empty($loginSession) ){
            echo "<li><a href=",'/Livre-or/profil.php',">Bienvenue ",$loginSession,"</a></li>"; //affiche bienvenu $Utilisateur
            echo "<li><a href=",'/Livre-or/connexion.php',">Se déconnecter</a></li>";      //affiche se déconnecter (envoie a la page de login car il déco automatiquement)
            } 
            //si l'utilisateur n'est pas connecté
            else{
                echo "<li><a href=",'/Livre-or/connexion.php',">Se Connecter</a></li>";//affiche se conecter
            }
        ?>
        <!--  fin menu nav -->
    </ul>
<section id="main">
    <div id="form"> 
    <br>
        <h1>S'inscrire</h1><br>
        <hr>
        <div id="box">
           
            <form action="" method="post">
                <label for="login">Login :</label><br>
                <input type="text"  name="login" placeholder="Entrer le nom d'utilisateur" size="30" required>  <br>
                <br>
                <label for="password1">Mot de passe :</label><br>
                <input type="password" id="password1" name="password1" placeholder="Mot de passe" size="30" required> <br> 
                <br>
                <label for="password2">Répéter votre Mot de passe :</label><br>
                <input type="password" id="password2" name="password2" placeholder="Mot de passe" size="30" required>  <br>
                <br>
                <input type="checkbox" onclick="affichPass()">Afficher le mot de passe <br>
                <br>
                <input type="submit" name="submit" value="s'inscrire"><br>
                <br>
                <?php 
                    if (isset($message)){
                        echo $message;  //affiche un message d'erreur si probleme
                    }
                    
                ?>
            </form>
            
        </div>
    </div>

</section>    
</body>
</html>



