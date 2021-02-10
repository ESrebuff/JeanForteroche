<?php 
    $title = 'Les récits de Jean Forteroche';
    ob_start(); 
?>
<div class="container">
    <header class="blog-header py-3">
        <h1 class="blog-header-logo text-center">Les récits de Jean Forteroche</h1>
    </header>

    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
        </nav>
    </div>

    <div class="jumbotron p-4 p-md-5 text-white">
        <div class="col-md-10 px-0">
            <h1 class="display-4 font-italic">Billet simple pour l'Alaska</h1>
            <p class="lead my-3">Vous trouverez ici les chapitres de mon roman "Billet simple pour L'Alaska" que je publierais par chapitre sur mon blog, je vous souhaite bonne lecture -<em>Jean Forteroche</em></p>
        </div>
    </div>

    <p>Derniers billets du blog :</p>
    <div class="row mb-2">
<?php while ($data = $posts->fetch()) { ?>
        <div class="col-md-6">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3>
                        <?= htmlspecialchars($data['title']) ?>
                    </h3>
                    <div class="mb-1 text-muted">
                        Crée le <?=$data['creation_date_fr'] ?>
                    </div>
                    <div class="card-text mb-auto content-article">
                        <?= ($data['content']) ?>
                    </div>
                    <br />
                    <em class="more-of-article">
                        <a class="col-md-4" href="index.php?action=post&amp;id=<?= $data['id'] ?>">
                            Lire plus
                        </a>
            <?php if(isset($_SESSION['role'])) { ?>
                        <a class="col-md-4" href="index.php?action=viewOldPost&amp;id=<?= $data['id'] ?>">modifier</a>
                        <a class="col-md-4" href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>">supprimer</a>
                        <?php } ?>
                    </em>

                </div>
            </div>
        </div>
<?php  } ?>
    </div>
</div>
<footer class="blog-footer">
<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
    <a class="btn btn-sm btn-outline-secondary" href="index.php?action=profileAdmin">Profil administrateur</a>
<?php } else { ?>
    <a class="btn btn-sm btn-outline-secondary" href="index.php?action=connect">Administration Connexion</a>
</footer>
<?php } 
    $posts->closeCursor();
    $content = ob_get_clean();
    require('template.php'); 
?>
