<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/AccountManager.php');

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    
    require('view/frontend/listPostsView.php');
}

function post()
{ 
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    if($post){
    require('view/frontend/postView.php');   
    }
    else{
    throw new Exception('Ce billet n\'existe pas !');
    }
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function addPost($title, $content)
{
    $postManager = new PostManager();
    $affectedLines = $postManager->addPost($title, $content);
    
    $idPostAdded = $postManager->idPostAddedPost();
    $idPosttttt = $idPostAdded['id'];
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $idPosttttt);
    }
}

function deletePost($postId)
{
    $postManager = new PostManager();
    
    $postDelete = $postManager->deletePost($postId);
    header('Location: index.php');
}

function deleteComments($idComment, $postId)
{
    $commentManager = new CommentManager();
    
    $comments = $commentManager->deleteComment($idComment);
}

function deleteCommentReport($idComment, $postId)
{
    deleteComments($idComment, $postId);
    
    profile();
}

function updatePost($postId, $postTitle, $contentPost)
{
    $postManager = new PostManager();
    $updateLines = $postManager->idPostAdded($postId, $postTitle, $contentPost);

    if ($updateLines === false) {
        throw new Exception('Impossible d\'ajouter le billet !');
    }
    else {
        header('Location: index.php');
    }
}

function viewOldPost()
{ 
    $getPost = new PostManager();
    
    $post = $getPost->getPost($_GET['id']);

    require('view/frontend/updatePostView.php');
}

function profile()
{   
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    
    $commentManager = new CommentManager();   
    $report = $commentManager->getReport();
    require('view/frontend/adminView.php');
}

function connectAccount($passconnect, $pseudoconnect)
{
    $accountConnect = new AccountManager();
    
    $connecAccount = $accountConnect->getPassAdmin($passconnect, $pseudoconnect);

    
    $isPasswordCorrect = password_verify($passconnect, $connecAccount['pass']);

    if (!$connecAccount) //Utile pour plus tard
    {
        $erreur = 'Mauvais identifiant ou mot de passe !';
        require('view/frontend/connectView.php');
    }
    else
    {
        if ($isPasswordCorrect) 
        {   
            session_start();
            $_SESSION['role'] = $connecAccount['role'];
            $_SESSION['pseudo'] = $pseudoconnect;
            profile();
        }
        else 
        {
            $erreur = 'Mauvais identifiant ou mot de passe !';
            require('view/frontend/connectView.php');
        }
    }
}

function disconnectsAdmin()
{
    session_start();
    $_SESSION = array();
    session_destroy();
    
    setcookie('login', '');
    setcookie('pass_hache', '');
    echo "déconnecté";
    header("Location: index.php");
}

function reportComment($commentId, $idPost)
{
    $commentManager = new CommentManager();
    $repportComment = $commentManager->reportCommentIncrement($commentId);
    
    $comment = $commentManager->getComment($commentId);
    
    require('view/frontend/validateReportView.php');
}

function disconnectsAdmin()
{
    session_start();
    $_SESSION = array();
    session_destroy();
    
    setcookie('login', '');
    setcookie('pass_hache', '');
    echo "déconnecté";
    header("Location: index.php");
}
