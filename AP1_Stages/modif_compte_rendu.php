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

        $date = date("Y-m-d");

        $confirmation_message = "";

        if (isset($_POST['content'])&& (isset($_POST['date_report']))){

            // VERIF PAS LA MEME DATE

            $id=$_SESSION['Sid'];
            $cr_num=$_SESSION['Scr'];
            
            $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
            $requete = "SELECT cr.date, utilisateur.num FROM cr, utilisateur  WHERE cr.num_utilisateur=utilisateur.num AND utilisateur.num='$id' AND cr.num <>$cr_num ";
            
            $resultatverif = mysqli_query($connexion, $requete);

            $datetime = date("Y-m-d H:i:s");
            $date_report=$_POST['date_report'];
            $newcontent = $_POST['content'];
            $newcontent=htmlspecialchars($newcontent);
            $num_student = $_SESSION['Sid'];
           
            

             $verif=1;


            while ($donnees = mysqli_fetch_assoc($resultatverif)) {
                if($donnees['date']==$date_report){
                    
                    $verif=0;
                }
            

            }

            if($date<$date_report){
                $verif=2;
            }


            if ($verif==1){
            
            $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
            $requete = "UPDATE cr SET description='$newcontent', datetime='$datetime', date='$date_report' WHERE num=$cr_num";
            echo $requete;
            $resultat = mysqli_query($connexion, $requete);



            header("Location: compte_rendu.php");
            exit();


            }

            else if ($verif==0) {
                $confirmation_message = "<div class='connection-status error'><i class='fas fa-exclamation-triangle'></i> Erreur. Vous ne pouvez pas créer un compte-rendu à la date d'un compte rendu existant.</div>";
            }
            else if ($verif==2){
                $confirmation_message = "<div class='connection-status error'><i class='fas fa-exclamation-triangle'></i> Erreur. Vous ne pouvez pas créer un compte-rendu à une date postérieur à aujourd'hui.</div>";
            }
            
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
        
        <?php echo $confirmation_message; ?>

        <div class="auth-container">
            <form method="POST" id="modif_compte_rendu">
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input id="date" name="date_report" type="date" value="<?php echo $date; ?>" class="form-input">
                </div>
                    

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