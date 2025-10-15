<?php
session_start();
?>

<!DOCTYPE html>
<html>

 <?php
        include '_conf.php';

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
            </header>

        <body>

                <?php
                    $login = $_SESSION['Slogin'];
                    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                    $requete = 
                    "SELECT cr.*, tuteur.nom as 'tnom', tuteur.prenom as 'tprenom', stage.nom as 'snom'
                    FROM cr, utilisateur ,stage, tuteur
                    WHERE utilisateur.num=cr.num_utilisateur 
                    AND stage.num=utilisateur.num_stage 
                    AND tuteur.num=stage.num_tuteur  
                    AND utilisateur.login = '$login' ";
        
                    $resultat = mysqli_query($connexion, $requete);
                    $trouve = 0;
                    
                    ?>

                    <table border=1>
                    <caption>
                        Tableau des comptes-rendus
                    </caption>
                    <thead>
                        <tr>
                        <th scope="col">Jour du compte-rendu</th>
                        <th scope="col">Entreprise</th>
                        <th scope="col">Description</th>
                        <th scope="col">Tuteur</th>
                        <th scope="col">Vu</th>
                        <th scope="col">Dernière modification</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                    while ($donnees = mysqli_fetch_assoc($resultat)) {
                        
                    $description = $donnees['description'];
                    $vu = $donnees['vu'];
                
                    $datetime = $donnees['datetime'];
                    $date = $donnees['date'];
                    $tuteur_nom = $donnees['tnom'];
                    $tuteur_prenom = $donnees['tprenom'];
                    $stage_nom = $donnees['snom'];
                        
                    ?>
                    
                    <tr>
                        <th scope="row"><?php echo $date ?></th>
                        <td><?php echo $stage_nom ?></td>
                        <td><?php echo $description ?></td>
                        <td><?php echo $tuteur_prenom." ". $tuteur_nom ?></td>
                        <td><?php echo $vu ?></td>
                        <td><?php echo $datetime ?></td>
                        </tr>

                    <?php


                    
                        
                        
                       
                    }


                    ?>




            </body>

</html>