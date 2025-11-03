<?php
session_start();
include "_conf.php";

// Vérification des droits
if (!isset($_SESSION['Stype']) || $_SESSION['Stype'] != 2) {
    echo '<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accès interdit</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="auth-container">
            <h3 class="connection-status error">Accès refusé : vous n\'avez pas les droits pour accéder à cette page.</h3>
        </div>
    </body>
    </html>';
    exit();
}

// Traitement du formulaire si soumis
if (isset($_POST['login'], $_POST['motdepasse'], $_POST['name'], $_POST['second_name'], $_POST['tel'], $_POST['email'])) {
    $login = $_POST['login'];
    $mdp = md5($_POST['motdepasse']);
    $name = $_POST['name'];
    $sname = $_POST['second_name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    
    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
    $requete = "INSERT INTO utilisateur(nom, prenom, tel, login, motdepasse, type, email) VALUES 
                ('$name', '$sname', '$tel', '$login', '$mdp', 1, '$email')";
    $resultat = mysqli_query($connexion, $requete);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioStage - Ajout élève</title>
    <link rel="icon" type="png" href="icon.png">
    <link rel="stylesheet" href="style_add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!-- Header avec navigation -->
    <header>
        <?php if ($_SESSION['Stype'] == 1) { 
        include "menu_eleve.php";
        
     }
     else {
        include "menu_prof.php";
     } ?>
    </header>

<!-- Formulaire d'ajout d'élève -->
<div class="auth-container">
    <h2 class="site-branding">Ajouter un élève :</h2>
    <form action="add_eleve.php" method="POST">
        <div class="form-group">
            <input type="text" id="login" name="login" placeholder="Identifiant élève" required>
        </div>
        <div class="form-group">
            <input type="password" id="motdepasse" name="motdepasse" placeholder="Mot de passe" required>
        </div>
        <div class="form-group">
            <input type="text" id="nom" name="name" placeholder="Nom de l'élève" required>
        </div>
        <div class="form-group">
            <input type="text" id="prenom" name="second_name" placeholder="Prénom de l'élève" required>
        </div>
        <div class="form-group">
            <input type="text" id="email" name="email" placeholder="Email de l'élève" required>
        </div>
        <div class="form-group">
            <input type="text" id="tel" name="tel" placeholder="Téléphone de l'élève" required>
        </div>
        <button type="submit" class="auth-button" name="send_con">Confirmer</button>
    </form>
</div>

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
