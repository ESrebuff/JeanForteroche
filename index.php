<?php
require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
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
                    throw new Exception('Ecrivez le nouveau billet !');
                }  
        }
    
    
    
    
    
    else {
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
