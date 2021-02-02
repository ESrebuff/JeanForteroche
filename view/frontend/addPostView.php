<?php 
    session_start();
    $title = 'Mon blog';
    $tiny = "https://cdn.tiny.cloud/1/r5mrv1noxmieyps0077inllwqbdi2iwzmlsn9kb97vjebkax/tinymce/5/tinymce.min.js";

    ob_start();
?>
<?php 
if(isset($_SESSION['role']) && $_SESSION['role'] == 3)
{
?>

<div class="container">
    <header class="blog-header py-3">
        <h1 class="blog-post-title text-center">Ajout d'un billet</h1>
    </header>
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="index.php">Accueil</a>
        </nav>
    </div>
    <form action="index.php?action=addPost&amp;" method="post">
        <div>
            <input class="title-post"  type="text" id="postTitle" name="postTitle" placeholder="Titre">
            <textarea id="postContent" name="postContent" rows="15"></textarea>
        </div>
        <div class="form-group button-input-centr">
            <input class="input-send btn-create-post" value="Crée le billet" type="submit" />
        </div>
        
    </form>
</div>

<footer class="blog-footer">
    <a class="btn btn-sm btn-outline-secondary" href="index.php?action=profileAdmin">Profil administrateur</a>
</footer>

<?php  
}
else
{
    header("Location: index.php");
} 
    $content = ob_get_clean();
    require('template.php'); 
?>
