<?php
    session_start();
?>
<?php
// On active phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/phpmailer/Exception.php';
require __DIR__ . '/phpmailer/PHPMailer.php';
require __DIR__ . '/phpmailer/SMTP.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Récupération de mot de passe</title>
</head>
<body>
    <?php
    include '_conf.php'; // Ajout du fichier conf

    // Si on revient avec un token
    if (isset($_GET["token"])) {
        $token = $_GET["token"];
        
        // si on revient avec un nouveau mot de passe
        if (isset($_POST["newmdp"])) {

            $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
            $requete = "SELECT * FROM utilisateur WHERE token = '$token'";
            $resultat = mysqli_query($connexion, $requete);
            
            $login = 0;
            while ($donnees = mysqli_fetch_assoc($resultat)) {
                $date_token = $donnees["date_token"];
            }
            

           

            

                $token = $_GET["token"];
                $newmdp = $_POST["newmdp"];
                $newmdp = md5($newmdp);
                
                $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                $requete = "UPDATE utilisateur SET motdepasse = '$newmdp'  WHERE token = '$token' AND date_token >= NOW() - INTERVAL 1 HOUR;";
                $resultat = mysqli_query($connexion, $requete);

                $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                $requete = "UPDATE utilisateur SET token = null  WHERE token = '$token';";
                $resultat = mysqli_query($connexion, $requete);
                
            
                echo "Votre mot de passe a été modifié si vous avez respecté le délai d'une heure.";
                
            
        
        } else {
            // On retrouve les informations associées au token
            $token = $_GET["token"];
            
            $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
            $requete = "SELECT * FROM utilisateur WHERE token = '$token'";
            $resultat = mysqli_query($connexion, $requete);
            
            $login = 0;
            while ($donnees = mysqli_fetch_assoc($resultat)) {
                $login = $donnees["login"];
            }
            
            if ($login != 0) {
                // Formulaire de demande du nouveau mot de passe
                ?>
                <form method="POST">
                    <label for="newmdp">Entrer votre nouveau mot de passe :</label>
                    <input type="password" id="newmdp" name="newmdp">
                    <br><br>
                    <input type="submit" value="Confirmer">
                </form>
                <?php
            } else {
                echo "erreur token";
            }
        }
    } else {
        // Page quand on a renseigné le mail
        if (isset($_POST['email'])) {
            $lemail = $_POST['email'];
            echo "le formulaire a été envoyé avec comme email : " . $lemail;
            
            $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
            $requete = "SELECT * FROM utilisateur WHERE email = '$lemail'";
            $resultat = mysqli_query($connexion, $requete);
            
            $login = 0;
            while ($donnees = mysqli_fetch_assoc($resultat)) {
                $login = $donnees["login"];
            }
            
            if ($login == 0) {
                echo "Cette adresse email ne correspond à aucun compte";
            } else {
                function generateToken($length = 32) {
                    return bin2hex(random_bytes($length));
                }
                
                $token = generateToken();
                $URL_final = $URL.$token;
                
                $mail = new PHPMailer(true);
                
                try {
                    // Config SMTP Hostinger
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.hostinger.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'contact@sioslam.fr';
                    $mail->Password   = '&5&Y@*QHb';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;
                    
                    // Expéditeur
                    $mail->setFrom('contact@sioslam.fr', 'CONTACT SIOSLAM');
                    // Destinataire
                    $mail->addAddress($lemail, 'Moi');
                    
                    // Contenu
                    $mail->isHTML(true);
                    $mail->Subject = 'Votre demande de réinitialisation de mot de passe';
                    $mail->Body    = "<b>Cliquez sur le lien pour modifier votre mot de passe : </b><br/>
                        <br/>
                        $URL_final
                        <br/>
                        <br/>
                        Ce lien est valable 2 minutes.";
                    
                    $mail->AltBody = '';
                    $mail->send();
                    
                    // On ajoute le token à l'utilisateur et la date
                    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                    $requete = "UPDATE utilisateur SET token = '$token' WHERE email = '$lemail';";
                    $resultat = mysqli_query($connexion, $requete);
                    $requete = "UPDATE utilisateur SET date_token = NOW() WHERE email = '$lemail';";
                    $resultat = mysqli_query($connexion, $requete);
                    
                    echo "✅ Email envoyé avec succès !";
                } catch (Exception $e) {
                    echo "❌ Erreur d'envoi : {$mail->ErrorInfo}";
                }
            }
        } else {
            // Page quand on clique sur mdp oublié
            ?>
            <form action="oubli.php" method="POST">
                <label for="email">Votre adresse email :</label>
                <input type="text" id="email" name="email">
                <br><br>
                <input type="submit" value="Confirmer">
            </form>
            <?php
        }
    }
    ?>
</body>
</html>