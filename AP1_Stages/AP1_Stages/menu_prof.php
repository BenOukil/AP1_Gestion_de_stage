<nav>
<?php if ($_SESSION['Stype'] == 2) { ?>
    <h1>Élève</h1>
    <form action="accueil.php" method="POST">
        <input type="submit" value="Déconnexion" name='sign_out'>
    </form>

    <br>
    <br>
    <button onclick="window.location.href='accueil.php'">Accueil</button>
    <br>
    <br>
    <button onclick="window.location.href='perso.php'">Profil</button>
    <br>
    <br>
    <button onclick="window.location.href='compte_rendu.php'">Liste comptes-rendus</button>
    <br>
    <br>
    <button onclick="window.location.href='comment.php'">Liste commentaires</button>
<?php } ?>
</nav>