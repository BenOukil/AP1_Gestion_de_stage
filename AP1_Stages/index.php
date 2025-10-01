<?php
    session_start();
?>
<!DOCTYPE html>
    <header>

        <?php
            include '_conf.php';
        ?>


        <?php
            if ($bdd = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {

            echo "Connexion réussie.";
            }

            else {

            echo "Erreur de connexion.";

            }

        ?>

    </header>

    <body>
         <form action="accueil.php" method="POST">

            <label for="login">Identifiant:</label>
            <input type="text" id="login" name="login">

            <br>
            <br>

            <label for="motdepasse">Mot de passe :</label>
            <input type="password" id="motdepasse" name="motdepasse">

            <br>
            <br>

            <input type="submit" value="Confirmer" name='send_con' >
        </form> 

        <a href="oubli.php">Mot de passe oublié ? </a>




