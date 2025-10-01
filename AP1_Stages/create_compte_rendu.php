<?php
    session_start();
?>
<!DOCTYPE html>
    <header>

        <?php
            include '_conf.php';
        ?>

        <?php
            $date = date("Y-m-d");
            echo $date;

            if((isset($_POST['date_report'])) && (isset($_POST['content']))){

                $datetime = date("Y-m-d H:i:s");
                $date_report= $_POST['date_report'];
                $content= $_POST['content'];
                $num_student= $_SESSION['Sid'];
                echo $num_student;
                echo $content;
                echo $date_report;
                echo $datetime;
                $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                $requete = "INSERT INTO cr(date, description, datetime, num_utilisateur) VALUES 
                ('$date_report', '$content', '$datetime', $num_student)";
                echo "<hr>".$requete;
                $resultat = mysqli_query($connexion, $requete);

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
        <body>
            <h1> Créer un nouveau compte-rendu de stage : </h1>

            <form method="POST" id="compte_rendu">
    <div>
        <label for="date">Date :</label>
        <br>
        <input id="date" name ="date_report" type="date" value=<?php echo $date?> />
    </div>
    
    <br>
    
    <div>
        <label for="content">Compte rendu :</label>
        <br>
        <textarea name="content" id="content" cols="35" wrap="soft"></textarea>
    </div>
    
    <br>
    
    <input type="submit" id="submit" name="submit" value="Confirmer"/>
</form>
            

            
                




            </body>