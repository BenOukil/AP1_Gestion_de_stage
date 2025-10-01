<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
</head>
<body>
    <header>
        <!-- Menu -->
        <?php
        include '_conf.php';
        ?>

        <?php
        if (isset($_POST['sign_out'])) {
            session_destroy();
            ?>
            <h1>Déconnexion réussie</h1>
            <?php
        } else {
            
            }
        ?>
    </header>

    <body>
        <?php
        /*********************************************
        On se connecte si on arrive d'un form de connexion
        *********************************************/
        if (isset($_POST['send_con'])) {
            $login = $_POST['login'];
            $motdepasse = $_POST['motdepasse'];
            $motdepasse = md5($motdepasse);

            $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
            $requete = "SELECT * FROM utilisateur WHERE login = '$login' AND motdepasse = '$motdepasse' ";
            
            $resultat = mysqli_query($connexion, $requete);
            $trouve = 0;
            
            while ($donnees = mysqli_fetch_assoc($resultat)) {
                
                $trouve = 1;
                $_SESSION['Sid'] = $donnees['num'];
                $_SESSION['Stype'] = $donnees['type'];
                $_SESSION['Slogin'] = $donnees['login'];
                $_SESSION['Semail'] = $donnees['email'];
                $_SESSION['Snom'] = $donnees['nom'];
                $_SESSION['Sprenom'] = $donnees['prenom'];
                $_SESSION['Stel'] = $donnees['tel'];
            }

            if ($trouve == 1) {
                
            } else {
                echo 'Erreur de connexion.';
            }
            
        }

        /*********************************************
            On vérifie si on est connecté
        *********************************************/
        if (isset($_SESSION['Sid'])) {
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

            <h1>Bienvenue <?php echo $login ?></h1>
            
            
            
            <?php if ($_SESSION['Stype'] == 1) { ?>
                <p>Vous êtes connecté en tant qu'élève.</p>
                
            <?php } else if ($_SESSION['Stype'] == 2) { ?>
                <p>Vous êtes connecté en tant que professeur.</p>
            <?php } ?>

            
        <?php
        } else {
            echo "La connexion est perdue, veuillez revenir à la <a href='index.php'>page d'index</a> pour vous reconnecter."; 
        }
    
    ?>
</body>
</html>