<?php 

namespace App\Model;

use App\Core\AbstractModel;
use App\Entity\Category;
use App\Model\CategoryModel;

class CategoryModel extends AbstractModel 
{
    public function getAllCategories()
    {
        $sql = 'SELECT * FROM category ORDER BY name';

        $results = $this->db->getAllResults($sql);

        $categories = [];

        foreach ($results as $categoryData) {
            $categories[] = new Category($categoryData);
        }
        

        return $categories;
    }

    public function getCategoryById(int $idCategory)
    {
        $sql = 'SELECT * FROM category WHERE idCategory = ?';
    
        $result = $this->db->getOneResult($sql, [$idCategory]);
    
        return new Category($result);
    }
    
}