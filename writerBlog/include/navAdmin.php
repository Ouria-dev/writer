<p id="hello">
            <?php if(isset($_SESSION['pseudo'])) { ?>
                <span>Bonjour <?= $_SESSION['pseudo'];?></span>
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
                <?php if(isset($_SESSION['pseudo'])) { ?>
                <?php  if($_SESSION['droits'] == 1) { ?>
            <li><a href="index.php?action=adminViewConnect">Rédaction</a></li>
            <li><a href="index.php?action=listPostViewAdmin">Modifier un chapitre</a></li>
            <li><a href="index.php?action=commentViewAdmin">Commentaires</a></li>
            <li><a href="index.php?action=commentsAdmin&amp;signalement=1">Commentaires signalés</a></li>
            <li><a href="index.php?action=deconnexion">Déconnexion</a></li>
                <?php } ?>
                <?php }else{ ?>
            <li><a href="index.php?action=displayConnexion">Connexion</a></li>
            <li><a href="index.php?action=displayContact">Inscription</a></li>
                <?php }?> 
        </ul>
    </div>
</nav>