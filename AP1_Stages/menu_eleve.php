<nav class="navbar">
            <div class="nav-brand">
                <h2><i class="fas fa-book-open"></i> BiblioStage</h2>
            </div>

            <?php if (isset($_SESSION['Sid'])): ?>
            <div class="nav-links">
                <?php if ($_SESSION['Stype'] == 1): ?>
                    <button class="nav-btn active" onclick="navigateTo('accueil.php')">
                        <i class="fas fa-home"></i> Accueil
                    </button>
                    <button class="nav-btn" onclick="navigateTo('perso.php')">
                        <i class="fas fa-user"></i> Profil
                    </button>
                    <button class="nav-btn" onclick="navigateTo('compte_rendu.php')">
                        <i class="fas fa-file-alt"></i> Comptes rendus
                    </button>
                    <button class="nav-btn" onclick="navigateTo('create_compte_rendu.php')">
                        <i class="fas fa-plus-circle"></i> Créer un compte rendu
                    </button>
                    
                <?php endif; ?>
            </div>

            <div class="nav-user">
                <span class="nav-user-name"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['Slogin']; ?></span>
                <button class="logout-btn" onclick="logout()" title="Déconnexion">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
            <?php endif; ?>
        </nav>
