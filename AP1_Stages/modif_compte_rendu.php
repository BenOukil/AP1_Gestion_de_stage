<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>BiblioStage - Modification compte rendu</title>
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

        if (isset($_POST['content'])){
            $datetime = date("Y-m-d H:i:s");
            
            $newcontent = $_POST['content'];
            $num_student = $_SESSION['Sid'];
           
            $cr_num=$_SESSION['Scr'];
            
            
            $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
            $requete = "UPDATE cr SET description='$newcontent', datetime='$datetime' WHERE num=$cr_num";
            
            $resultat = mysqli_query($connexion, $requete);
             
        }

        

        

        $id=$_GET['idmodif'];
        
        
        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
        $requete = 
        "SELECT cr.* FROM cr 
        WHERE cr.num =$id";
        
       
        

        $resultat2 = mysqli_query($connexion, $requete);

        while ($donnees = mysqli_fetch_assoc($resultat2)) {
            $date = $donnees['date'];
            $content = $donnees['description'];
            
            $_SESSION['Scr'] = $donnees['num'];

        }

        

        

        
        
        

    

        
        ?>
    </header>

    <div class="main-content">
        <h1 class="page-title">Modifier votre compte rendu de stage</h1>
        
        

        <div class="auth-container">
            <form method="POST" id="modif_compte_rendu">
                <div class="form-group">
                    <label for="date">Date : <?php echo $date ?></label>
                    

                <div class="form-group">
                    <label for="content">Compte rendu :</label>
                    <textarea name="content"  id="content" cols="50" rows="10" wrap="soft" class="form-textarea" ><?php echo $content?></textarea>
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