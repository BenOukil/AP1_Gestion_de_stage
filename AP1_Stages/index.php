<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioStage - Connexion</title>
    <link rel="icon" type="png" href="icon.png">
    <link rel="stylesheet" href="style_index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php
        session_start();
        include '_conf.php';
    ?>
    
    <main class="auth-container">
        <div class="site-branding">
            <h1><i class="fas fa-book-open"></i> BiblioStage</h1>
            <p>Votre plateforme de comptes-rendus de stage</p>
        </div>
        
        <div class="auth-content">
            <h2><i class="fas fa-sign-in-alt"></i> Connexion</h2>
            <form action="accueil.php" method="POST">
                <div class="form-group">
                    <input type="text" id="login" name="login" placeholder="Identifiant" required>
                    <i class="fas fa-user form-icon"></i>
                </div>
                <div class="form-group">
                    <input type="password" id="motdepasse" name="motdepasse" placeholder="Mot de passe" required>
                    <i class="fas fa-lock form-icon"></i>
                </div>
                <button type="submit" class="auth-button" name='send_con'>Se connecter</button>
            </form>
            
            <p class="auth-link"><a href="oubli.php">Mot de passe oublié ?</a></p>
        </div>
        
        
    </main>
    
    <footer class="footer">
        <p>&copy; 2025 - BiblioStage | Tous droits réservés.</p>
    </footer>
</body>
</html>