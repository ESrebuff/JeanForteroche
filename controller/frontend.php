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
