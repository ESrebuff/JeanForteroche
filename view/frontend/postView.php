<?php 
    $title = htmlspecialchars($post['title']) . " Billet simple pour l'Alaska";
    ob_start();
?>
<div class="container">
    <header class="blog-header py-3">
        <h1 class="blog-post-title text-center"><?= htmlspecialchars($post['title']) ?></h1>
    </header>
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="index.php">Accueil</a>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 blog-main">
            <div class="blog-post">
                <p><?= $post['content'] ?></p>
                <p class="blog-post-meta text-center"><em>le <?= $post['creation_date_fr'] ?></em></p>
            </div>
        </div>
    </div>

    <h2 class="blog-post-title text-center section-comment">Commentaires</h2>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
    <div class="comments">
        <p>
            <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?>
        </p>

        <p>
            <?= nl2br(htmlspecialchars($comment['comment'])) ?>
        </p>

<?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin" ) { ?>
        <a class="col-md-6 link-comment" href="index.php?action=deleteComment&amp;id=<?= $comment['id'] ?>&amp;id_post=<?= $post['id'] ?> ">Supprimer le commentaire</a>
        
<?php } else { ?>
        <a class="col-md-6 link-comment" href="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>&amp;id_post=<?= $post['id'] ?> ">Signalez le commentaire</a>
        <?php } ?>
    </div>
<?php } ?>
    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
        <div class="form-group">
            <label for="author">Pseudo :</label><br />
            <input required placeholder="Entrez un pseudo" type="text" id="author" name="author" />
        </div>
        <div class="form-group">
            <label for="comment">Commentaire</label><br />
            <textarea class="form-control" id="comment" name="comment" value="Entrez un pseudo" rows="5"></textarea>
        </div>
        <div class="form-group button-input-centr">
            <input class="input-send" value="Envoyer" type="submit" />
        </div>
    </form>
</div>

<footer class="page-footer blog-footer">
    <?php    
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
?>
    <a class="btn btn-sm btn-outline-secondary" href="index.php?action=profileAdmin">Profil administrateur</a>
    <?php  
    } 
    else {
?>
    <a class="btn btn-sm btn-outline-secondary" href="index.php?action=connect">Administration Connexion</a>
</footer>


<?php
        
}
    $content = ob_get_clean();
    require('template.php'); 
?>
