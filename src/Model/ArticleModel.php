<?php

namespace App\Model;

use App\Core\AbstractModel;
use App\Core\Database;
use App\Entity\Article;
use App\Entity\Category;

class ArticleModel extends AbstractModel
{
    /**
     * Sélectionne tous les articles
     */
    public function getAllArticles()
    {
        $sql = 'SELECT A.idArticle, A.title, A.content, A.image, A.createdAt, C.idCategory, C.name 
                FROM article AS A
                INNER JOIN category AS C 
                ON A.categoryId = C.idCategory 
                ORDER BY createdAt DESC';
    
        $results = $this->db->getAllResults($sql);
    
        $articles = [];
    
        foreach ($results as $result) {
            $category = new Category($result);
            $article = new Article($result);
            $article->setCategory($category);
            $articles[] = $article;
        }
    
        return $articles;
    }
    

    /**
     * Sélectionne un article à partir de son id
     */
    public function getOneArticle(int $id)
    {
        $sql = 'SELECT A.idArticle, A.title, A.content, A.image, A.createdAt, C.idCategory, C.name 
                FROM article AS A
                INNER JOIN category AS C 
                ON A.categoryId = C.idCategory
                WHERE A.idArticle = ?';
    
        $result = $this->db->getOneResult($sql, [$id]);
    
        if (!$result) {
            return null;
        }
    
        $category = new Category($result);
        $article = new Article($result);
        $article->setCategory($category);
    
        return $article;
    }
    

    /**
     * Ajoute un article
     */
    public function addArticle(Article $article)
    {
        $sql = 'INSERT INTO article (title, content, categoryId, image, createdAt)
        VALUES (?,?,?,?, NOW())';

    return $this->db->insert($sql, [
        $article->getTitle(),
        $article->getContent(),
        $article->getCategory()->getIdCategory(),
        $article->getImage()
    ]);
}

public function updateArticle(Article $article)
{
    $sql = 'UPDATE article SET title = ?, content = ?, categoryId = ?, image = ? WHERE idArticle = ?';

    return $this->db->update($sql, [
        $article->getTitle(),
        $article->getContent(),
        $article->getCategory()->getIdCategory(),
        $article->getImage(),
        $article->getIdArticle()
    ]);
}

public function deleteArticle(Article $article)
{
    $sql = 'DELETE FROM article WHERE idArticle = ?';
    $this->db->delete($sql, [$article->getIdArticle()]);
}

// public function getArticlesByCategory($categoryId)
// {
//     $sql = 'SELECT A.idArticle, A.title, A.content, A.image, A.createdAt, C.idCategory, C.name 
//             FROM article AS A
//             INNER JOIN category AS C 
//             ON A.categoryId = C.idCategory
//             WHERE C.idCategory = ?';

//     $results = $this->db->getAllResults($sql, [$categoryId]);

//     $articles = [];

//     foreach ($results as $result) {
//         $category = new Category($result);
//         $article = new Article($result);
//         $article->setCategory($category);
//         $articles[] = $article;
//     }

//     return $articles;
// }

    public function searchArticlesByCategory(int $categoryId)
    {
        $sql = 'SELECT A.idArticle, A.title, A.content, A.image, A.createdAt, C.idCategory, C.name 
                FROM article AS A
                INNER JOIN category AS C 
                ON A.categoryId = C.idCategory
                WHERE C.idCategory = ?
                ORDER BY createdAt DESC';

        $results = $this->db->getAllResults($sql, [$categoryId]);

        $articles = [];

        foreach ($results as $result) {
            $category = new Category($result);
            $article = new Article($result);
            $article->setCategory($category);
            $articles[] = $article;
        }

        return $articles;
    }





}


