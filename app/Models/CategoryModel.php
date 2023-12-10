<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug'];

    public function getOrCreateCategories($categories, $new_categories)
    {
        // Get or create categories
        $category_ids = [];
        if($categories) {
            foreach ($categories as $category_id)
            {
                $category_ids[] = $category_id;
            }
        }
        if($new_categories) {
            $new_categories = explode(',', $new_categories);
            foreach ($new_categories as $category_name)
            {
                $category = $this->where('name', $category_name)->first();
                if ($category)
                {
                    $category_ids[] = $category['id'];
                }
                else
                {
                    $category_ids[] = $this->insert(['name' => $category_name, 'slug' => url_title(strtolower($category_name))]);
                }
            }
        }
        return $category_ids;
    }

}