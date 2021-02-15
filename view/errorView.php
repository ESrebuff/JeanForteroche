<?php
    $title = 'Erreur';
    ob_start(); 
    ?>
<div class="container">
    <header class="blog-header py-3">
        <h1 class="blog-header-logo text-center">Erreur</h1>
    </header>
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="index.php">Accueil</a>
        </nav>
    </div>
    <h2 class="text-center alert alert-danger"><?= $message ?></h2>
</div>

<?php
    $content = ob_get_clean();
    require('template.php'); 
?>