<?php

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {   
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM alaska_jf_comments WHERE post_id = ? ORDER BY comment_date');
        $comments->execute(array($postId));

        return $comments;
    }    
}
