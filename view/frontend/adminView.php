<?php
if(!isset($_SESSION['role'])){
session_start();
}
$title = 'Mon blog';
ob_start(); 
if(isset($_SESSION['role']))
{
    ?>
<div class="container">
    <header class="blog-header py-3">
        <h1 class="blog-header-logo text-center">Connecté</h1>
    </header>
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="index.php">Accueil</a>
        </nav>
    </div>


    <div class="row mb-2">
        <div class="col-md-6">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3>Billets</h3>
                    <?php              
                    while ($data = $posts->fetch())
                    {
                    ?>
                    <div class="articles">
                        <?= htmlspecialchars($data['title']) ?>
                        <a class="update-articles-profile" href="index.php?action=post&amp;id=<?= $data['id'] ?>">voir le billet
                        </a>
                        <a class="update-articles-profile" href="index.php?action=viewOldPost&amp;id=<?= $data['id'] ?>">modifier</a>
                        <a class="update-articles-profile" href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>">supprimer</a>
                    </div>

                    <?php              
                    }
                    ?>
                    <a class="add-article" href="index.php?action=formAddPost">Ajouter un billet</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3>Commentaires signalez</h3>
                    <?php  
                while ($reportComment = $report->fetch())
                {
                    if($reportComment['report'] > 2)
                    {
            
                ?>
                    <p>Nombre de signalement <?= htmlspecialchars($reportComment['report']) ?>
                        <a href="index.php?action=showCommentRepport&amp;id=<?= $reportComment['id'] ?> &amp;post_id=<?= $reportComment['post_id'] ?>"><em> Voir le commentaire</em>
                        </a>
                    </p>

                    <?php
                    }
                }
                ?>

                </div>
            </div>
        </div>
    </div>

    <?php    
}
else 
{
    header("Location: index.php");
}
?>
</div>


<footer class="page-footer blog-footer">
    <form action="index.php?action=disconnectsAdmin" method="POST">
        <input class="unconnect-button" type="submit" name="formdisconnects" value="Se déconnecter !">
    </form>
</footer>

<?php
    $content = ob_get_clean();
    require('template.php'); 
?>
