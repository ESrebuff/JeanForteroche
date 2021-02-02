<?php
    if(!isset($_SESSION['role'])){
    session_start();
    }
    $title = 'Mon blog';
    ob_start(); 
    ?>
<div class="container">
    <header class="blog-header py-3">
        <h1 class="blog-post-title text-center">Le commentaire à bien été signalez</h1>
    </header>
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="index.php">Retour à l'accueil</a>
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
    </div>

</div>

<footer class="blog-footer">
    <?php    
if(isset($_SESSION['role']) && $_SESSION['role'] == 3)
{
?>
    <a class="btn btn-sm btn-outline-secondary" href="index.php?action=profileAdmin">Profil administrateur</a>
    <?php  
}
else
{
?>
    <a class="btn btn-sm btn-outline-secondary" href="index.php?action=connect">Administration Connexion</a>
</footer>
<?php
}
    $content = ob_get_clean();
    require('template.php'); 
?>
