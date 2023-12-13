<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ArticleModel;
use App\Models\ArticleCategoryModel;

class Article extends Controller
{
    public function index()
    {
        $model = new ArticleModel();

        $articles = $model->findAll();

        // Fetch categories for each article
        $articleCategoryModel = new ArticleCategoryModel();
        foreach ($articles as &$article) {
            $article['categories'] = $articleCategoryModel->getCategoriesForArticle($article['id']);
        }

        return view('Article/index', ['articles' => $articles]);
    }


    public function create()
    {
        // Load the CategoryModel
        $categoryModel = new \App\Models\CategoryModel();
        // Get all the categories from the table
        $categories = $categoryModel->findAll();
        // Pass the categories array to the view
        return view('Article/create', ['categories' => $categories]);
    }

    public function store()
    {
        $model = new ArticleModel();

        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', TRUE); // Generate slug from title
        $content = $this->request->getPost('content');
        $author = $this->request->getPost('author');
        $image = $this->request->getPost('image');

        $data = compact(['title', 'slug', 'author', 'image', 'content']);

        $categories = $this->request->getPost('categories');
        $new_categories = $this->request->getPost('new_categories');

        $model->insertArticleWithCategories($data, $categories, $new_categories);

        return redirect()->to('/admin/articles');
    }


    public function edit($id)
    {
        $model = new ArticleModel();
        $data['article'] = $model->find($id);
        return view('Article/edit', $data);
    }

    public function update($id)
    {
        $model = new ArticleModel();
        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', TRUE); // Generate slug from title
        $content = $this->request->getPost('content');
        $author = $this->request->getPost('author');
        $image = $this->request->getPost('image');
        $data = compact(['title', 'slug', 'author', 'image', 'content']);
        $model->update($id, $data);
        return redirect()->to('/admin/articles');
    }

    public function delete($id)
    {
        $model = new ArticleModel();
        $model->delete($id);
        return redirect()->to('/admin/articles');
    }

    public function view($slug)
    {
        $articleModel = new ArticleModel();
        $articleCategoryModel = new ArticleCategoryModel();

        $article = $articleModel->where('slug', $slug)->first();

        if ($article) {
            // Fetch the categories for the article
            $categories = $articleCategoryModel->getCategoriesForArticle($article['id']);

            // Attach the categories to the article
            $article['categories'] = $categories;

            return $this->response->setStatusCode(200)
                                ->setJSON($article);
        } else {
            return $this->response->setStatusCode(404)
                                ->setBody('Article not found');
        }
    }


    public function latest()
    {
        $model = new \App\Models\ArticleModel();
        $articles = $model->getLatestArticles();

        return $this->response->setStatusCode(200)
                            ->setJSON($articles);
    }


}
