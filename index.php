<?php
require('controller/controller.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            } 
        }
        
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    $erreurComment = "nop";
                    header('Location: index.php?action=post&id=' . $_GET['id']);
                }  
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        
        elseif ($_GET['action'] == 'addPost') {
                if (!empty($_POST['postTitle']) && !empty($_POST['postContent'])) {
                    addPost($_POST['postTitle'], $_POST['postContent']);
                }
                else {
                    throw new Exception('Écrivez le nouveau billet !');
                }  
        }
        
        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                    deletePost($_GET['id']);
            }
            else 
            {
                throw new Exception('Aucun billet ciblé');
            }
        }
        
        elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                    deleteComment($_GET['id'], $_GET['id_post']);
            }
            else 
            {
                throw new Exception('Aucun commentaire ciblé');
            }
        }
        
        elseif ($_GET['action'] == 'deleteCommentReport') {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                    deleteCommentReport($_GET['id'], $_GET['id_post']);
            }
            else 
            {
                throw new Exception('Aucun commentaire ciblé');
            }
        }
        
        elseif ($_GET['action'] == 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['postTitle']) && !empty($_POST['postContent'])) {
                    updatePost($_GET['id'], $_POST['postTitle'], $_POST['postContent']);
                }
                else {
                    throw new Exception('Écrivez le nouveau billet !');
                }  
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        
        elseif ($_GET['action'] == 'viewOldPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                viewOldPost();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        
        elseif ($_GET['action'] == 'connectAccount') {
            if (isset($_POST["formconnect"])) {
                $passconnect = htmlspecialchars($_POST['passconnect']);
                $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
                connectAccount($passconnect, $pseudoconnect);
            }
            else {
                header('Location: index.php?action=connect');
                $erreur = "Vous devez remplir le champ";
            }
        }
        
        elseif ($_GET['action'] == 'disconnectsAdmin') {
            if (isset($_POST["formdisconnects"])) {
                disconnectsAdmin();
            }
            else {
                throw new Exception('Erreur de déconnexion');
            }
        }
        
        elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                reportComment($_GET['id'], $_GET['id_post']);
            }
            else 
            {
                throw new Exception('Aucun commentaire ciblé');
            }
        }
        
        elseif ($_GET['action'] == 'showCommentRepport') {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                    showCommentRepport($_GET['id'], $_GET['post_id']);
            }
            else 
            {
                throw new Exception('Aucun commentaire ciblé');
            }
        }
    
        //Move between the pages
        elseif ($_GET['action'] == 'connect') {
            connect();
        }
        elseif ($_GET['action'] == 'profileAdmin') {
            profile();
        }
        elseif ($_GET['action'] == 'formAddPost') {
            formAddPost();
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    $message = $e->getMessage();
        require('view/errorView.php');
    
}
