<nav class="navbar">
            <div class="nav-brand">
                <h2><i class="fas fa-book-open"></i> BiblioStage</h2>
            </div>

            <?php if (isset($_SESSION['Sid'])): ?>
            <div class="nav-links">
                <?php if ($_SESSION['Stype'] == 2): ?>
                    <button class="nav-btn active" onclick="navigateTo('accueil.php')">
                        <i class="fas fa-home"></i> Accueil
                    </button>
                    <button class="nav-btn" onclick="navigateTo('perso.php')">
                        <i class="fas fa-user"></i> Profil
                    </button>
                    <button class="nav-btn" onclick="navigateTo('liste_cr.php')">
                        <i class="fas fa-file-alt"></i> Liste des Comptes rendus
                    </button>
                     <!-- <button class="nav-btn" onclick="navigateTo('add_eleve.php')">
                        <i class="fas fa-plus-circle"></i> Ajouter un élève
                    </button> -->
                    
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