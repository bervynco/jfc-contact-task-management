<?php
namespace App\Actions\Category;

use App\Models\Category;

class GetAllCategory
{
    public function handle()
    {
        return Category::get();
    }
}