<?php
$title = 'Administrateur commentaire';
ob_start(); 
?>
<div class="container">
    <header class="blog-header py-3">
        <h1 class="blog-header-logo text-center">Traitement du commentaire signalé</h1>
    </header>
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="index.php">Accueil</a>
        </nav>
    </div>

    <p>Le commentaire :</p>
    <div class="comments">
        <p>
            <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?>
        </p>

        <p>
            <?= nl2br(htmlspecialchars($comment['comment'])) ?>
        </p>
            <a class="btn btn-report btn-sm btn-outline-secondary" href="index.php?action=deleteCommentReport&amp;id=<?= $comment['id'] ?>&amp;id_post=<?= $idPost ?> ">Supprimer le commentaire</a>
            <a class="btn btn-report btn-sm btn-outline-secondary" href="index.php?action=post&amp;id=<?= $idPost ?>">Voir le post lié au commentaire</a>
    </div>
</div>

<footer class="blog-footer">
    <a class="btn btn-sm btn-outline-secondary" href="index.php?action=profileAdmin">Profil administrateur</a>
</footer>
<?php
    $content = ob_get_clean();
    require('template.php'); 
?>
