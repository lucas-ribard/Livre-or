<?php
    //recup infos de session
    session_start();
    $login=$_SESSION['login'];
    $password=$_SESSION['password'];

    // connexion db
    require 'connect_db.php' ;

    // requete
    $request = $mysqli -> query("SELECT * FROM utilisateurs");  
    //verifie qu'on est connecté en admin
    if ($login==="admin" and $password==="admin"){

?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Profil</title>
    <link href="CSS/admin.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

</head>

<body>
     <!-- menu nav -->
  <ul id="nav">
        <li><a href="/Livre-or/index.php">Home</a></li>
        <li><a href="/Livre-or/Livre-or.php">Le Livre D'or</a></li>
        <li><a class="active" href="/Livre-or/profil.php"> Admin </a></li>
        <li><a href="/Livre-or/connexion.php">Se déconnecter</a></li>
        
    </ul>
   <br><br><br>
   <section id="main">
    <div id="box">
        <table>
            <thead>
                <tr>
                    <td><strong>login</strong></td>
                    <td><strong>password</strong></td>
                    <td><strong>id</strong></td>
                
                </tr>
            </thead>
            <tbody>
                <?php
                    while(($result = $request -> fetch_array()) != null)
                    {
                        echo "<tr>";
                        echo "<td>".$result['login']."</td>";
                        echo "<td>".$result['password']."</td>";
                        echo "<td>".$result['id']."</td>";
                        echo "</tr>";
                    }
                ?>
        </table>
        </div>
    </section>
    <?php
}
else{
    echo "Vous n'avez pas le droit d'etre ici";
    header('Location:http://localhost/Livre-or/profil.php'); //redirigé vers la page profil.php
}
?>
</body>
</html>