<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Compte Rendu | Création</title>
    <link rel="icon" type="png" href="icon.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <?php
        include '_conf.php';
        ?>

        <?php if ($_SESSION['Stype'] == 1) { 
        include "menu_eleve.php";
        
     }
     else {
        include "menu_prof.php";
     } ?>

        <?php
        if (isset($_POST['sign_out'])) {
            session_destroy();
            header("Location: index.php");
            exit();
            ?>
            <h1>Déconnexion réussie</h1>
            <?php
        } else {
            // Vide - à supprimer si inutile
        }
        ?>

        <?php
        $date = date("Y-m-d");
        
        // Message de confirmation
        $confirmation_message = "";

        if ((isset($_POST['date_report'])) && (isset($_POST['content']))) {
            $datetime = date("Y-m-d H:i:s");
            $date_report = $_POST['date_report'];
            $content = $_POST['content'];
            $num_student = $_SESSION['Sid'];
            
            $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
            $requete = "INSERT INTO cr(date, description, datetime, num_utilisateur) VALUES 
                        ('$date_report', '$content', '$datetime', $num_student)";
            $resultat = mysqli_query($connexion, $requete);
            
            if ($resultat) {
                $confirmation_message = "<div class='connection-status success'><i class='fas fa-check-circle'></i> Votre compte-rendu a été créé avec succès!</div>";
            } else {
                $confirmation_message = "<div class='connection-status error'><i class='fas fa-exclamation-triangle'></i> Une erreur est survenue lors de la création du compte-rendu.</div>";
            }
        }
        ?>
    </header>

    <div class="main-content">
        <h1 class="page-title">Créer un nouveau compte-rendu de stage</h1>
        
        <?php echo $confirmation_message; ?>

        <div class="auth-container">
            <form method="POST" id="compte_rendu">
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input id="date" name="date_report" type="date" value="<?php echo $date; ?>" class="form-input">
                </div>

                <div class="form-group">
                    <label for="content">Compte rendu :</label>
                    <textarea name="content" id="content" cols="50" rows="10" wrap="soft" class="form-textarea" placeholder="Décrivez vos activités de stage..."></textarea>
                </div>
                
                <div class="form-actions">
                    <input type="submit" id="submit" name="submit" value="Confirmer" class="btn-primary">
                    
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 - BiblioStage | Tous droits réservés.</p>
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