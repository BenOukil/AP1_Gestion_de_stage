<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioStage - Inscription</title>
    <link rel="icon" type="png" href="icon.png">
    <link rel="stylesheet" href="style_add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php
    include "_conf.php";

    // Vérification du formulaire
    if (isset($_POST['email']) && isset($_POST['motdepasse'])) {
        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
        $requete = "SELECT email FROM utilisateur";
        $resultat = mysqli_query($connexion, $requete);
        $trouve = 0;
        $password=$_POST['motdepasse'];
        $verif=0;
        
        while ($donnees = mysqli_fetch_assoc($resultat)) {
            if ($_POST['email'] == $donnees['email']) {
                $trouve = 1;
            }
        }

        echo $trouve;
        if ($trouve == 1) {
            echo "<h1 style='color : red;'>Erreur ce mail est déjà utilisé.</h1>";
        } else {
            if (strlen($password) < 10) {
                $verif = 1;
                echo "<h1 style='color: red;'>Erreur : le mot de passe doit contenir au moins 10 caractères.</h1>";
            }
            
            if (!preg_match('/[a-z]/', $password)) {
                $verif = 1;
                echo "<h1 style='color: red;'>Erreur : le mot de passe doit contenir au moins une lettre minuscule.</h1>";
            }
            
            if (!preg_match('/[A-Z]/', $password)) {
                $verif = 1;
                echo "<h1 style='color: red;'>Erreur : le mot de passe doit contenir au moins une lettre majuscule.</h1>";
            }
            
            if (!preg_match('/[0-9]/', $password)) {
                $verif = 1;
                echo "<h1 style='color: red;'>Erreur : le mot de passe doit contenir au moins un chiffre.</h1>";
            }
            
            if (!preg_match('/[\W_]/', $password)) {
                $verif = 1;
                echo "<h1 style='color: red;'>Erreur : le mot de passe doit contenir au moins un caractère spécial.</h1>";
            }

            if ($verif == 1) {
                echo "Erreur le mot de passe est trop faible";
            } else {
                if (isset($_POST['login'], $_POST['motdepasse'], $_POST['name'], $_POST['second_name'], $_POST['tel'], $_POST['email'])) {
                    $login = $_POST['login'];
                    $password = password_hash($password, PASSWORD_BCRYPT);
                    $name = $_POST['name'];
                    $sname = $_POST['second_name'];
                    $tel = $_POST['tel'];
                    $email = $_POST['email'];
                    
                    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                    $requete = "INSERT INTO utilisateur(nom, prenom, tel, login, motdepasse, type, email, validation) VALUES 
                                ('$name', '$sname', '$tel', '$login', '$password', 1, '$email', 0)";
                    echo $requete;
                    $resultat = mysqli_query($connexion, $requete);
                    header("Location: index.php");
                    exit();
                    
                }
            }
        }
    }
?>

<!-- Formulaire d'ajout d'élève -->
<div class="auth-container">
    <h2 class="site-branding">S'inscrire :</h2>
    <form action="inscription.php" method="POST">
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

</body>
</html>