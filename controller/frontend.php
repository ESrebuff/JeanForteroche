<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/AccountManager.php');

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    session_start();
    require('view/frontend/listPostsView.php');
}

function post()
{ 
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    if($post){
    session_start();
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
    $idPost = $idPostAdded['id'];
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le billet !');
    }
    else {
        header('Location: index.php?action=post&id=' . $idPost);
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

function deleteComment($idComment, $postId)
{
    deleteComments($idComment, $postId);
    header('Location: index.php?action=post&id=' . $postId);
    
}

function deleteCommentReport($idComment, $postId)
{
    deleteComments($idComment, $postId);
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    profile();
}

function viewOldPost()
{ 
    $getPost = new PostManager();
    
    $post = $getPost->getPost($_GET['id']);
    session_start();
    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
        require('view/frontend/updatePostView.php');
    } else {
        header("Location: index.php");
    }
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

function connectAccount($passconnect, $pseudoconnect)
{
    $accountConnect = new AccountManager();
    
    $connecAccount = $accountConnect->getPassAdmin($passconnect, $pseudoconnect);

    
    $isPasswordCorrect = password_verify($passconnect, $connecAccount['pass']);

    if(!$connecAccount)
    {
        $erreur = 'Mauvais identifiant ou mot de passe !';
        require('view/frontend/connectView.php');
    }
    else
    {
        if($isPasswordCorrect)
        {   
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
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
    session_start();
    require('view/frontend/validateReportView.php');
}

function showCommentRepport($commentId, $idPost)
{ 
    $commentManager = new CommentManager();
    
    $comment = $commentManager->getComment($commentId);
    session_start();
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        require('view/frontend/commentRepportView.php');
    } else {
        header("Location: index.php");
    }
}

// Move between the pages
function connect()
{
    if(session_status() == PHP_SESSION_NONE){
       session_start();
    }
    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
        profile();
    } else {
        require('view/frontend/connectView.php');
    }
}

function profile()
{   
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    
    $commentManager = new CommentManager();   
    $report = $commentManager->getReport();
    if(session_status() == PHP_SESSION_NONE){
       session_start();
    }
    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
       require('view/frontend/adminView.php'); 
    } else {
        header("Location: index.php");
    }
    
}

function formAddPost()
{
    session_start();
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        require('view/frontend/addPostView.php');
    } else {
        header("Location: index.php");
    }
}
