<?php
    session_start();
?>
<!DOCTYPE html>
    <header>

       

        <!-- Menu -->
        <?php
        include '_conf.php';
        ?>


<nav>
                <?php if ($_SESSION['Stype'] == 1) { ?>
                    <h1>Élève</h1>
                    <form action="accueil.php" method="POST">
                        <input type="submit" value="Déconnexion" name='sign_out'>
                    </form>

                    <form action="accueil.php" method="POST">
                        <input type="submit" value="Accueil" name='accueil'>
                    </form>
                    
                    <form action="perso.php" method="POST">
                        <input type="submit" value="Profil" name='profil'>
                    </form>
                    
                    <form action="compte_rendu.php" method="POST">
                        <input type="submit" value="Compte rendus" name='compte_rendu'>
                    </form>

                    <form action="create_compte_rendu.php" method="POST">
                        <input type="submit" value="Créer un compte rendu" name='create_compte_rendu'>
                    </form>

                    <form action="comment.php" method="POST">
                        <input type="submit" value="Commentaires" name='comments'>
                    </form>
                <?php } ?>
            </nav>
        <?php
        if (isset($_POST['sign_out'])) {
            session_destroy();
            header("Location: index.php");
            exit();
            ?>
            <h1>Déconnexion réussie</h1>
            <?php
        } else {
            
            }
        ?>
        <?php
            if(isset($_POST['newpassword'])&&($_POST['oldpassword'])){
                $newmdp=$_POST['newpassword'];
                $oldmdp=$_POST['oldpassword'];
                $login= $_SESSION['Slogin'];
                $oldmdp=md5($oldmdp);
                $newmdp=md5($newmdp);

                $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                $requete = "SELECT motdepasse FROM utilisateur WHERE motdepasse = '$oldmdp' ";
                $resultat = mysqli_query($connexion, $requete);

                $trouve=0;
                while ($donnees=mysqli_fetch_assoc($resultat)){
                            
                            $trouve=1;
                           
                }

                if(isset($_POST['newpassword']) && ($trouve==1)) {
                    $requete = "UPDATE utilisateur SET motdepasse='$newmdp' WHERE motdepasse = '$oldmdp' AND login = '$login'";
                    
                    $resultat = mysqli_query($connexion, $requete);
                }
            }

            
        ?>

        </header>
        <body>
            <h1> Vos informations personnelles </h1>

            <br>

            <h2> Votre nom de compte : <?php echo $_SESSION['Slogin'] ?></h2>

            <br>

            <h2> Votre nom : <?php echo $_SESSION['Snom'] ?></h2>

            <br>

            <h2> Votre prénom : <?php echo $_SESSION['Sprenom'] ?></h2>

            <br>

            <h2> Votre email : <?php echo $_SESSION['Semail'] ?></h2>

            <br>

            <h2> Votre numéro de téléphone : <?php echo $_SESSION['Stel'] ?></h2>

            <br>

            <h1> Changement de mot de passe :</h1>

            <form method="POST" >

            <label for="oldpassword">Ancien Mot de passe :</label>
            <input type="password" id="oldpassword" name="oldpassword" required>

            <br>
            <br>

            <label for="newpassword">Nouveaux Mot de passe :</label>
            <input type="password" id="newpassword" name="newpassword" required>

            <br>
            <br>

            <input type="submit" value="Confirmer" name='send_con' >
        </form>

            




