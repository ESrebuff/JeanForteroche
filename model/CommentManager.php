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
    
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO alaska_jf_comments (post_id, author, comment, comment_date, report) VALUES(?, ?, ?, NOW(), ?)');
        $affectedLines = $comments->execute(array($postId, $author, $comment, 0));

        return $affectedLines;
    }
    
    public function deleteComment($idComment)
    {
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM `alaska_jf_comments` WHERE id=?');
        $delete->execute(array($idComment));

        return $delete;
    }
    
    public function getReport()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, author, comment, report FROM alaska_jf_comments ORDER BY report DESC');
        
        return $req;
    }
    
    public function reportCommentIncrement($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE alaska_jf_comments SET report = report + 1 WHERE id=?');
        $reportComment = $req->execute(array($commentId));
        return $reportComment;
    }
}
