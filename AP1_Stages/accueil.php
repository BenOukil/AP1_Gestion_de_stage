<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioStage - Accueil</title>
    <link rel="icon" type="png" href="icon.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include '_conf.php'; ?>

    <?php
    // Connexion
    if (isset($_POST['send_con'])) {
        $login = htmlspecialchars($_POST['login']);
        $motdepasse = htmlspecialchars(md5($_POST['motdepasse']));
        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
        $requete = "SELECT * FROM utilisateur WHERE login = '$login' AND motdepasse = '$motdepasse'";
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

    // Déconnexion
    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
    ?>

    <!-- Header avec navigation -->
    <header>
        <?php if (isset($_SESSION['Stype'])){
        if ($_SESSION['Stype'] == 1) { 
        include "menu_eleve.php";
        
     }
     else {
        include "menu_prof.php";
     }} ?>
    </header>

    <main class="auth-container">
        <div class="site-branding">
            <h1><i class="fas fa-book-open"></i> BiblioStage</h1>
            <p>Votre plateforme de comptes-rendus de stage</p>
            
        </div>

        <div class="auth-content">
            <?php if (isset($_SESSION['Sid'])): ?>
            <div class="welcome-section">
                <h2><i class="fas fa-user"></i> Bienvenue <?php echo $_SESSION['Slogin']; ?></h2>
                <?php
                if (isset($_POST['send_con'])) {
                    if ($trouve == 1) {
                        echo '<br><div class="connection-status success">Connexion réussie !</div>';
                    } else {
                        echo '<div class="connection-status error">Erreur de connexion.</div>';
                    }
                }
                ?>
                <p class="user-role">
                    
                    <?php 
                        echo $_SESSION['Stype'] == 1 ? 'Vous êtes connecté en tant qu’élève.' : 'Vous êtes connecté en tant que professeur.';
                         ?>
                </p>
            </div>
            <?php else: ?>
                <div class="connection-status error">
                    Erreur de connexion, veuillez revenir à la
                    <a href='index.php'>page de connexion.</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2025 - BiblioStage | Tous droits réservés.</p>
    </footer>

    <script>
        function navigateTo(page) {
            window.location.href = page;
        }

        function logout() {
            window.location.href = "accueil.php?logout=1";
        }
    </script>
</body>
</html>
