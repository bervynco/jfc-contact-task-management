<?php
namespace App\Actions\Category;

use App\Models\Category;

class CreateNewCategory
{
    public function handle($categoryData)
    {
        return Category::create($categoryData);
    }
}