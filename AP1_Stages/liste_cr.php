<?php
session_start();

include '_conf.php';

// Gestion de la déconnexion
if (isset($_POST['sign_out'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Gestion des opérations CRUD
$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);


if (isset($_GET['iddel'])) {
    $iduser = $_GET['iddel'];
    $idcr = $_GET['idcr'];
    $requete = "DELETE FROM cr WHERE cr.num = $iduser AND cr.num_utilisateur = $idcr";
    $supprimer = mysqli_query($connexion, $requete);
}


if (isset($_GET['idcrsee'])) {
    $idcr = $_GET['idcrsee'];
    
    $requete = "UPDATE cr SET vu = null WHERE cr.num = $idcr";
    $modifier = mysqli_query($connexion, $requete);
}


if (isset($_GET['idcrnotsee'])) {
    $idcr = $_GET['idcrnotsee'];
    $requete = "UPDATE cr SET vu = 1 WHERE  cr.num = $idcr";
    $modifier = mysqli_query($connexion, $requete);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioStage - Liste des comptes rendus</title>
    <link rel="icon" type="png" href="icon.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <?php if ($_SESSION['Stype'] == 1) { 
            include "menu_eleve.php";
        } else {
            include "menu_prof.php";
        } ?>
    </header>

    <div class="main-content">
        <h1 class="page-title">Tableau des comptes rendus</h1>
        
        <?php
        // Récupération des comptes-rendus
        $login = $_SESSION['Slogin'];
        $requete = "SELECT cr.*, cr.num as 'crnum', tuteur.nom as 'tnom', tuteur.prenom as 'tprenom', 
                           stage.nom as 'snom', utilisateur.nom as 'unom', utilisateur.prenom as 'uprenom', utilisateur.num as 'unum', cr.num_utilisateur as 'crnum5'
                    FROM cr, utilisateur, stage, tuteur
                    WHERE utilisateur.num = cr.num_utilisateur 
                    AND stage.num = utilisateur.num_stage 
                    AND tuteur.num = stage.num_tuteur  
                    ORDER BY datetime DESC";

        $resultat = mysqli_query($connexion, $requete);
        ?>

        <div class="table-container">
            <table>
                <caption>Liste des comptes rendus :</caption>
                <thead>
                    <tr>
                        <th scope="col">Nom de l'élève</th>
                        <th scope="col">Jour du compte-rendu</th>
                        <th scope="col">Entreprise</th>
                        <th scope="col">Description</th>
                        <th scope="col">Tuteur</th>
                        <th scope="col">Vu</th>
                        <th scope="col">Dernière modification</th>
                       <!-- <th scope="col"></th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($donnees = mysqli_fetch_assoc($resultat)) {
                        $nom_complet = $donnees['uprenom'] . ' ' . $donnees['unom'];
                        $id = $donnees['crnum'];
                        $description = $donnees['description'];
                        $vu = $donnees['vu'];
                        $datetime = $donnees['datetime'];
                        $date = $donnees['date'];
                        $tuteur_nom = $donnees['tnom'];
                        $tuteur_prenom = $donnees['tprenom'];
                        $stage_nom = $donnees['snom'];
                        $cr = $donnees['crnum5'];
            
                        // Formater les dates pour l'affichage
                        $formatted_date = date("d/m/Y", strtotime($date));
                        $formatted_datetime = date("d/m/Y H:i", strtotime($datetime));
                        $datetime_plus_1h = date("d/m/Y H:i", strtotime($datetime . ' +1 hour'));

                        // Déterminer la classe pour l'état "vu"
                        $vu_class = ($vu == 1) ? 'vu-oui' : 'vu-non';
                        $vu_text = ($vu == 1) ? 'Oui' : 'Non';
                    ?>
                    <tr>
                        <td><?php echo $nom_complet; ?></td>
                        <td><?php echo $formatted_date; ?></td>
                        <td><?php echo $stage_nom; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $tuteur_prenom . " " . $tuteur_nom; ?></td>
                        <td>
                            <?php if ($vu == null) { ?>
                                <a href="<?php echo $URL?>liste_cr.php?idcrnotsee=<?php echo $id; ?>" class="delete-btn">Non Vu</a>
                            <?php } else { ?>
                                <a href="<?php echo $URL?>liste_cr.php?idcrsee=<?php echo $id; ?>" class="vu-btn">Vu</a>
                            <?php } ?>
                        </td>
                        <td><?php echo $datetime_plus_1h; ?></td>
                        <!--<td>
                            <a href="liste_cr.php?iddel=<?/*php echo $id;*/ ?>&idcr=<?/*php echo $cr */?>" class="delete-btn">Supprimer</a>
                        </td> -->
                        
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