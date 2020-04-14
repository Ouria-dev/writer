<?php $title = 'Accueil du blog de Jean Forteroche'; ?>
<?php ob_start();?>

<?php require('entity/frontend/nav.php'); ?>
 
<div class="container">
        <div class="item">
            <h2>Billet simple pour l’Alaska </h2>
                <p>Voici mon dernier livre que je vais vous faire découvrir sur ce blog spécialement dédié. Vous allez avoir la possibilité de lire chaque semaine un chapitre ou partie de chapitre sur ce blog.<br><br>
                Enfin vous pouvez vous inscrire pour me laisser un commentaire.</p><br>
            
                <p class="backToPosts"><a href="index.php?action=listChapitres">Voir les chapitres</a></p>
        </div>
    </div>

    <div class="container">
        <div class="item">
            <h2>Jean Forteroche</h2>
                <p><img src="public/images/jf.jpg" alt="photo de l'auteur"></p>
        </div>

        <div class="item">
            <h2>Un peu de moi</h2>
                <p class="texte">Né à Paris en 1965 j'ai commencer très tôt l'écriture.</p>
                <p>Après avoir écrit plusieurs nouvelles, je me suis tourné vers les romans de science-fiction:<br><br>
                  1985 "Retour vers le passé", 1990 "la planète des humains", 1995 "L"Armée des 12 orcs", 2001 "L'odyssée de l'hyper-espace".</p>
                <p>Puis ensuite j'ai eu ma période de romance.<br><br>
                  2003 "Coup de fourdre à Clermont-Férrand", 2005 "Quand Harry rencontre Ginette", 2010 "Autant en emporte le confinement.</p>
                <p>Enfin ma période d'aventure et de découverte.<br><br>
                  2013 "Le seigneur des roseaux", 2016 "A la recherche du pays perdu", 2019 "À la poursuite du diamant rose".</p>
                <p class="texte">Nous voici maintenant dans une nouvelle aventure. Celle de L'Alaska !</p>
                <p class="backToPosts"><a href="index.php?action=listChapitres">Découvrir</a></p>
        </div>
    </div>

  
  <?php require('entity/frontend/footer.php'); ?>
  <?php $content = ob_get_clean(); ?>
  <?php require('template.php'); ?>