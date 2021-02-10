<?php 
    $title = 'Mon blog';
    $tiny = "https://cdn.tiny.cloud/1/r5mrv1noxmieyps0077inllwqbdi2iwzmlsn9kb97vjebkax/tinymce/5/tinymce.min.js";
    ob_start(); 
?>
<div class="container">
    <header class="blog-header py-3">
        <h1 class="blog-post-title text-center">Modifier un billet</h1>
    </header>
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="index.php">Accueil</a>
        </nav>
    </div>
    <p>Titre : <?= nl2br(htmlspecialchars($post['title'])) ?></p>
    <p>Le contenu :<?= $post['content'] ?></p>


    <form action="index.php?action=updatePost&amp;id= <?= $post['id'] ?>" method="post">
        <div>

            <label for="postTitle">Modifier le titre</label><br />
            <input class="title-post" type="text" id="postTitle" name="postTitle" value="<?= htmlspecialchars($post['title']) ?>">
            <label for="postContent">Modifier le billet</label><br />
            <textarea id="postContent" name="postContent" rows="20">
            <?= $post['content'] ?>
        </textarea>
        </div>
        <div class="form-group button-input-centr">
            <input class="input-send btn-create-post" value="Valider" type="submit" />
        </div>
    </form>
</div>
<footer class="blog-footer">
    <a class="btn btn-sm btn-outline-secondary" href="index.php?action=profileAdmin">Profil administrateur</a>
</footer>
<?php
    $content = ob_get_clean();
    require('template.php'); 
?>
