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