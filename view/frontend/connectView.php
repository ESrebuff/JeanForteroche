<?php 
    session_start();
    $title = 'Mon blog';
    ob_start(); 
    if(!isset($_SESSION['role']))
    {
        
?>
<div class="modal-dialog text-center modal-con">
    <div class="col-ms-8 main-section">
        <div class="modal-content">
            <h1 class="blog-post-title h1-con">Administration connexion</h1>
            <nav class="nav d-flex justify-content-between">
                <a class="p-2 text-muted" href="index.php">Accueil</a>
            </nav>
            <?php
        if(isset($erreur)){
            echo "<font color='red'>" . $erreur . "</font>";
        }
    ?>
            <form class="col-12 con-form" action="index.php?action=connectAccount" method="POST">
                <div class="form-group group-con">
                    <input id="pseudoconnect" type="text" class="form-control input-con" name="pseudoconnect" placeholder="Nom d'utilisateur" />
                </div>

                <div class="form-group group-con">
                    <input id="passconnect" type="password" class="form-control input-con" name="passconnect" placeholder="Mot de passe" />
                </div>
                <button type="submit" name="formconnect" class="btn btn-sm btn-outline-secondary btn-con">Se connecter</button>
            </form>
        </div><!-- End of modal content -->
    </div>
</div>
<?php
    }
    else
    {
    ?>
<div align="center">
    <h2>Vous êtes déja connecté</h2>
    <br /><br /><br />
    <form action="index.php?action=disconnectsAdmin" method="POST">
        <input type="submit" name="formdisconnects" value="Se déconnecter !">
    </form>
</div>

<p><a href="index.php">Retour à la liste des billets</a></p>
<?php    
    }
    $content = ob_get_clean();
    require('template.php'); 
?>
