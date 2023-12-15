<?php namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'slug', 'author', 'image', 'content', 'date_published'];

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

    public function getLatestArticles($limit = 10, $articleIds = null)
    {
        $articleCategoryModel = new \App\Models\ArticleCategoryModel();

        $query = $this->select('id, title, slug, image, author, content, date_published')
                    ->orderBy('date_published', 'DESC')
                    ->limit($limit);

        // If specific article IDs are provided, add a WHERE IN clause
        if ($articleIds !== null) {
            $query->whereIn('id', $articleIds);
        } else {
            $ignore = $articleCategoryModel
                ->select('article_id')
                ->join('categories', 'categories.id = articles_categories.category_id')
                ->where('categories.slug', 'news')
                ->get()
                ->getResultArray();
            $ignore = array_column($ignore, 'article_id'); // Get a single-dimensional array of article IDs
            $query->whereNotIn('id', $ignore);
        }

        $articles = $query->findAll();

        
        // Process each article to generate a summary
        foreach ($articles as &$article) {
            // Remove HTML tags
            $contentText = strip_tags($article['content']);

            // Get the first few sentences
            $sentences = explode('.', $contentText);
            $summary = implode('.', array_slice($sentences, 0, 3)) . '.';

            // Attach first category
            $article['categories'] = $articleCategoryModel->getCategoriesForArticle($article['id']);

            // Add the summary to the article
            $article['summary'] = $summary;
            unset($article['id']); // Remove the ID from the article
            unset($article['content']); // Remove the content from the article
        }

        return $articles;
    }


}
