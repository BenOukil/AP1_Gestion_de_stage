<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/phpmailer/Exception.php';
require __DIR__ . '/phpmailer/PHPMailer.php';
require __DIR__ . '/phpmailer/SMTP.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BiblioStage - Récupérer votre mot de passe</title>
    <link rel="icon" type="image/png" href="icon.png">
    <link rel="stylesheet" href="style_index.css">
</head>
<body>

<div class="auth-container">
    <div class="site-branding">
        <h1> BiblioStage</h1>
        <p>Votre plateforme de comptes rendus de stage</p>
    </div>

    <div class="auth-content">
        <h2>🔒 Récupération de mot de passe</h2>

        <?php
        include '_conf.php';

        if (isset($_GET["token"])) {
            $token = $_GET["token"];

            if (isset($_POST["newmdp"])) {
                $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                $requete = "SELECT * FROM utilisateur WHERE token = '$token'";
                $resultat = mysqli_query($connexion, $requete);
                while ($donnees = mysqli_fetch_assoc($resultat)) {
                    $date_token = $donnees["date_token"];
                }

                $newmdp = md5($_POST["newmdp"]);
                $requete = "UPDATE utilisateur SET motdepasse = '$newmdp' 
                            WHERE token = '$token' AND date_token >= NOW() - INTERVAL 1 HOUR;";
                mysqli_query($connexion, $requete);

                $requete = "UPDATE utilisateur SET token = null WHERE token = '$token';";
                mysqli_query($connexion, $requete);

                echo "<p>✅ Votre mot de passe a été modifié avec succès (si le délai d'une heure n'a pas été dépassé).</p>";
            } else {
                $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                $requete = "SELECT * FROM utilisateur WHERE token = '$token'";
                $resultat = mysqli_query($connexion, $requete);
                $login = 0;
                while ($donnees = mysqli_fetch_assoc($resultat)) {
                    $login = $donnees["login"];
                }

                if ($login != 0) {
                    ?>
                    <form method="POST" class="auth-form">
                        <div class="form-group">
                            <label for="newmdp">Entrer votre nouveau mot de passe :</label>
                            <input type="password" id="newmdp" name="newmdp" required>
                        </div>
                        <button type="submit" class="auth-button">Confirmer</button>
                    </form>
                    <?php
                } else {
                    echo "<p>❌ Erreur : lien de réinitialisation invalide ou expiré.</p>";
                }
            }
        } else {
            if (isset($_POST['email'])) {
                $lemail = $_POST['email'];
                $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                $requete = "SELECT * FROM utilisateur WHERE email = '$lemail'";
                $resultat = mysqli_query($connexion, $requete);
                $login = 0;
                while ($donnees = mysqli_fetch_assoc($resultat)) {
                    $login = $donnees["login"];
                }

                if ($login == 0) {
                    echo "<p>❌ Cette adresse email ne correspond à aucun compte.</p>";
                } else {
                    function generateToken($length = 32) {
                        return bin2hex(random_bytes($length));
                    }

                    $token = generateToken();
                    $URL_final = $URLtoken . $token;

                    $mail = new PHPMailer(true);
                    try {
                        $mail->CharSet = 'UTF-8';
                        $mail->Encoding = 'base64';
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.hostinger.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'contact@siolapie.com';
                        $mail->Password   = 'EmailL@pie25';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;

                        $mail->setFrom('contact@siolapie.com', 'CONTACT SIOSLAM');
                        $mail->addAddress($lemail, 'Utilisateur');
                        $mail->isHTML(true);
                        $mail->Subject = 'Réinitialisation de votre mot de passe';
                        $mail->Body    = "<b>Cliquez sur le lien pour modifier votre mot de passe :</b><br><br>
                                          <a href='$URL_final'>$URL_final</a><br><br>
                                          Ce lien est valable 1 heure.";
                        $mail->send();

                        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
                        mysqli_query($connexion, "UPDATE utilisateur SET token = '$token', date_token = NOW() WHERE email = '$lemail';");
                        echo "<p>✅ Email de réinitialisation envoyé avec succès !</p>";
                    } catch (Exception $e) {
                        echo "<p>❌ Erreur d'envoi.</p>";
                    }
                }
            } else {
                ?>
                <form action="oubli.php" method="POST" class="auth-form">
                    <div class="form-group">
                        
            
                        <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
                    </div>
                    <button type="submit" class="auth-button">Envoyer le lien</button>
                </form>
                <?php
            }
        }
        ?>
    </div>

    <div class="auth-link">
        <a href="index.php">← Retour à la connexion</a>
    </div>
</div>

<p class="footer">© 2025 - BiblioStage | Tous droits réservés.</p>

</body>
</html>
