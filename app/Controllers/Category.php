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
}
