<p id="hello">
            <?php if(isset($_SESSION['pseudo'])) { ?>
                <span>Bonjour <?= strip_tags($_SESSION['pseudo']);?></span>
                    <?php }else{ ?> 
                        <span>Bienvenue sur mon blog</span>
                    <?php } ?>
        </p>


<nav class="main-navigation">
    <div class="nav-wrapper">

        <input type="checkbox" id="menu-checkbox" class="menu-checkbox">
        <label for="menu-checkbox" class="menu-toggle">≡ Menu</label>
        
        <ul class="menu">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?action=listChapitres">Voir les chapitres</a></li>
                <?php if(isset($_SESSION['pseudo'])) { ?>
            <li><a href="index.php?action=deconnexion">Déconnexion</a></li>
                <?php  if($_SESSION['droits'] == 1) { ?>
            <li><a href="index.php?action=adminViewConnect">Administration</a></li>
                <?php } ?>
                <?php }else{ ?>
            <li><a href="index.php?action=displayConnexion">Connexion</a></li>
            <li><a href="index.php?action=displayContact">Inscription</a></li>
                <?php }?> 
        </ul>
    </div>
</nav>