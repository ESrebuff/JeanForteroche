<?php
require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM alaska_jf_posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }
    
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM alaska_jf_posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
    
    public function addPost($title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO alaska_jf_posts (title, content, creation_date) VALUES(?, ?, NOW())');
        $affectedLines = $req->execute(array($title, $content));

        return $affectedLines;
    }
    
    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM alaska_jf_posts WHERE id=?');
        $delete->execute(array($postId));

        return $delete;
    }
    
    public function idPostAddedPost()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id FROM alaska_jf_posts ORDER BY id DESC ');
        $idPostAdded = $req->fetch();
        return $idPostAdded;
    }
    
    public function idPostAdded($postId, $postTitle, $contentPost)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE alaska_jf_posts SET title=?, content=? WHERE id=?');
        
        
        $updateLines = $comments->execute(array($postTitle, $contentPost, $postId));

        return $updateLines;
    }
    
}
