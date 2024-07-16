<?php
namespace App\Actions\Category;

use App\Models\Category;

class DeleteCategory
{
    public function handle($id)
    {
        return Category::where('id', $id)->delete();
    }
}