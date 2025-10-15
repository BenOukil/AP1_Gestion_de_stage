<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioStage - Accueil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php
        include '_conf.php';
    ?>
    
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
            }
    ?>

    <!-- Header avec navigation -->
    <header>
        <nav>
            <div class="nav-brand">
                <h2><i class="fas fa-book-open"></i> BiblioStage</h2>
            </div>
            
            <?php if (isset($_SESSION['Sid'])): ?>
            <div class="nav-links">
                <?php if ($_SESSION['Stype'] == 1) { ?>
                    <a href="accueil.php" class="nav-link"><i class="fas fa-home"></i> Accueil</a>
                    <a href="perso.php" class="nav-link"><i class="fas fa-user-circle"></i> Profil</a>
                    <a href="compte_rendu.php" class="nav-link"><i class="fas fa-file-alt"></i> Comptes-rendus</a>
                    <a href="create_compte_rendu.php" class="nav-link"><i class="fas fa-plus-circle"></i> Créer</a>
                    <a href="comment.php" class="nav-link"><i class="fas fa-comments"></i> Commentaires</a>
                <?php } ?>
            </div>
            <?php endif; ?>
            
            <div class="nav-user">
                <?php if (isset($_SESSION['Sid'])): ?>
                    <span class="user-info"><?php echo $_SESSION['Slogin'] ?></span>
                    <form action="accueil.php" method="POST" class="logout-form">
                        <button type="submit" class="logout-btn" name='sign_out' title="Déconnexion">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                
                <?php endif; ?>
            </div>
        </nav>
    </header>
    
    <main class="auth-container">
        <div class="site-branding">
            <h1><i class="fas fa-book-open"></i> BiblioStage</h1>
            <p>Votre plateforme de comptes-rendus de stage</p>
        </div>
        
        <div class="auth-content">
            <?php
            /*********************************************
                On vérifie si on est connecté
            *********************************************/
            if (isset($_POST['send_con'])) {
                if ($trouve == 1) {
                    echo '<div class="connection-status success">Connexion réussie !</div>';
                } else {
                    echo '<div class="connection-status error">Erreur de connexion.</div>';
                }
            }
            
            if (isset($_SESSION['Sid'])) {
            ?>
            
            <?php if (isset($_POST['sign_out'])) {
                session_destroy();
                header("Location: index.php");
                exit();
            } ?>
            
            <div class="welcome-section">
                <h2><i class="fas fa-user"></i> Bienvenue <?php echo $_SESSION['Slogin'] ?></h2>
                
                <?php if ($_SESSION['Stype'] == 1) { ?>
                    <p class="user-role">Vous êtes connecté en tant qu'élève.</p>
                <?php } else if ($_SESSION['Stype'] == 2) { ?>
                    <p class="user-role">Vous êtes connecté en tant que professeur.</p>
                <?php } ?>
            </div>

            <?php
            } else {
                echo "<div class='connection-status error'>La connexion est perdue, veuillez revenir à la <a href='index.php'>page de connexion</a> pour vous reconnecter.</div>"; 
            }
            ?>
        </div>
    </main>
    
    <footer class="footer">
        <p>&copy; 2025 BiblioStage. Tous droits réservés.</p>
    </footer>
</body>
</html>