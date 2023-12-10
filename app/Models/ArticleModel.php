<?php namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'slug', 'content', 'date_published'];

    public function insertArticleWithCategories($data, $categories, $new_categories)
    {
        $db = \Config\Database::connect();

        $db->transStart();

        // Insert the article
        $article_id = $this->insert($data);

        // Get or create categories
        $categoryModel = new \App\Models\CategoryModel();
        $category_ids = $categoryModel->getOrCreateCategories($categories, $new_categories);

        // Associate the article with categories
        $articleCategoryModel = new \App\Models\ArticleCategoryModel();
        $articleCategoryModel->addArticleCategories($article_id, $category_ids);

        $db->transComplete();

        if ($db->transStatus() === FALSE)
        {
            throw new \Exception('Failed to insert article with categories');
        }

        return $article_id;
    }
}
