<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioStage - Mes comptes rendus</title>
    <link rel="icon" type="png" href="icon.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>



<body>

<?php
    
    include '_conf.php';

    if (isset($_POST['sign_out'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if(isset($_GET['iddel'])){
        $idsup=$_GET['iddel'];
        $iduser=$_SESSION['Sid'];
        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
        $requete = "DELETE FROM cr
        WHERE cr.num=$idsup 
        AND cr.num_utilisateur=$iduser";
        $supprimer = mysqli_query($connexion, $requete);

    }
    ?>

    <header>
       <?php if ($_SESSION['Stype'] == 1) { 
        include "menu_eleve.php";
        
     }
     else {
        include "menu_prof.php";
     } ?>
    </header>

    

    

    <div class="main-content">
        <h1 class="page-title">Tableau des comptes rendus</h1>
        
        <?php
        $login = $_SESSION['Slogin'];
        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
        $requete = 
        "SELECT cr.*, tuteur.nom as 'tnom', tuteur.prenom as 'tprenom', stage.nom as 'snom'
        FROM cr, utilisateur ,stage, tuteur
        WHERE utilisateur.num=cr.num_utilisateur 
        AND stage.num=utilisateur.num_stage 
        AND tuteur.num=stage.num_tuteur  
        AND utilisateur.login = '$login'
        ORDER BY date DESC; ";

        $resultat = mysqli_query($connexion, $requete);
        ?>

        <div class="table-container">
            <table>
                <caption>Liste de vos comptes rendus :</caption>
                <thead>
                    <tr>
                        <th scope="col">Jour du compte rendu</th>
                        <th scope="col">Entreprise</th>
                        <th scope="col">Description</th>
                        <th scope="col">Tuteur</th>
                        <th scope="col">Vu</th>
                        <th scope="col">Dernière modification</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($donnees = mysqli_fetch_assoc($resultat)) {
                        $id= $donnees['num'];
                        $description = $donnees['description'];
                        $vu = $donnees['vu'];
                        $datetime = $donnees['datetime'];
                        $date = $donnees['date'];
                        $tuteur_nom = $donnees['tnom'];
                        $tuteur_prenom = $donnees['tprenom'];
                        $stage_nom = $donnees['snom'];
                        
                        // Formater la date pour l'affichage
                        $formatted_date = date("d/m/Y", strtotime($date));
                        $formatted_datetime = date("d/m/Y H:i", strtotime($datetime));
                        $datetime_plus_1h = date("d/m/Y H:i", strtotime($datetime . ' +1 hour'));

                        
                        // Déterminer la classe pour l'état "vu"
                        $vu_class = ($vu == 1) ? 'vu-oui' : 'vu-non';
                        $vu_text = ($vu == 1) ? 'Oui' : 'Non';
                    ?>
                    <tr>
                        <td><?php echo $formatted_date ?></td>
                        <td><?php echo $stage_nom ?></td>
                        <td><?php echo $description ?></td>
                        <td><?php echo $tuteur_prenom." ". $tuteur_nom ?></td>
                        <td class="<?php echo $vu_class ?>"><?php echo $vu_text ?></td>
                        <td><?php echo $datetime_plus_1h ?></td>
                        <td>
                            <a href="<?php echo $URL?>modif_compte_rendu.php?idmodif='<?php echo $id ?>' " class="modif-btn">Modifier</a>
                        </td>
                        <td>
                            <a href="<?php echo $URL?>compte_rendu.php?iddel='<?php echo $id ?>'  " onclick="return confirm('Voulez-vous vraimennt supprimer ce compte rendu ? La suppression sera irréversible.')" class="delete-btn">Supprimer</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <?php
        // Vérifier s'il n'y a aucun compte-rendu
        if (mysqli_num_rows($resultat) == 0) {
            echo '<p class="no-data">Aucun compte rendu trouvé.</p>';
        }
        ?>
    </div>
</body>

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

</html>