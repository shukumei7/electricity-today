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

        echo view('Article/index', ['articles' => $articles]);
    }


    public function create()
    {
        return view('Article/create');
    }

    public function store()
    {
        $model = new ArticleModel();

        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', TRUE); // Generate slug from title
        $content = $this->request->getPost('content');

        $data = [
            'title' => $title,
            'slug' => $slug,
            'content' => $content
        ];

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
        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'content' => $this->request->getPost('content')
        ];
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
        $model = new ArticleModel();
        $article = $model->where('slug', $slug)->first();

        if ($article) {
            return $this->response->setStatusCode(200)
                                ->setJSON($article);
        } else {
            return $this->response->setStatusCode(404)
                                ->setBody('Article not found');
        }
    }

}
