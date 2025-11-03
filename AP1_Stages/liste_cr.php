<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des comptes-rendus</title>
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

<?php
    
    include '_conf.php';

    if (isset($_POST['sign_out'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }


?>

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