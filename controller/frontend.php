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