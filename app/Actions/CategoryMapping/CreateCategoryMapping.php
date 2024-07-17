<?php
namespace App\Actions\CategoryMapping;

use App\Models\CategoryMapping;

class CreateCategoryMapping
{
    public function handle($categoryData)
    {
        return CategoryMapping::insert($categoryData);
    }
}