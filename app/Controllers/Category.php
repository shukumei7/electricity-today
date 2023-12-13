<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CategoryModel;

class Category extends Controller
{
    public function index()
    {
        $model = new CategoryModel();
        $data['categories'] = $model->findAll();
        return view('Category/index', $data);
    }

    public function create()
    {
        return view('Category/create');
    }

    public function store()
    {
        $model = new CategoryModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug')
        ];
        $model->insert($data);
        return redirect()->to('/admin/categories');
    }

    public function edit($id)
    {
        $model = new CategoryModel();
        $data['category'] = $model->find($id);
        return view('Category/edit', $data);
    }

    public function update($id)
    {
        $model = new CategoryModel();
        $name = $this->request->getPost('name');
        $slug = url_title(strtolower($name));
        $data = compact(['name', 'slug']);
        $model->update($id, $data);
        return redirect()->to('/admin/articles');
    }

    public function delete($id)
    {
        $model = new CategoryModel();
        $model->delete($id);
        return redirect()->to('/admin/categories');
    }

    public function list()
    {
        $categoryModel = new \App\Models\CategoryModel();
        $categories = $categoryModel->orderBy('name', 'ASC')->findAll();

        $categoriesWithArticles = [];
        foreach ($categories as $category) {
            $articles = $this->getArticlesForCategory($category['id'], 5, true);
            if (!empty($articles)) {
                $category['articles'] = array_slice($articles, 0, 5); // Get the latest 5 articles
                $categoriesWithArticles[] = $category;
            }
        }

        return $this->response->setStatusCode(200)
                            ->setJSON($categoriesWithArticles);
    }

    public function articles($slug)
    {
        $categoryModel = new \App\Models\CategoryModel();
        $category = $categoryModel->where('slug', $slug)->first();

        if ($category) {
            $articles = $this->getArticlesForCategory($category['id'], 10);
            $category['articles'] = $articles;

            return $this->response->setStatusCode(200)
                                ->setJSON($category);
        } else {
            return $this->response->setStatusCode(404)
                                ->setBody('Category not found');
        }
    }

    private function getArticlesForCategory($categoryId, $limit = 5, $sort = false)
    {
        $articleCategoryModel = new \App\Models\ArticleCategoryModel();
        $articleModel = new \App\Models\ArticleModel();

        $articleCategories = $articleCategoryModel->where('category_id', $categoryId)->findAll();
        $article_ids = array_map(function($articleCategory) {
            return $articleCategory['article_id'];
        }, $articleCategories);

        $articles = $articleModel->getLatestArticles($limit, $article_ids);
        if($sort) {
            usort($articles, function ($a, $b) {
                return strcmp($a['title'], $b['title']);
            });
        }
        return $articles;
    }




}
