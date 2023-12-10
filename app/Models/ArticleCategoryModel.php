<?php namespace App\Models;

use CodeIgniter\Model;

class ArticleCategoryModel extends Model
{
    protected $table = 'articles_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category_id', 'article_id'];

    public function addArticleCategories($article_id, $category_ids)
    {
        foreach ($category_ids as $category_id)
        {
            $this->insert(['category_id' => $category_id, 'article_id' => $article_id]);
        }
    }

    public function getCategoriesForArticle($article_id)
    {
        return $this->select('categories.id, categories.name')
                    ->join('categories', 'categories.id = articles_categories.category_id')
                    ->where('articles_categories.article_id', $article_id)
                    ->findAll();
    }

}
