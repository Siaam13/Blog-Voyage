<?php

namespace App\Model;

use App\Core\AbstractModel;
use App\Entity\Comment;

class CommentModel extends AbstractModel {
    public function addComment(string $username, string $content, int $idArticle, int $userId)
    {
        $sql = 'INSERT INTO comment (username, content, articleId, createdAt, userId)
                VALUES (?, ?, ?, NOW(), ?)';
    
        $this->db->prepareAndExecute($sql, [$username, $content, $idArticle, $userId]);
    }
    


public function getCommentsByArticleId(int $idArticle)
{
    $sql = 'SELECT comment.*, users.username 
            FROM comment 
            JOIN users ON comment.userId = users.id
            WHERE comment.articleId = ?
            ORDER BY comment.createdAt DESC';

    $results = $this->db->getAllResults($sql, [$idArticle]);

    $comments = [];
    foreach ($results as $result) {
        $comments[] = new Comment($result);
    }

    return $comments;
}




}