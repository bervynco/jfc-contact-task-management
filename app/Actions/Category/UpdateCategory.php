<?php
namespace App\Actions\Category;

use App\Models\Category;

class UpdateCategory
{
    public function handle($categoryData, $id)
    {
        return Category::where('id', $id)->update(['name' => $categoryData['name']]);
    }
}