<?php
session_start();
include '_conf.php';

// Déconnexion
if (isset($_POST['sign_out'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Changement de mot de passe
if (isset($_POST['newpassword']) && isset($_POST['oldpassword'])) {
    $newmdp = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);  
    $oldmdp = $_POST['oldpassword'];
    $login = $_SESSION['Slogin'];

    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
    $requete = "SELECT motdepasse FROM utilisateur WHERE login='$login'";
    $resultat = mysqli_query($connexion, $requete);
    while ($donnees = mysqli_fetch_assoc($resultat)) {
            if(password_verify($oldmdp,$donnees['motdepasse'])){
    if (mysqli_num_rows($resultat) > 0) {
        $requete = "UPDATE utilisateur SET motdepasse='$newmdp' WHERE login='$login'";
        mysqli_query($connexion, $requete);
        $msg = "<div class='connection-status success'>Mot de passe modifié avec succès ✅</div>";
    } else {
        $msg = "<div class='connection-status error'>Ancien mot de passe incorrect ❌</div>";
    }
}
else {
    $msg = "<div class='connection-status error'>Ancien mot de passe incorrect ❌</div>";
}
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BiblioStage - Profil</title>
    <link rel="icon" type="png" href="icon.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <?php if ($_SESSION['Stype'] == 1) { 
        include "menu_eleve.php";
        
     }
     else {
        include "menu_prof.php";
     } ?>
    </header>
   

     
       
    

    <div class="auth-container">
        <div class="welcome-section">
            <h1>Vos informations personnelles</h1>

            <?php
                if ($_SESSION['Stype'] == 1) {
                    ?>
                    <h3><?php echo "Connecté en tant qu'élève."; ?></h2>
                    <?php
                } else {
                    ?>
                    <h3><?php echo "Connecté en tant qu'enseignant."; ?></h2>
                    <?php
                }
                ?>

                    
                
            
            
                

            
            
            <br>
        </div>

        <?php if (isset($msg)) echo $msg; ?>

        <div class="user-info">
            <h2>Nom de compte : <span class="user-value"><?php echo $_SESSION['Slogin']; ?></span></h2></h2>
            <br>
            <h2>Nom : <span class="user-value"><?php echo $_SESSION['Snom']; ?></span></h2></h2>
            <br>
            <h2>Prénom : <span class="user-value"><?php echo $_SESSION['Sprenom']; ?></span></h2></h2>
            <br>
            <h2>Email : <span class="user-value"><?php echo $_SESSION['Semail']; ?></span></h2></h2>
            <br>
            <h2>Téléphone : <span class="user-value"><?php echo $_SESSION['Stel']; ?></span></h2></h2>
        </div>

        <h1 style="margin-top:40px; color: var(--primary-color);">Changement de mot de passe</h1>
        <br>
        <form method="POST">
            <label for="oldpassword">Ancien mot de passe :</label>
            <input type="password" id="oldpassword" name="oldpassword" required>

            <br>
            <br>

            <label for="newpassword">Nouveau mot de passe :</label>
            <input type="password" id="newpassword" name="newpassword" required>

            <br>
            <br>

            <input type="submit" value="Confirmer" name="send_con" class="btn-primary">
        </form>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> - BiblioStage | Tous droits réservés
    </footer>
</body>

<script>
        function navigateTo(page) {
            window.location.href = page;
        }

        function logout() {
            window.location.href = "accueil.php?logout=1";
        }
    </script>

</html>